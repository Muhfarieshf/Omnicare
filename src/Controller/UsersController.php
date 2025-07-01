<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
         $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }

    public function login()
    {
         $this->viewBuilder()->setLayout('auth');

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        // If already authenticated, redirect to dashboard based on role
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            if ($user) {
                switch ($user->role) {
                    case 'doctor':
                        return $this->redirect(['controller' => 'Doctors', 'action' => 'dashboard']);
                    case 'patient':
                        return $this->redirect(['controller' => 'Patients', 'action' => 'dashboard']);
                    case 'admin':
                        return $this->redirect(['controller' => 'Appointments', 'action' => 'dashboard']);
                    default:
                        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }
            }
        }
        
        // If this was a POST request and failed authentication
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password. Please try again.'));
        }
    }

    public function register()
{
    $this->viewBuilder()->setLayout('auth');

    $user = $this->Users->newEmptyEntity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();
        unset($data['confirm_password']);
        $data['role'] = 'patient';
        $data['status'] = 'active';

        // Load Patients table
        $patientsTable = $this->getTableLocator()->get('Patients');

        // Prepare patient data
        $patientData = [
            'name' => $data['name'] ?? ($data['username'] ?? ''),
            'email' => $data['email'] ?? null,
            'gender' => $data['gender'] ?? null,
            'dob' => $data['dob'] ?? null,
            'contact_number' => $data['contact_number'] ?? null,
            'status' => 'active'
        ];

        $patient = $patientsTable->newEmptyEntity();
        $patient = $patientsTable->patchEntity($patient, $patientData);

        if ($patientsTable->save($patient)) {
            // Remove patient_id from data for initial patch
            $userDataWithoutPatientId = $data;
            unset($userDataWithoutPatientId['patient_id']);
            
            $user = $this->Users->patchEntity($user, $userDataWithoutPatientId);
            
            // Set patient_id directly on the entity
            $user->patient_id = $patient->id;
            
        } else {
            $this->Flash->error(__('Could not create patient profile. Please try again.'));
            $this->set(compact('user'));
            return;
        }

        // Hash the password
        if (!empty($user->password)) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }

        if ($this->Users->save($user)) {
            $this->Flash->success(__('Registration successful! You can now login with your credentials.'));
            return $this->redirect(['action' => 'login']);
        } else {
            // Rollback patient if user creation fails
            $patientsTable->delete($patient);
            $this->Flash->error(__('Registration failed. Please check the form for errors and try again.'));
        }
    }

    $this->set(compact('user'));
}

    public function logout()
    {
        // Clear authentication
        $this->Authentication->logout();
        
        // Clear the entire session
        $this->request->getSession()->destroy();
        
        // Regenerate session ID for security
        $this->request->getSession()->renew();
        
        // Note: Cookie clearing removed due to CakePHP 5.x compatibility
        // Cookies will be cleared automatically when session is destroyed
        
        $this->Flash->success(__('You have been successfully logged out.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    // Test redirect logic
    public function testRedirect()
    {
        $user = $this->Authentication->getIdentity();
        if ($user) {
            $redirect = $this->_getRedirectByRole($user->role);
            echo "Current user: " . $user->username . " (Role: " . $user->role . ")<br>";
            echo "Should redirect to: " . json_encode($redirect) . "<br>";
            echo "URL would be: /appointments/dashboard<br>";
            echo '<a href="/appointments/dashboard">Test Direct Link to Admin Dashboard</a>';
        } else {
            echo "Not logged in";
        }
        exit;
    }

    
    

    private function _convertUsernameToName($username)
    {
        // Convert username like 'abc' to 'Abc' or 'john.doe' to 'John Doe'
        $parts = preg_split('/[._-]/', strtolower($username));
        $nameParts = array_map('ucfirst', $parts);
        return implode(' ', $nameParts);
    }


        public function index()
        {
            // CakePHP 5.x pagination - pass query directly to paginate()
            $query = $this->Users->find();
            $users = $this->paginate($query);
            $this->set(compact('users'));
        }

        public function view($id = null)
        {
            $user = $this->Users->get($id);
            // Check for patient_id if user is a patient
            if ($user->role === 'patient' && empty($user->patient_id)) {
                $this->Flash->error('Your patient profile is incomplete. Please contact support.');
                return $this->redirect(['action' => 'logout']);
            }
            $this->set(compact('user'));
        }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            // Hash the password
            if (!empty($user->password)) {
                $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            }
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user "{0}" has been successfully created.', $user->username));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please check the form for errors and try again.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            // Hash the password only if it's provided
            if (!empty($user->password)) {
                $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            }
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user "{0}" has been successfully updated.', $user->username));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please check the form for errors and try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    

}