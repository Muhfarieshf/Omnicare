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
        
       
        $this->loadComponent('Authorization.Authorization');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Configure the login and logout actions to not require authentication
        $this->Authentication->addUnauthenticatedActions(['login', 'logout', 'testAuth', 'clearSession', 'testRedirect', 'debugDoctor', 'home']);

        // Fix for session/cookie issues after logout: clear identity and session fully
        if ($this->request->getParam('action') === 'logout') {
            $this->Authentication->logout();
            $this->request->getSession()->destroy();
            $this->request->getSession()->renew();
            // Optionally clear the identity cookie if set
            if (isset($_COOKIE['CookieAuth'])) {
                setcookie('CookieAuth', '', time() - 3600, '/');
            }
        }
        
        // Set user identity for views
        if ($identity = $this->Authentication->getIdentity()) {
            $this->set('currentUser', $identity);
            
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

        // Role-specific access control (removed staff role)
        switch ($user['role']) {
            case 'doctor':
                return $this->_checkDoctorAccess($controller, $action);
            case 'patient':
                return $this->_checkPatientAccess($controller, $action);
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
        $restrictedActions = ['delete']; // Doctors can't delete patients

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

    public function dashboard()
    {
        $user = $this->Authentication->getIdentity();
        
        if (!$user) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        switch ($user->role) {
            case 'admin':
                return $this->redirect(['controller' => 'Appointments', 'action' => 'dashboard']);
            case 'doctor':
                return $this->redirect(['controller' => 'Appointments', 'action' => 'dashboard']);
            case 'patient':
                return $this->redirect(['controller' => 'Patients', 'action' => 'dashboard']);
            default:
                $this->Flash->error(__('Invalid user role.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        }
    }

}