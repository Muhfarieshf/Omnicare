<?php

namespace App\Controller;

use App\Controller\AppController;

class DoctorsController extends AppController
{
    // Access control - restrict patient actions
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $user = $this->Authentication->getIdentity();
        $action = $this->request->getParam('action');
        
        // Patients can only access index and view
        if ($user && $user->role === 'patient' && !in_array($action, ['index', 'view'])) {
            $this->Flash->error(__('Access denied. Patients are not allowed to access this section.'));
            return $this->redirect(['controller' => 'Patients', 'action' => 'dashboard']);
        }
    }

    public function index()
    {
        $currentUser = $this->Authentication->getIdentity();
        
        // If doctor is logged in, show only their own profile
        if ($currentUser && $currentUser->role === 'doctor') {
            $doctorUsername = $currentUser->username;
            $doctorName = $this->_getUsernameToName($doctorUsername);
            
            $query = $this->Doctors->find()
                ->contain(['Departments'])
                ->where([
                    'OR' => [
                        ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                        ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%'],
                        ['Doctors.name LIKE' => '%Doctor ' . $doctorName . '%']
                    ]
                ]);
        } else {
            // Admin and patients can see all doctors
            $query = $this->Doctors->find()->contain(['Departments']);
        }
        
        $doctors = $this->paginate($query);
        $this->set(compact('doctors'));
    }

    public function view($id = null)
    {
        $doctor = $this->Doctors->get($id, [
            'contain' => ['Departments', 'Appointments' => ['Patients']],
        ]);

        $currentUser = $this->Authentication->getIdentity();
        
        // If the logged-in user is a doctor, only show their own appointments
        if ($currentUser && $currentUser->role === 'doctor') {
            // Get the current doctor's ID
            $doctorUsername = $currentUser->username;
            $doctorName = $this->_getUsernameToName($doctorUsername);
            
            $currentDoctor = $this->Doctors->find()
                ->where([
                    'OR' => [
                        ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                        ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%']
                    ]
                ])
                ->first();
            
            if ($currentDoctor && $doctor->id == $currentDoctor->id) {
                // Viewing their own profile - show all their appointments
                $doctor->appointments = array_filter($doctor->appointments, function($appt) use ($doctor) {
                    return $appt->doctor_id == $doctor->id;
                });
            } else {
                // Viewing another doctor's profile - show no appointments for privacy
                $doctor->appointments = [];
            }
        }

        $this->set(compact('doctor'));
    }

    public function add()
    {
        $doctor = $this->Doctors->newEmptyEntity();
        if ($this->request->is('post')) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $departments = $this->Doctors->Departments->find('list', ['limit' => 200])->where(['status' => 'active']);
        $this->set(compact('doctor', 'departments'));
    }

    public function edit($id = null)
    {
        $currentUser = $this->Authentication->getIdentity();
        
        // If doctor is logged in, only allow them to edit their own profile
        if ($currentUser && $currentUser->role === 'doctor') {
            $doctorUsername = $currentUser->username;
            $doctorName = $this->_getUsernameToName($doctorUsername);
            
            $currentDoctor = $this->Doctors->find()
                ->where([
                    'OR' => [
                        ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                        ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%']
                    ]
                ])
                ->first();
            
            if (!$currentDoctor || $currentDoctor->id != $id) {
                $this->Flash->error(__('You can only edit your own profile.'));
                return $this->redirect(['action' => 'dashboard']);
            }
        }
        
        $doctor = $this->Doctors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        $departments = $this->Doctors->Departments->find('list', ['limit' => 200])->where(['status' => 'active']);
        $this->set(compact('doctor', 'departments'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        // Only admins can delete doctors
        $currentUser = $this->Authentication->getIdentity();
        if ($currentUser->role !== 'admin') {
            $this->Flash->error(__('Only administrators can delete doctor profiles.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $doctor = $this->Doctors->get($id);
        if ($this->Doctors->delete($doctor)) {
            $this->Flash->success(__('The doctor has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Doctor dashboard - shows doctor's own appointments and patients
     */
    public function dashboard()
    {
        $currentUser = $this->Authentication->getIdentity();
        
        // Find doctor record by matching username pattern
        $doctorUsername = $currentUser->username;
        $doctorName = $this->_getUsernameToName($doctorUsername);
        
        $doctor = $this->Doctors->find()
            ->contain(['Departments'])
            ->where([
                'OR' => [
                    ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                    ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%'],
                    ['Doctors.name LIKE' => '%Doctor ' . $doctorName . '%']
                ]
            ])
            ->first();

        if (!$doctor) {
            // Create fallback doctor object for display
            $doctor = (object)[
                'name' => 'Dr. ' . $doctorName,
                'department' => (object)['name' => 'Unknown Department'],
                'id' => null
            ];
            
            $todaysAppointments = [];
            $upcomingAppointments = [];
            $totalPatients = 0;
            $todaysCount = 0;
            $totalAppointments = 0;
            
            $this->Flash->warning(__('Doctor profile setup incomplete. Showing limited dashboard.'));
        } else {
            // Get doctor's appointments for today
            $todaysAppointments = $this->Doctors->Appointments->find()
                ->contain(['Patients'])
                ->where([
                    'doctor_id' => $doctor->id,
                    'appointment_date' => date('Y-m-d')
                ])
                ->order(['appointment_time' => 'ASC'])
                ->toArray();

            // Get doctor's upcoming appointments (next 7 days)
            $upcomingAppointments = $this->Doctors->Appointments->find()
                ->contain(['Patients'])
                ->where([
                    'doctor_id' => $doctor->id,
                    'appointment_date >=' => date('Y-m-d'),
                    'appointment_date <=' => date('Y-m-d', strtotime('+7 days'))
                ])
                ->order(['appointment_date' => 'ASC', 'appointment_time' => 'ASC'])
                ->limit(10)
                ->toArray();

            // Get statistics
            $totalPatients = $this->Doctors->Appointments->find()
                ->where(['doctor_id' => $doctor->id])
                ->distinct(['patient_id'])
                ->count();
            
            $todaysCount = count($todaysAppointments);
            
            $totalAppointments = $this->Doctors->Appointments->find()
                ->where(['doctor_id' => $doctor->id])
                ->count();
        }

        $this->set(compact(
            'doctor',
            'todaysAppointments', 
            'upcomingAppointments', 
            'totalPatients', 
            'todaysCount', 
            'totalAppointments',
            'currentUser'
        ));
    }

    /**
     * Convert username to name for matching
     */
    private function _getUsernameToName($username)
    {
        // Convert dr_ahmad or dr.sarah.johnson to Ahmad or Sarah Johnson
        // Remove 'dr.' or 'dr_' prefix if it exists
        $cleanUsername = preg_replace('/^dr[._]/', '', strtolower($username));
        
        // Split by dots, underscores, or hyphens
        $parts = preg_split('/[._-]/', $cleanUsername);
        
        // Capitalize each part
        $nameParts = array_map('ucfirst', $parts);
        
        // Join with spaces
        $result = implode(' ', $nameParts);
        
        return $result;
    }
}
