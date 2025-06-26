<?php

namespace App\Controller;

use App\Controller\AppController;

class PatientsController extends AppController
{
    public function index()
    {
        $query = $this->Patients->find();
        $patients = $this->paginate($query);
        $this->set(compact('patients'));
    }

    public function view($id = null)
    {
        $patient = $this->Patients->get($id);
        $this->set(compact('patient'));
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
    
    // Debug: Check what user data we have
    if (!$currentUser) {
        $this->Flash->error('Please log in to access your dashboard.');
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    // Get the user's patient_id
    $patientId = $currentUser->patient_id;
    
    // Initialize variables with defaults
    $myAppointments = [];
    $upcomingAppointments = [];
    $patientInfo = null;
    
    // If no patient_id, this user isn't properly linked to a patient record
    if (!$patientId) {
        $this->Flash->error('Your account is not properly set up. Please contact support.');
        $this->set(compact('myAppointments', 'upcomingAppointments', 'patientInfo', 'currentUser'));
        return;
    }

    try {
        // Get patient information first
        $patientInfo = $this->Patients->get($patientId);
        
        // Get patient's own appointments
        $myAppointments = $this->Patients->Appointments->find()
            ->contain(['Doctors.Departments', 'Patients'])
            ->where(['Appointments.patient_id IS' => $patientId])
            ->order(['Appointments.appointment_date' => 'DESC'])
            ->limit(10)
            ->toArray();

        // Get upcoming appointments
        $upcomingAppointments = $this->Patients->Appointments->find()
            ->contain(['Doctors.Departments'])
            ->where([
                'Appointments.patient_id IS' => $patientId,
                'Appointments.appointment_date >=' => date('Y-m-d')
            ])
            ->order(['Appointments.appointment_date' => 'ASC'])
            ->limit(5)
            ->toArray();

    } catch (\Exception $e) {
        // If there's an error, keep defaults and show warning
        $this->Flash->warning('Unable to load some data at this time.');
    }

    // Always set all variables
    $this->set(compact('myAppointments', 'upcomingAppointments', 'patientInfo', 'currentUser'));
}
}