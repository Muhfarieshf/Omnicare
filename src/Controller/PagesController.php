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
     * OmniCare Home Page (public, no authentication required)
     */
    public function home(): ?Response
    {
        // Fetch top 3 departments for the homepage
        $departmentsTable = $this->getTableLocator()->get('Departments');
        $featuredDepartments = $departmentsTable->find()
            ->limit(3)
            ->toArray();

        // No authentication required for homepage
        $this->viewBuilder()->setLayout('default');
        $this->set(compact('featuredDepartments'));
        return $this->render('home');
    }

    /**
     * Doctors Page - Display all doctors organized by department
     */
    public function doctors(): ?Response
    {
        $this->viewBuilder()->setLayout('default');

        // Fetch all departments with their doctors
        $departmentsTable = $this->getTableLocator()->get('Departments');
        $departments = $departmentsTable->find()
            ->contain([
                'Doctors' => function ($q) {
                    return $q->where(['Doctors.status' => 'active'])
                        ->order(['Doctors.name' => 'ASC']);
                }
            ])
            ->order(['Departments.name' => 'ASC'])
            ->toArray();

        $this->set(compact('departments'));
        return $this->render('doctors');
    }

    /**
     * Contact Page - Handle contact form submissions
     */
    public function contact(): ?Response
    {
        $this->viewBuilder()->setLayout('default');

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Validate required fields
            $errors = [];
            if (empty($data['name'])) {
                $errors[] = 'Name is required';
            }
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Valid email is required';
            }
            if (empty($data['subject'])) {
                $errors[] = 'Subject is required';
            }
            if (empty($data['message'])) {
                $errors[] = 'Message is required';
            }

            if (empty($errors)) {
                try {
                    $mailer = new \App\Mailer\UserMailer();
                    $mailer->send('contactForm', [$data]);
                    $this->Flash->success(__('Thank you for your message! We will get back to you soon.'));
                    return $this->redirect(['action' => 'contact']);
                } catch (\Exception $e) {
                    $this->Flash->error(__('Sorry, there was an error sending your message. Please try again later.'));
                }
            } else {
                $this->Flash->error(__('Please correct the following errors: ' . implode(', ', $errors)));
            }
        }

        return $this->render('contact');
    }

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
