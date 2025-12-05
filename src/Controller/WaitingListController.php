<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * WaitingList Controller
 *
 * @property \App\Model\Table\WaitingListTable $WaitingList
 */
class WaitingListController extends AppController
{
    public function index()
    {
        $user = $this->Authentication->getIdentity();
        
        $query = $this->WaitingList->find()
            ->contain(['Patients', 'Doctors', 'Departments'])
            ->where(['WaitingList.status IN' => ['pending', 'notified']]) // Only show active requests
            ->order(['WaitingList.priority' => 'ASC', 'WaitingList.created_at' => 'ASC']);

        // Role-based filtering
        if ($user->role === 'patient') {
            // Patients see only their own requests
            $query->where(['WaitingList.patient_id' => $user->patient_id]);
        } elseif ($user->role === 'doctor') {
            // Doctors see requests for themselves OR their department
            $doctorsTable = $this->fetchTable('Doctors');
            try {
                $doctor = $doctorsTable->get($user->doctor_id);
                $query->where([
                    'OR' => [
                        ['WaitingList.doctor_id' => $user->doctor_id],
                        ['WaitingList.department_id' => $doctor->department_id]
                    ]
                ]);
            } catch (\Exception $e) {
                // Fallback if doctor record missing
                $query->where(['WaitingList.doctor_id' => $user->doctor_id]);
            }
        }
        // Admins see everything

        $waitingList = $this->paginate($query);

        $this->set(compact('waitingList', 'user'));
    }

    public function add()
    {
        $waitingList = $this->WaitingList->newEmptyEntity();
        $user = $this->Authentication->getIdentity();
        
        // --- NEW: Pre-fill from URL parameters (GET request) ---
        if ($this->request->is('get')) {
            $waitingList->doctor_id = $this->request->getQuery('doctor_id');
            $waitingList->department_id = $this->request->getQuery('department_id');
            $waitingList->preferred_date = $this->request->getQuery('date');
            
            // Optional: If a specific time was clicked (unlikely for waiting list, but good to have)
            $waitingList->preferred_time = $this->request->getQuery('time');
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Auto-fill patient_id for patients
            if ($user->role === 'patient') {
                $data['patient_id'] = $user->patient_id;
                $data['status'] = 'pending';
                $data['priority'] = 5;
            } else {
                if (empty($data['priority'])) {
                    $data['priority'] = 5;
                }
                $data['status'] = 'pending';
            }

            // Set default duration if missing
            if (empty($data['duration_minutes'])) {
                $data['duration_minutes'] = 30;
            }

            // Handle empty selections
            if (empty($data['doctor_id'])) $data['doctor_id'] = null;
            if (empty($data['department_id'])) $data['department_id'] = null;

            $waitingList = $this->WaitingList->patchEntity($waitingList, $data);
            
            if ($this->WaitingList->save($waitingList)) {
                $this->Flash->success(__('You have been added to the waiting list.'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Could not join the waiting list. Please, try again.'));
        }

        // Load lists
        $patients = $this->WaitingList->Patients->find('list', ['limit' => 200])->where(['status' => 'active']);
        $doctors = $this->WaitingList->Doctors->find('list', ['limit' => 200])->where(['status' => 'active']);
        $departments = $this->WaitingList->Departments->find('list', ['limit' => 200])->where(['status' => 'active']);
        
        // NEW: Get mapping of Doctor ID -> Department ID for JavaScript
        $doctorDepartments = $this->WaitingList->Doctors->find()
            ->select(['id', 'department_id'])
            ->where(['status' => 'active'])
            ->all()
            ->combine('id', 'department_id')
            ->toArray();
        
        $this->set(compact('waitingList', 'patients', 'doctors', 'departments', 'user', 'doctorDepartments'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $waitingList = $this->WaitingList->get($id);
        
        $user = $this->Authentication->getIdentity();
        
        // Security: Patients can only delete their own
        if ($user->role === 'patient' && $waitingList->patient_id !== $user->patient_id) {
            $this->Flash->error(__('Access denied.'));
            return $this->redirect(['action' => 'index']);
        }

        // Soft delete by marking as cancelled, or hard delete?
        // Let's hard delete for now to keep the list clean, or update status to 'cancelled'
        if ($this->WaitingList->delete($waitingList)) {
            $this->Flash->success(__('Removed from waiting list.'));
        } else {
            $this->Flash->error(__('Could not be removed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}