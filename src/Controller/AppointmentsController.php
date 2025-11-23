<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Service\AppointmentConflictService;
use App\Service\SmartSchedulingService;
use App\Service\AppointmentWorkflowService;

class AppointmentsController extends AppController
{
    protected AppointmentConflictService $conflictService;
    protected SmartSchedulingService $schedulingService;
    protected AppointmentWorkflowService $workflowService;

    public function initialize(): void
    {
        parent::initialize();
        $this->conflictService = new AppointmentConflictService();
        $this->schedulingService = new SmartSchedulingService();
        $this->workflowService = new AppointmentWorkflowService();
    }
    public function index()
    {
        $user = $this->Authentication->getIdentity();
        $query = $this->Appointments->find()->contain(['Patients', 'Doctors']);

        // If patient, only show their own appointments (using patient_id from identity)
        if ($user && $user->role === 'patient') {
            if (!empty($user->patient_id)) {
                $query->where(['patient_id' => $user->patient_id]);
            } else {
                $query->where(['patient_id' => 0]);
            }
        } else if ($user && $user->role === 'doctor') {
            if (!empty($user->doctor_id)) {
                $query->where(['doctor_id' => $user->doctor_id]);
            } else {
                $query->where(['doctor_id' => 0]);
            }
        }

        // Apply filters
        $status = $this->request->getQuery('status');
        $dateFrom = $this->request->getQuery('date_from');
        $dateTo = $this->request->getQuery('date_to');

        if (!empty($status)) {
            $query->where(['status' => $status]);
        }

        if (!empty($dateFrom)) {
            $query->where(['appointment_date >=' => $dateFrom]);
        }

        if (!empty($dateTo)) {
            $query->where(['appointment_date <=' => $dateTo]);
        }

        // Default sorting
        $query->order(['appointment_date' => 'DESC', 'appointment_time' => 'ASC']);

        $appointments = $this->paginate($query);
        $this->set(compact('appointments'));
    }

    public function view($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients', 'Doctors', 'CancelledByUser', 'ApprovedByUser', 'StatusHistory' => ['ChangedByUser']],
        ]);

        $user = $this->Authentication->getIdentity();
        // Restrict access for doctor and patient users
        if ($user) {
            if ($user->role === 'doctor' && isset($user->doctor_id)) {
                if ($appointment->doctor_id != $user->doctor_id) {
                    $this->Flash->error(__('Access denied. You can only view your own appointments.'));
                    return $this->redirect(['action' => 'index']);
                }
            } elseif ($user->role === 'patient' && isset($user->patient_id)) {
                if ($appointment->patient_id != $user->patient_id) {
                    $this->Flash->error(__('Access denied. You can only view your own appointments.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
        }

        // Get status history
        $statusHistory = $this->workflowService->getStatusHistory($id);
        
        // Get allowed transitions for current user
        $userRole = $user->role ?? 'patient';
        $allowedTransitions = $this->workflowService->getAllowedTransitions($id, $userRole);

        // Pass current user for view
        $currentUser = $user;

        $this->set(compact('appointment', 'statusHistory', 'allowedTransitions', 'currentUser'));
    }

    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();
        $user = $this->Authentication->getIdentity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Set defaults
            if (empty($data['duration_minutes'])) {
                $data['duration_minutes'] = 30;
            }
            if (empty($data['status'])) {
                $data['status'] = 'Scheduled';
            }

            $appointment = $this->Appointments->patchEntity($appointment, $data);

            // Check for conflicts
            if (!empty($data['doctor_id']) && !empty($data['patient_id']) && 
                !empty($data['appointment_date']) && !empty($data['appointment_time'])) {
                
                $availability = $this->conflictService->checkAvailability(
                    (int)$data['doctor_id'],
                    (int)$data['patient_id'],
                    $data['appointment_date'],
                    $data['appointment_time'],
                    (int)($data['duration_minutes'] ?? 30)
                );

                if (!$availability['available']) {
                    $this->Flash->error(__($availability['message']));
                    $appointment->setError('appointment_time', $availability['message']);
                } else {
                    // Save appointment
                    if ($this->Appointments->save($appointment)) {
                        // Log initial status
                        if ($user) {
                            $this->workflowService->transitionStatus(
                                $appointment->id,
                                $appointment->status,
                                $user->id,
                                'Appointment created',
                                $this->request
                            );
                        }
                        $this->Flash->success(__('The appointment has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
                }
            } else {
                // Save without conflict check if required fields are missing (validation will catch it)
            if ($this->Appointments->save($appointment)) {
                    if ($user) {
                        $this->workflowService->transitionStatus(
                            $appointment->id,
                            $appointment->status,
                            $user->id,
                            'Appointment created',
                            $this->request
                        );
                    }
                $this->Flash->success(__('The appointment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }
        }

        $patients = $this->Appointments->Patients->find('list', ['limit' => 200])->where(['status' => 'active']);
        $doctors = $this->Appointments->Doctors->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'limit' => 200
        ])->where(['status' => 'active']);
        
        // Get doctors with department info for JavaScript
        $doctorsWithDept = $this->Appointments->Doctors->find()
            ->where(['status' => 'active'])
            ->contain(['Departments'])
            ->toArray();
        
        $this->set(compact('appointment', 'patients', 'doctors', 'doctorsWithDept'));
    }

    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients', 'Doctors']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $originalData = [
                'appointment_date' => $appointment->appointment_date ? $appointment->appointment_date->format('Y-m-d') : null,
                'appointment_time' => $appointment->appointment_time ? $appointment->appointment_time->format('H:i:s') : null,
                'doctor_id' => $appointment->doctor_id,
            ];
            
            $appointment = $this->Appointments->patchEntity($appointment, $data);

            // Check for conflicts if date/time/doctor changed
            $dateChanged = isset($data['appointment_date']) && 
                          ($data['appointment_date'] != $originalData['appointment_date']);
            $timeChanged = isset($data['appointment_time']) && 
                          ($data['appointment_time'] != $originalData['appointment_time']);
            $doctorChanged = isset($data['doctor_id']) && 
                            ($data['doctor_id'] != $originalData['doctor_id']);

            if ($dateChanged || $timeChanged || $doctorChanged) {
                $availability = $this->conflictService->checkAvailability(
                    (int)($data['doctor_id'] ?? $appointment->doctor_id),
                    (int)($data['patient_id'] ?? $appointment->patient_id),
                    $data['appointment_date'] ?? $appointment->appointment_date,
                    $data['appointment_time'] ?? $appointment->appointment_time,
                    (int)($data['duration_minutes'] ?? $appointment->duration_minutes ?? 30),
                    $id // Exclude current appointment
                );

                if (!$availability['available']) {
                    $this->Flash->error(__($availability['message']));
                    $appointment->setError('appointment_time', $availability['message']);
                } else {
                    // Save appointment
                    if ($this->Appointments->save($appointment)) {
                        $this->Flash->success(__('The appointment has been saved.'));
                        return $this->redirect(['action' => 'view', $id]);
                    }
                    $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
                }
            } else {
                // Save without conflict check if date/time didn't change
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));
                    return $this->redirect(['action' => 'view', $id]);
                }
                $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
            }
        }

        $patients = $this->Appointments->Patients->find('list', ['limit' => 200])->where(['status' => 'active']);
        $doctors = $this->Appointments->Doctors->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'limit' => 200
        ])->where(['status' => 'active']);
        
        // Get doctors with department info for JavaScript
        $doctorsWithDept = $this->Appointments->Doctors->find()
            ->where(['status' => 'active'])
            ->contain(['Departments'])
            ->toArray();
        
        $this->set(compact('appointment', 'patients', 'doctors', 'doctorsWithDept'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointment = $this->Appointments->get($id);
        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function dashboard()
    {   
        $user = $this->Authentication->getIdentity();
        if (!$user) {
            $this->Flash->error(__('You must be logged in to access this page.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        if ($user->role === 'doctor') {
            // Only show this doctor's appointments
            $doctorId = $user->doctor_id;
            $todaysAppointments = $this->Appointments->find()
                ->contain(['Patients', 'Doctors'])
                ->where([
                    'appointment_date' => date('Y-m-d'),
                    'doctor_id' => $doctorId
                ])
                ->order(['appointment_time' => 'ASC'])
                ->toArray();

            // Filter out any appointment not belonging to this doctor (extra safety)
            $todaysAppointments = array_filter($todaysAppointments, function($appt) use ($doctorId) {
                return $appt->doctor_id == $doctorId;
            });

            $upcomingAppointments = $this->Appointments->find()
                ->contain(['Patients', 'Doctors'])
                ->where([
                    'appointment_date >=' => date('Y-m-d'),
                    'appointment_date <=' => date('Y-m-d', strtotime('+7 days')),
                    'doctor_id' => $doctorId
                ])
                ->order(['appointment_date' => 'ASC', 'appointment_time' => 'ASC'])
                ->limit(10)
                ->toArray();

            $upcomingAppointments = array_filter($upcomingAppointments, function($appt) use ($doctorId) {
                return $appt->doctor_id == $doctorId;
            });

            // Stats for this doctor only
            $totalPatients = $this->Appointments->find()
                ->select(['patient_id'])
                ->where(['doctor_id' => $doctorId])
                ->group(['patient_id'])
                ->count();
            $totalDoctors = 1;
            $todaysCount = count($todaysAppointments);
            $totalAppointments = $this->Appointments->find()->where(['doctor_id' => $doctorId])->count();
        } else if ($user->role === 'admin') {
            // Admin: show all
            $todaysAppointments = $this->Appointments->find()
                ->contain(['Patients', 'Doctors'])
                ->where(['appointment_date' => date('Y-m-d')])
                ->order(['appointment_time' => 'ASC'])
                ->toArray();

            $upcomingAppointments = $this->Appointments->find()
                ->contain(['Patients', 'Doctors'])
                ->where([
                    'appointment_date >=' => date('Y-m-d'),
                    'appointment_date <=' => date('Y-m-d', strtotime('+7 days'))
                ])
                ->order(['appointment_date' => 'ASC', 'appointment_time' => 'ASC'])
                ->limit(10)
                ->toArray();

            $totalPatients = $this->Appointments->Patients->find()->where(['status' => 'active'])->count();
            $totalDoctors = $this->Appointments->Doctors->find()->where(['status' => 'active'])->count();
            $todaysCount = count($todaysAppointments);
            $totalAppointments = $this->Appointments->find()->count();
        } else {
            // Patients and others: restrict or redirect
            $this->Flash->error(__('Access denied.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $this->set(compact(
            'todaysAppointments', 
            'upcomingAppointments', 
            'totalPatients', 
            'totalDoctors', 
            'todaysCount', 
            'totalAppointments'
        ));
    }

    /**
     * Get available time slots for a doctor (AJAX endpoint)
     */
    public function availableSlots()
    {
        $this->request->allowMethod(['get', 'ajax']);
        $this->autoRender = false;

        $doctorId = $this->request->getQuery('doctor_id');
        $date = $this->request->getQuery('date');
        $duration = $this->request->getQuery('duration', 30);

        if (!$doctorId || !$date) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['error' => 'Missing required parameters']));
        }

        $slots = $this->schedulingService->getAvailableTimeSlots(
            (int)$doctorId,
            $date,
            (int)$duration
        );

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['slots' => $slots]));
    }

    /**
     * Get alternative doctors (AJAX endpoint)
     */
    public function alternativeDoctors()
    {
        $this->request->allowMethod(['get', 'ajax']);
        $this->autoRender = false;

        $departmentId = $this->request->getQuery('department_id');
        $date = $this->request->getQuery('date');
        $time = $this->request->getQuery('time');
        $duration = $this->request->getQuery('duration', 30);
        $excludeDoctorId = $this->request->getQuery('exclude_doctor_id');

        if (!$departmentId || !$date || !$time) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['error' => 'Missing required parameters']));
        }

        $alternatives = $this->schedulingService->findAlternativeDoctors(
            (int)$departmentId,
            $date,
            $time,
            (int)$duration,
            $excludeDoctorId ? (int)$excludeDoctorId : null
        );

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['alternatives' => $alternatives]));
    }

    /**
     * Confirm appointment
     */
    public function confirm($id = null)
    {
        $this->request->allowMethod(['post', 'patch']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $result = $this->workflowService->confirm($id, $user->id);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Start appointment (mark as In Progress)
     */
    public function start($id = null)
    {
        $this->request->allowMethod(['post', 'patch']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $result = $this->workflowService->start($id, $user->id);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Complete appointment
     */
    public function complete($id = null)
    {
        $this->request->allowMethod(['post', 'patch']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $result = $this->workflowService->complete($id, $user->id);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Request cancellation
     */
    public function requestCancellation($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $reason = $this->request->getData('reason');
        $result = $this->workflowService->requestCancellation($id, $user->id, $reason);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Cancel appointment (direct cancellation)
     */
    public function cancel($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $reason = $this->request->getData('reason');
        $result = $this->workflowService->cancel($id, $user->id, $reason);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Approve cancellation request
     */
    public function approveCancellation($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $result = $this->workflowService->approveCancellation($id, $user->id);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Reject cancellation request
     */
    public function rejectCancellation($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Authentication->getIdentity();

        if (!$user) {
            $this->Flash->error(__('You must be logged in to perform this action.'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $reason = $this->request->getData('reason');
        $result = $this->workflowService->rejectCancellation($id, $user->id, $reason);

        if ($result['success']) {
            $this->Flash->success(__($result['message']));
        } else {
            $this->Flash->error(__($result['message']));
        }

        return $this->redirect(['action' => 'view', $id]);
    }
}