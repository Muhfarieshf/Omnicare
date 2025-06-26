<?php

namespace App\Controller;

use App\Controller\AppController;

class DoctorsController extends AppController
{
    public function index()
    {
        $query = $this->Doctors->find()->contain(['Departments']);
        $doctors = $this->paginate($query);
        $this->set(compact('doctors'));
    }

    public function view($id = null)
    {
        $doctor = $this->Doctors->get($id, [
            'contain' => ['Departments', 'Appointments.Patients']
        ]);
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
        
        $departments = $this->Doctors->Departments->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 'active']);
        
        $this->set(compact('doctor', 'departments'));
    }

    public function edit($id = null)
    {
        $doctor = $this->Doctors->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The doctor could not be saved. Please, try again.'));
        }
        
        $departments = $this->Doctors->Departments->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->where(['status' => 'active']);
        
        $this->set(compact('doctor', 'departments'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctor = $this->Doctors->get($id);
        if ($this->Doctors->delete($doctor)) {
            $this->Flash->success(__('The doctor has been deleted.'));
        } else {
            $this->Flash->error(__('The doctor could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function dashboard()
    {
        $currentUser = $this->Authentication->getIdentity();
        
        if (!$currentUser) {
            $this->Flash->error('Please log in to access your dashboard.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        // Get the user's doctor_id
        $doctorId = $currentUser->doctor_id;
        
        // Initialize variables with defaults
        $todaysAppointments = [];
        $upcomingAppointments = [];
        $doctorInfo = null;
        $appointmentStats = [
            'today_count' => 0,
            'pending_count' => 0,
            'completed_today' => 0
        ];
        
        if (!$doctorId) {
            $this->Flash->error('Your account is not properly set up as a doctor. Please contact support.');
            $this->set(compact('todaysAppointments', 'upcomingAppointments', 'doctorInfo', 'appointmentStats', 'currentUser'));
            return;
        }

        try {
            // Get doctor information first
            $doctorInfo = $this->Doctors->get($doctorId, ['contain' => ['Departments']]);
            
            // Get doctor's appointments for today
            $todaysAppointments = $this->Doctors->Appointments->find()
                ->contain(['Patients'])
                ->where([
                    'Appointments.doctor_id IS' => $doctorId,
                    'Appointments.appointment_date' => date('Y-m-d')
                ])
                ->order(['Appointments.appointment_time' => 'ASC'])
                ->toArray();

            // Get upcoming appointments (next 7 days)
            $upcomingAppointments = $this->Doctors->Appointments->find()
                ->contain(['Patients'])
                ->where([
                    'Appointments.doctor_id IS' => $doctorId,
                    'Appointments.appointment_date >=' => date('Y-m-d'),
                    'Appointments.appointment_date <=' => date('Y-m-d', strtotime('+7 days'))
                ])
                ->order(['Appointments.appointment_date' => 'ASC', 'Appointments.appointment_time' => 'ASC'])
                ->limit(10)
                ->toArray();

            // Calculate statistics
            $appointmentStats['today_count'] = count($todaysAppointments);
            $appointmentStats['completed_today'] = count(array_filter($todaysAppointments, function($apt) {
                return $apt->status === 'Completed';
            }));
            $appointmentStats['pending_count'] = count(array_filter($todaysAppointments, function($apt) {
                return $apt->status === 'Scheduled';
            }));

        } catch (\Exception $e) {
            $this->Flash->warning('Unable to load some dashboard data at this time.');
        }

        // Always set all variables
        $this->set(compact('todaysAppointments', 'upcomingAppointments', 'doctorInfo', 'appointmentStats', 'currentUser'));
    }
}