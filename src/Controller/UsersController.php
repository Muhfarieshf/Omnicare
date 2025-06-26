<?php

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
            $this->Flash->error(__('Invalid username or password. Please try again.'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('You have been successfully logged out.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
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