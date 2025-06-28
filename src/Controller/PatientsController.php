<?php

namespace App\Controller;

use App\Controller\AppController;

class PatientsController extends AppController
{
    public function index()
    {
        // CakePHP 5.x pagination - pass query directly to paginate()
        $query = $this->Patients->find();
        $patients = $this->paginate($query);
        $this->set(compact('patients'));
    }

    public function view($id = null)
{
    $currentUser = $this->Authentication->getIdentity();

    // If the user is a patient, always show their own record
    if ($currentUser && $currentUser->role === 'patient') {
        $id = $currentUser->patient_id;
    }

    $patient = $this->Patients->get($id, [
        'contain' => ['Appointments'],
    ]);

    $this->set(compact('patient', 'currentUser'));
}

    public function add()
    {
        $patient = $this->Patients->newEmptyEntity();
        if ($this->request->is('post')) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $this->set(compact('patient'));
    }

    public function edit($id = null)
    {
        $patient = $this->Patients->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $this->set(compact('patient'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patient = $this->Patients->get($id);
        if ($this->Patients->delete($patient)) {
            $this->Flash->success(__('The patient has been deleted.'));
        } else {
            $this->Flash->error(__('The patient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function dashboard()
    {
        $currentUser = $this->Authentication->getIdentity();
       $patientInfo = null;

       if ($currentUser && $currentUser->patient_id) {
        $patientInfo = $this->Patients->find()
            ->where(['id' => $currentUser->patient_id])
            ->first();
    }
        // If admin user somehow reached here, redirect to admin dashboard
        if ($currentUser->role === 'admin') {
            return $this->redirect(['controller' => 'Appointments', 'action' => 'dashboard']);
        }
        
        // If doctor user somehow reached here, redirect to doctor dashboard  
        if ($currentUser->role === 'doctor') {
            return $this->redirect(['controller' => 'Appointments', 'action' => 'dashboard']);
        }
        
        // Only allow patients and staff to access this dashboard
        if (!in_array($currentUser->role, ['patient', 'staff'])) {
            $this->Flash->error(__('Access denied.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        }
        
        // Find patient record by matching username to name
        $patientUsername = $currentUser->username;
        $patientName = $this->_getUsernameToName($patientUsername);
        
        $patient = $this->Patients->find()
            ->where(['Patients.name LIKE' => '%' . $patientName . '%']) // Fix: specify table alias
            ->first();

        if (!$patient) {
            // Set default empty values for display
            $patient = (object)[
                'name' => $currentUser->username,
                'gender' => 'Not specified',
                'dob' => null,
                'contact_number' => 'Not specified',
                'email' => 'Not specified'
            ];
            
            $upcomingAppointments = [];
            $recentAppointments = [];
            $totalAppointments = 0;
            $completedAppointments = 0;
            $upcomingCount = 0;
            
            $this->Flash->warning(__('Your patient profile is not set up. Please contact hospital administration.'));
        } else {
            // Get all upcoming appointments for this patient (regardless of doctor)
            $upcomingAppointments = $this->Patients->Appointments->find()
                ->contain(['Doctors' => ['Departments']])
                ->where([
                    'patient_id' => $patient->id,
                    'appointment_date >=' => date('Y-m-d')
                ])
                ->order(['appointment_date' => 'ASC', 'appointment_time' => 'ASC'])
                ->toArray();

            // Get patient's recent appointments (last 30 days)
            $recentAppointments = $this->Patients->Appointments->find()
                ->contain(['Doctors' => ['Departments']])
                ->where([
                    'patient_id' => $patient->id,
                    'appointment_date <' => date('Y-m-d'),
                    'appointment_date >=' => date('Y-m-d', strtotime('-30 days'))
                ])
                ->order(['appointment_date' => 'DESC'])
                ->limit(5)
                ->toArray();

            // Get statistics
            $totalAppointments = $this->Patients->Appointments->find()
                ->where(['patient_id' => $patient->id])
                ->count();
            
            $completedAppointments = $this->Patients->Appointments->find()
                ->where([
                    'patient_id' => $patient->id,
                    'status' => 'Completed'
                ])
                ->count();

            $upcomingCount = count($upcomingAppointments);
        }

        $this->set(compact(
            'patient',
            'upcomingAppointments', 
            'recentAppointments', 
            'totalAppointments',
            'completedAppointments',
            'upcomingCount',
            'patientInfo',
            'currentUser'
        ));
    }

    /**
     * Convert username to name for matching
     */
    private function _getUsernameToName($username)
    {
        // Convert john.smith to John Smith
        $parts = explode('.', $username);
        return ucwords(implode(' ', $parts));
    }
}