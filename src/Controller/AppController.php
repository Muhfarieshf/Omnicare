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
        
        // Configure unauthenticated actions
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
        
        // Set user identity for views - but don't check authorization during login
        if ($identity = $this->Authentication->getIdentity()) {
            $this->set('currentUser', $identity);
            
            // Skip authorization check for login/logout actions to prevent conflicts
            $controller = $this->request->getParam('controller');
            $action = $this->request->getParam('action');
            
            if (!($controller === 'Users' && in_array($action, ['login', 'logout', 'register']))) {
                if (!$this->isAuthorized()) {
                    $this->set('authorizationFailed', true);
                }
            }
        }
    }

    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);
        
        // Handle authorization failures after request processing
        if ($this->viewBuilder()->getVar('authorizationFailed')) {
            $this->Flash->error(__('You are not authorized to access that page.'));
            // Redirect to appropriate dashboard instead of logout
            $identity = $this->Authentication->getIdentity();
            if ($identity) {
                $redirect = $this->_getDefaultRedirect($identity->getOriginalData());
                return $this->redirect($redirect);
            }
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Get default redirect based on user role
     */
    private function _getDefaultRedirect($user)
    {
        switch ($user['role']) {
            case 'admin':
            case 'staff':
                return ['controller' => 'Appointments', 'action' => 'dashboard'];
            case 'doctor':
                return ['controller' => 'Doctors', 'action' => 'dashboard'];
            case 'patient':
                return ['controller' => 'Patients', 'action' => 'dashboard'];
            default:
                return ['controller' => 'Appointments', 'action' => 'dashboard'];
        }
    }

    /**
     * Optimized authorization check
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

        // Common actions all authenticated users can access
        $commonActions = ['logout', 'dashboard'];
        if (in_array($action, $commonActions)) {
            return true;
        }

        // Role-specific access control with faster lookups
        return $this->_checkRoleAccess($user['role'], $controller, $action);
    }

    /**
     * Faster role-based access checking
     */
    private function _checkRoleAccess($role, $controller, $action)
    {
        // Define role permissions in arrays for faster lookup
        $permissions = [
            'doctor' => [
                'allowed_controllers' => ['Doctors', 'Appointments', 'Patients'],
                'restricted' => [
                    'Patients' => ['delete', 'add'] // Doctors can't add/delete patients
                ]
            ],
            'patient' => [
                'allowed_controllers' => ['Patients', 'Appointments'],
                'allowed_actions' => ['dashboard', 'view', 'index', 'edit']
            ],
            'staff' => [
                'allowed_controllers' => ['Appointments', 'Patients', 'Doctors', 'Departments']
            ]
        ];

        if (!isset($permissions[$role])) {
            return false;
        }

        $rolePerms = $permissions[$role];

        // Check if controller is allowed
        if (!in_array($controller, $rolePerms['allowed_controllers'])) {
            return false;
        }

        // Check specific restrictions
        if (isset($rolePerms['restricted'][$controller]) && 
            in_array($action, $rolePerms['restricted'][$controller])) {
            return false;
        }

        // Check if specific actions are required (for patients)
        if (isset($rolePerms['allowed_actions']) && 
            !in_array($action, $rolePerms['allowed_actions'])) {
            return false;
        }

        return true;
    }
}