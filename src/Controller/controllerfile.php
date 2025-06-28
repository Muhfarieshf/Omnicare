<?php
// src/Controller/AppController.php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        
        // Load the Authorization component
        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Configure the login action to not require authentication
        $this->Authentication->addUnauthenticatedActions(['login', 'logout']);
        
        // Set user identity for views
        if ($identity = $this->Authentication->getIdentity()) {
            $this->set('currentUser', $identity);
            
            // TEMPORARILY DISABLE authorization check for testing
            /*
            // Check authorization for authenticated users
            if (!$this->isAuthorized()) {
                $this->Flash->error(__('You are not authorized to access that page.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
            }
            */
        }
    }

    /**
     * Check if user has permission to access the current action
     */
    public function isAuthorized($user = null)
    {
        // Get current user if not provided
        if (!$user) {
            $identity = $this->Authentication->getIdentity();
            $user = $identity ? $identity->getOriginalData() : null;
        }

        if (!$user) {
            return false;
        }

        $controller = $this->request->getParam('controller');
        $action = $this->request->getParam('action');

        // Admin can access everything
        if ($user['role'] === 'admin') {
            return true;
        }

        // Allow access to logout for all authenticated users
        if ($controller === 'Users' && $action === 'logout') {
            return true;
        }

        // Role-specific access control
        switch ($user['role']) {
            case 'doctor':
                return $this->_checkDoctorAccess($controller, $action);
            case 'patient':
                return $this->_checkPatientAccess($controller, $action);
            case 'staff':
                return $this->_checkStaffAccess($controller, $action);
            default:
                return false;
        }
    }

    /**
     * Check doctor access permissions
     */
    private function _checkDoctorAccess($controller, $action)
    {
        $allowedControllers = ['Doctors', 'Appointments', 'Patients'];
        $restrictedActions = ['delete', 'add']; // Doctors can't add/delete patients

        if (!in_array($controller, $allowedControllers)) {
            return false;
        }

        if ($controller === 'Patients' && in_array($action, $restrictedActions)) {
            return false;
        }

        return true;
    }

    /**
     * Check patient access permissions
     */
    private function _checkPatientAccess($controller, $action)
    {
        $allowedControllers = ['Patients', 'Appointments'];
        $allowedActions = ['dashboard', 'view', 'index'];

        return in_array($controller, $allowedControllers) && in_array($action, $allowedActions);
    }

    /**
     * Check staff access permissions
     */
    private function _checkStaffAccess($controller, $action)
    {
        $allowedControllers = ['Appointments', 'Patients', 'Doctors'];
        return in_array($controller, $allowedControllers);
    }
}


// src/Controller/AppointmentsController.php

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
        
        
        if ($this->request->is('post')) {
            // Debug CSRF tokens
            $cookieToken = $this->request->getCookie('csrfToken');
            $bodyToken = $this->request->getData('_csrfToken');
            $headerToken = $this->request->getHeaderLine('X-CSRF-Token');
            
            
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

// src/Controller/DepartmentsController.php

namespace App\Controller;

use App\Controller\AppController;

class DepartmentsController extends AppController
{
    public function index()
    {
        // CakePHP 5.x pagination - pass query directly to paginate()
        $query = $this->Departments->find();
        $departments = $this->paginate($query);
        $this->set(compact('departments'));
    }

    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Doctors'],
        ]);

        $this->set(compact('department'));
    }

    public function add()
    {
        $department = $this->Departments->newEmptyEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $this->set(compact('department'));
    }

    public function edit($id = null)
    {
        $department = $this->Departments->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $this->set(compact('department'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

// src/Controller/DoctorsController.php

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

// src/Controller/PagesController.php

<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/5/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}

// src/Controller/PatientsController.php

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

// src/Controller/UsersController.php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
{
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    
    // If already authenticated, redirect to dashboard
    if ($result->isValid()) {
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Appointments',
            'action' => 'dashboard',
        ]);
        return $this->redirect($redirect);
    }
    
    // If this was a POST request and failed authentication
    if ($this->request->is('post') && !$result->isValid()) {
        // Clear any existing session data to prevent conflicts
        $this->request->getSession()->delete('Auth');
        
        $this->Flash->error(__('Invalid username or password. Please try again.'));
    }
    
    // For GET requests, ensure we have a clean session
    if ($this->request->is('get')) {
        // Regenerate CSRF token for new login attempts
        $this->request->getSession()->renew();
    }
}

    public function logout()
    {
        // Clear authentication first
        $this->Authentication->logout();
        
        // Clear the entire session - this handles most cleanup
        $this->request->getSession()->destroy();
        
        // Regenerate session ID for security
        $this->request->getSession()->renew();
        
        // No need to manually clear cookies since session->destroy() handles this
        // and the manual cookie clearing was causing the TypeError
        
        $this->Flash->success(__('You have been successfully logged out.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    
    // Temporary method to clear all session data - remove after testing
    public function clearSession()
{
    $this->Authentication->logout();
    $this->request->getSession()->destroy();
    $this->request->getSession()->renew();
    
    echo "Session cleared completely. You can now try logging in.";
    echo '<br><a href="/users/login">Go to Login</a>';
    exit;
}
    
    public function checkSession()
    {
        // Temporary debugging method - remove in production
        $session = $this->request->getSession();
        $identity = $this->Authentication->getIdentity();
        
        debug([
            'Session ID' => $session->id(),
            'Session Data' => $session->read(),
            'Authentication Identity' => $identity ? $identity->getOriginalData() : 'No identity',
            'Authentication Result' => $this->Authentication->getResult()->getStatus()
        ]);
        
        exit;
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
