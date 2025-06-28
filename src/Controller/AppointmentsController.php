<?php

namespace App\Controller;

use App\Controller\AppController;

class AppointmentsController extends AppController
{
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

        $appointments = $this->paginate($query);
        $this->set(compact('appointments'));
    }

    public function view($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients', 'Doctors'],
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

        $this->set(compact('appointment'));
    }

    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }
        $patients = $this->Appointments->Patients->find('list', ['limit' => 200])->where(['status' => 'active']);
        $doctors = $this->Appointments->Doctors->find('list', ['limit' => 200])->where(['status' => 'active']);
        $this->set(compact('appointment', 'patients', 'doctors'));
    }

    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }
        $patients = $this->Appointments->Patients->find('list', ['limit' => 200])->where(['status' => 'active']);
        $doctors = $this->Appointments->Doctors->find('list', ['limit' => 200])->where(['status' => 'active']);
        $this->set(compact('appointment', 'patients', 'doctors'));
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
                ->where(['doctor_id' => $doctorId])
                ->distinct(['patient_id'])
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
}