<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DoctorSchedules Controller
 *
 * @property \App\Model\Table\DoctorSchedulesTable $DoctorSchedules
 */
class DoctorSchedulesController extends AppController
{
    public function index()
    {
        $user = $this->Authentication->getIdentity();
        
        $query = $this->DoctorSchedules->find()
            ->contain(['Doctors'])
            ->order([
                'DoctorSchedules.doctor_id' => 'ASC', 
                'DoctorSchedules.day_of_week' => 'ASC', 
                'DoctorSchedules.start_time' => 'ASC'
            ]);

        // If logged in as doctor, only show their own schedule
        if ($user->role === 'doctor') {
            $query->where(['DoctorSchedules.doctor_id' => $user->doctor_id]);
        } elseif ($user->role !== 'admin') {
            $this->Flash->error(__('You are not authorized to view this page.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }

        $doctorSchedules = $this->paginate($query);
        $days = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];

        $this->set(compact('doctorSchedules', 'days', 'user'));
    }

    public function add()
{
    $doctorSchedule = $this->DoctorSchedules->newEmptyEntity();
    $user = $this->Authentication->getIdentity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();
        
        if ($user->role === 'doctor') {
            $data['doctor_id'] = $user->doctor_id;
        }

        $doctorSchedule = $this->DoctorSchedules->patchEntity($doctorSchedule, $data);
        
        if ($this->DoctorSchedules->save($doctorSchedule)) {
            $this->Flash->success(__('The schedule has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        
    }

        // List doctors for Admin selection
        $doctors = $this->DoctorSchedules->Doctors->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'limit' => 200
        ])->where(['status' => 'active']);

        $days = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];
        
        $this->set(compact('doctorSchedule', 'doctors', 'days', 'user'));
    }

    public function edit($id = null)
    {
        $doctorSchedule = $this->DoctorSchedules->get($id, [
            'contain' => [],
        ]);

        $user = $this->Authentication->getIdentity();

        // Security check for doctors
        if ($user->role === 'doctor' && $doctorSchedule->doctor_id !== $user->doctor_id) {
            $this->Flash->error(__('You can only edit your own schedule.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctorSchedule = $this->DoctorSchedules->patchEntity($doctorSchedule, $this->request->getData());
            if ($this->DoctorSchedules->save($doctorSchedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }

        $doctors = $this->DoctorSchedules->Doctors->find('list', ['limit' => 200]);
        $days = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday'];
        
        $this->set(compact('doctorSchedule', 'doctors', 'days', 'user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $doctorSchedule = $this->DoctorSchedules->get($id);
        
        $user = $this->Authentication->getIdentity();
        
        // Security check
        if ($user->role === 'doctor' && $doctorSchedule->doctor_id !== $user->doctor_id) {
            $this->Flash->error(__('Access denied.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->DoctorSchedules->delete($doctorSchedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}