<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login', 'register', 'forgotPassword', 'resetPassword']);
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
            // unset($data['confirm_password']); // Checking validation logic
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

                // Assign patient_id
                $user->patient_id = $patient->id;

            } else {
                $this->Flash->error(__('Could not create patient profile. Please try again.'));
                return;
            }

            // Auto-hashing handled by Entity now.
            // Attempt save
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful! You can now login with your credentials.'));
                return $this->redirect(['action' => 'login']);
            } else {
                // Rollback patient if user creation fails
                $patientsTable->delete($patient);

                // Debug failure
                $errors = $user->getErrors();
                $errorMsg = 'Registration failed. ';
                foreach ($errors as $field => $rules) {
                    $errorMsg .= "$field: " . implode(', ', $rules) . ". ";
                }
                $this->Flash->error(__($errorMsg));
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

    public function forgotPassword()
    {
        $this->viewBuilder()->setLayout('auth');

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->find()
                ->where(['email' => $email])
                ->first();

            if ($user) {
                // Generate a secure random token
                $token = bin2hex(random_bytes(32));
                $expiry = new \DateTime('+1 hour');

                // Save token to user
                $user->reset_token = $token;
                $user->token_expiry = $expiry;

                if ($this->Users->save($user)) {
                    // Build reset URL
                    $resetUrl = \Cake\Routing\Router::url([
                        'controller' => 'Users',
                        'action' => 'resetPassword',
                        $token
                    ], true);

                    // Send email using Mailer
                    $mailer = new \App\Mailer\UserMailer();
                    try {
                        $mailer->send('passwordReset', [$user, $resetUrl]);
                        $this->Flash->success(__('Password reset link has been sent to your email address.'));
                    } catch (\Exception $e) {
                        // If email fails, show the link on screen (for development)
                        $this->Flash->warning(__('Email could not be sent. For testing, use this link: ') . $resetUrl);
                    }
                }
            } else {
                // Security: Don't reveal if email exists or not
                $this->Flash->success(__('If an account exists with that email, a reset link has been sent.'));
            }

            return $this->redirect(['action' => 'forgotPassword']);
        }
    }

    public function resetPassword($token = null)
    {
        $this->viewBuilder()->setLayout('auth');

        if (!$token) {
            $this->Flash->error(__('Invalid or missing reset token.'));
            return $this->redirect(['action' => 'login']);
        }

        // Find user by token and check expiry
        $user = $this->Users->find()
            ->where([
                'reset_token' => $token,
                'token_expiry >=' => new \DateTime()
            ])
            ->first();

        if (!$user) {
            $this->Flash->error(__('Invalid or expired reset token. Please request a new one.'));
            return $this->redirect(['action' => 'forgotPassword']);
        }

        if ($this->request->is('post')) {
            $password = $this->request->getData('password');
            $confirmPassword = $this->request->getData('confirm_password');

            if ($password !== $confirmPassword) {
                $this->Flash->error(__('Passwords do not match.'));
                return;
            }

            if (strlen($password) < 6) {
                $this->Flash->error(__('Password must be at least 6 characters long.'));
                return;
            }

            // Update password and clear token
            $user->password = $password; // Entity handles hashing
            $user->reset_token = null;
            $user->token_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been reset successfully. Please login with your new password.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Could not update password. Please try again.'));
            }
        }
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