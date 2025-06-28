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
        
        // Remove confirm_password from the data since it's not a database field
        unset($data['confirm_password']);
        
        // Set default role for new registrations (assuming patients)
        $data['role'] = 'patient';
        
        $user = $this->Users->patchEntity($user, $data);
        
        // Hash the password
        if (!empty($user->password)) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        }
        
        if ($this->Users->save($user)) {
            $this->Flash->success(__('Registration successful! You can now login with your credentials.'));
            return $this->redirect(['action' => 'login']);
        } else {
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

    // Temporary test method - remove after testing
    public function testAuth()
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            echo "Authenticated as: " . $identity->username . " (Role: " . $identity->role . ")";
        } else {
            echo "Not authenticated";
        }
        exit;
    }

    // Temporary method to clear all session data - remove after testing
    public function clearSession()
    {
        $this->Authentication->logout();
        $this->request->getSession()->destroy();
        $this->request->getSession()->renew();
        
        // Note: Cookie clearing simplified for CakePHP 5.x compatibility
        // Session destruction handles most cleanup
        
        echo "Session cleared completely. You can now try logging in.";
        echo '<br><a href="/users/login">Go to Login</a>';
        exit;
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

    // Debug doctor lookup
    public function debugDoctor()
    {
        $user = $this->Authentication->getIdentity();
        if (!$user) {
            echo "Not logged in";
            exit;
        }
        
        echo "<h3>Debug Doctor Lookup</h3>";
        echo "Username: " . $user->username . "<br>";
        echo "Role: " . $user->role . "<br><br>";
        
        // Test username conversion (copy method from DoctorsController)
        $doctorName = $this->_convertUsernameToName($user->username);
        echo "Converted name: " . $doctorName . "<br><br>";
        
        // Load Doctors table
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        
        // Show all doctors
        echo "<h4>All Doctors in Database:</h4>";
        $allDoctors = $doctorsTable->find()->contain(['Departments'])->toArray();
        foreach ($allDoctors as $doc) {
            echo "ID: " . $doc->id . " - Name: '" . $doc->name . "' - Dept: " . $doc->department->name . "<br>";
        }
        
        // Try to find the doctor
        echo "<br><h4>Search Results for '" . $doctorName . "':</h4>";
        $doctor = $doctorsTable->find()
            ->contain(['Departments'])
            ->where([
                'OR' => [
                    ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                    ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%'],
                    ['Doctors.name LIKE' => '%Doctor ' . $doctorName . '%']
                ]
            ])
            ->first();
            
        if ($doctor) {
            echo "✅ Found doctor: '" . $doctor->name . "' (ID: " . $doctor->id . ")";
        } else {
            echo "❌ No doctor found for: '" . $doctorName . "'";
            
            // Try different search patterns
            echo "<br><br><h4>Trying Alternative Searches:</h4>";
            
            // Search 1: Exact username
            $search1 = $doctorsTable->find()->where(['Doctors.name LIKE' => '%' . $user->username . '%'])->first();
            echo "Search 1 (username '" . $user->username . "'): " . ($search1 ? "Found: " . $search1->name : "Not found") . "<br>";
            
            // Search 2: Ahmad only
            $search2 = $doctorsTable->find()->where(['Doctors.name LIKE' => '%Ahmad%'])->first();
            echo "Search 2 ('Ahmad'): " . ($search2 ? "Found: " . $search2->name : "Not found") . "<br>";
            
            // Search 3: Case insensitive
            $search3 = $doctorsTable->find()->where(['LOWER(Doctors.name) LIKE' => '%' . strtolower($doctorName) . '%'])->first();
            echo "Search 3 (case insensitive '" . strtolower($doctorName) . "'): " . ($search3 ? "Found: " . $search3->name : "Not found") . "<br>";
        }
        
        exit;
    }

    

    /**
     * Convert username to name for matching (copy from DoctorsController)
     */
    private function _convertUsernameToName($username)
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