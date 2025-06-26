<?php

namespace App\Controller;

use App\Controller\AppController;

class AppointmentsController extends AppController
{
    public function index()
    {
        // CakePHP 5.x pagination - pass query directly to paginate()
        $query = $this->Appointments->find()->contain(['Patients', 'Doctors']);
        $appointments = $this->paginate($query);

        $this->set(compact('appointments'));
    }

    public function view($id = null)
    {
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients', 'Doctors'],
        ]);

        $this->set(compact('appointment'));
    }

    public function add()
    {
        $appointment = $this->Appointments->newEmptyEntity();
        
        // DEBUG: Add this temporarily to see what's happening
        if ($this->request->is('post')) {
            // Debug CSRF tokens
            $cookieToken = $this->request->getCookie('csrfToken');
            $bodyToken = $this->request->getData('_csrfToken');
            $headerToken = $this->request->getHeaderLine('X-CSRF-Token');
            
            debug([
                'Cookie Token' => $cookieToken,
                'Body Token' => $bodyToken,
                'Header Token' => $headerToken,
                'Request Data' => $this->request->getData(),
                'All Cookies' => $this->request->getCookieParams()
            ]);
            
            // Continue with normal processing
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
        }
        
        $patients = $this->Appointments->Patients->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'limit' => 200
        ])->where(['status' => 'active']);
        
        $doctors = $this->Appointments->Doctors->find('list', [
            'keyField' => 'id', 
            'valueField' => 'name',
            'limit' => 200
        ])->where(['status' => 'active']);
        
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
        // Get today's appointments
        $todaysAppointments = $this->Appointments->find()
            ->contain(['Patients', 'Doctors'])
            ->where(['appointment_date' => date('Y-m-d')])
            ->order(['appointment_time' => 'ASC'])
            ->toArray();

        // Get upcoming appointments (next 7 days)
        $upcomingAppointments = $this->Appointments->find()
            ->contain(['Patients', 'Doctors'])
            ->where([
                'appointment_date >=' => date('Y-m-d'),
                'appointment_date <=' => date('Y-m-d', strtotime('+7 days'))
            ])
            ->order(['appointment_date' => 'ASC', 'appointment_time' => 'ASC'])
            ->limit(10)
            ->toArray();

        // Get statistics
        $totalPatients = $this->Appointments->Patients->find()->where(['status' => 'active'])->count();
        $totalDoctors = $this->Appointments->Doctors->find()->where(['status' => 'active'])->count();
        $todaysCount = count($todaysAppointments);
        $totalAppointments = $this->Appointments->find()->count();

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