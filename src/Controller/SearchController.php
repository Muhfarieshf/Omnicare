<?php

namespace App\Controller;

use App\Controller\AppController;

class SearchController extends AppController
{   

    public function index()
    {
        $currentUser = $this->Authentication->getIdentity();
        $query = $this->request->getQuery('q');
        $results = [];
        
        if (!$currentUser) {
            $this->Flash->error(__('You must be logged in to search.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        if (!empty($query) && strlen(trim($query)) >= 2) {
            try {
                $results = $this->performSearch($query, $currentUser);
            } catch (\Exception $e) {
                \Cake\Log\Log::error('Search error: ' . $e->getMessage());
                $this->Flash->error(__('Search encountered an error. Please try again.'));
            }
        }

        $this->set(compact('query', 'results', 'currentUser'));
    }

    public function quick()
    {
        $this->request->allowMethod(['get', 'post']);
        $currentUser = $this->Authentication->getIdentity();
        $query = $this->request->getQuery('q') ?: $this->request->getData('q');
        
        if (!$currentUser || empty($query) || strlen(trim($query)) < 2) {
            return $this->response->withType('application/json')->withStringBody(json_encode([]));
        }

        try {
            $results = $this->performSearch($query, $currentUser, 5); // Limit to 5 for quick search
            return $this->response->withType('application/json')->withStringBody(json_encode($results));
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Quick search error: ' . $e->getMessage());
            return $this->response->withType('application/json')->withStringBody(json_encode([]));
        }
    }

    private function performSearch($query, $currentUser, $limit = 50)
    {
        $results = [];
        $searchTerm = '%' . trim($query) . '%';

        // Load tables
        $patientsTable = $this->getTableLocator()->get('Patients');
        $appointmentsTable = $this->getTableLocator()->get('Appointments');
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        $departmentsTable = $this->getTableLocator()->get('Departments');
        $usersTable = $this->getTableLocator()->get('Users');

        switch ($currentUser->role) {
            case 'admin':
                $results = array_merge(
                    $this->searchPatients($patientsTable, $searchTerm, $currentUser, $limit),
                    $this->searchAppointments($appointmentsTable, $searchTerm, $currentUser, $limit),
                    $this->searchDoctors($doctorsTable, $searchTerm, $currentUser, $limit),
                    $this->searchDepartments($departmentsTable, $searchTerm, $currentUser, $limit),
                    $this->searchUsers($usersTable, $searchTerm, $currentUser, $limit)
                );
                break;

            case 'doctor':
                $results = array_merge(
                    $this->searchPatients($patientsTable, $searchTerm, $currentUser, $limit),
                    $this->searchAppointments($appointmentsTable, $searchTerm, $currentUser, $limit),
                    $this->searchDoctors($doctorsTable, $searchTerm, $currentUser, $limit) // Own profile
                );
                break;

            case 'patient':
                $results = array_merge(
                    $this->searchAppointments($appointmentsTable, $searchTerm, $currentUser, $limit),
                    $this->searchDoctors($doctorsTable, $searchTerm, $currentUser, $limit) // Doctors they've seen
                );
                break;

            default:
                // Staff or other roles
                $results = array_merge(
                    $this->searchPatients($patientsTable, $searchTerm, $currentUser, $limit),
                    $this->searchAppointments($appointmentsTable, $searchTerm, $currentUser, $limit)
                );
                break;
        }

        // Sort by relevance (exact matches first, then partial matches)
        usort($results, function($a, $b) use ($query) {
            $queryLower = strtolower($query);
            $aTitle = strtolower($a['title']);
            $bTitle = strtolower($b['title']);
            
            // Exact matches first
            if (strpos($aTitle, $queryLower) === 0 && strpos($bTitle, $queryLower) !== 0) return -1;
            if (strpos($bTitle, $queryLower) === 0 && strpos($aTitle, $queryLower) !== 0) return 1;
            
            // Then by type priority (patients > appointments > doctors > others)
            $typePriority = ['patient' => 1, 'appointment' => 2, 'doctor' => 3, 'department' => 4, 'user' => 5];
            return ($typePriority[$a['type']] ?? 99) - ($typePriority[$b['type']] ?? 99);
        });

        return array_slice($results, 0, $limit);
    }

    private function searchPatients($table, $searchTerm, $currentUser, $limit)
    {
        try {
            $query = $table->find()
                ->where([
                    'OR' => [
                        'name LIKE' => $searchTerm,
                        'email LIKE' => $searchTerm,
                        'contact_number LIKE' => $searchTerm
                    ]
                ])
                ->limit($limit);

            // Role-based filtering
            if ($currentUser->role === 'doctor' && !empty($currentUser->doctor_id)) {
                // Only patients that have appointments with this doctor
                $query->matching('Appointments', function($q) use ($currentUser) {
                    return $q->where(['Appointments.doctor_id' => $currentUser->doctor_id]);
                })->distinct(['Patients.id']);
            } elseif ($currentUser->role === 'patient' && !empty($currentUser->patient_id)) {
                // Only their own record
                $query->where(['id' => $currentUser->patient_id]);
            }

            $results = [];
            foreach ($query->toArray() as $patient) {
                $results[] = [
                    'id' => $patient->id,
                    'type' => 'patient',
                    'title' => $patient->name,
                    'subtitle' => $patient->email ?: ($patient->contact_number ?: 'No contact info'),
                    'description' => 'Patient • DOB: ' . ($patient->dob ? $patient->dob->format('M j, Y') : 'Not specified'),
                    'url' => '/patients/view/' . $patient->id,
                    'icon' => 'fas fa-user',
                    'badge' => 'Patient',
                    'badge_class' => 'primary'
                ];
            }

            return $results;
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Error searching patients: ' . $e->getMessage());
            return [];
        }
    }

    private function searchAppointments($table, $searchTerm, $currentUser, $limit)
    {
        try {
            $query = $table->find()
                ->contain(['Patients', 'Doctors'])
                ->where([
                    'OR' => [
                        'Patients.name LIKE' => $searchTerm,
                        'Doctors.name LIKE' => $searchTerm,
                        'status LIKE' => $searchTerm,
                        'remarks LIKE' => $searchTerm  // Fixed: was 'notes', now 'remarks'
                    ]
                ])
                ->limit($limit);

            // Role-based filtering
            if ($currentUser->role === 'doctor' && !empty($currentUser->doctor_id)) {
                $query->where(['doctor_id' => $currentUser->doctor_id]);
            } elseif ($currentUser->role === 'patient' && !empty($currentUser->patient_id)) {
                $query->where(['patient_id' => $currentUser->patient_id]);
            }

            $results = [];
            foreach ($query->toArray() as $appointment) {
                $dateFormatted = $appointment->appointment_date ? $appointment->appointment_date->format('M j, Y') : 'No date';
                $timeFormatted = $appointment->appointment_time ? $appointment->appointment_time->format('g:i A') : 'No time';
                
                $results[] = [
                    'id' => $appointment->id,
                    'type' => 'appointment',
                    'title' => ($appointment->patient->name ?? 'Unknown Patient') . ' → ' . ($appointment->doctor->name ?? 'Unknown Doctor'),
                    'subtitle' => $dateFormatted . ' at ' . $timeFormatted,
                    'description' => 'Appointment • Status: ' . ($appointment->status ?? 'Scheduled'),
                    'url' => '/appointments/view/' . $appointment->id,
                    'icon' => 'fas fa-calendar-check',
                    'badge' => $appointment->status ?? 'Scheduled',
                    'badge_class' => $this->getStatusBadgeClass($appointment->status ?? 'Scheduled')
                ];
            }

            return $results;
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Error searching appointments: ' . $e->getMessage());
            return [];
        }
    }

    private function searchDoctors($table, $searchTerm, $currentUser, $limit)
    {
        try {
            $query = $table->find()
                ->contain(['Departments'])
                ->where([
                    'OR' => [
                        'name LIKE' => $searchTerm,
                        'email LIKE' => $searchTerm  // Removed specialization as it doesn't exist in schema
                    ]
                ])
                ->limit($limit);

            // Role-based filtering
            if ($currentUser->role === 'doctor' && !empty($currentUser->doctor_id)) {
                // Only their own profile
                $query->where(['id' => $currentUser->doctor_id]);
            } elseif ($currentUser->role === 'patient' && !empty($currentUser->patient_id)) {
                // Only doctors they've had appointments with
                $query->matching('Appointments', function($q) use ($currentUser) {
                    return $q->where(['Appointments.patient_id' => $currentUser->patient_id]);
                })->distinct(['Doctors.id']);
            }

            $results = [];
            foreach ($query->toArray() as $doctor) {
                $results[] = [
                    'id' => $doctor->id,
                    'type' => 'doctor',
                    'title' => 'Dr. ' . $doctor->name,
                    'subtitle' => $doctor->department->name ?? 'No Department',
                    'description' => 'Doctor • ' . ($doctor->department->name ?? 'No Department'),
                    'url' => '/doctors/view/' . $doctor->id,
                    'icon' => 'fas fa-user-md',
                    'badge' => 'Doctor',
                    'badge_class' => 'success'
                ];
            }

            return $results;
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Error searching doctors: ' . $e->getMessage());
            return [];
        }
    }

    private function searchDepartments($table, $searchTerm, $currentUser, $limit)
    {
        // Only admin can search departments
        if ($currentUser->role !== 'admin') {
            return [];
        }

        try {
            $query = $table->find()
                ->where([
                    'name LIKE' => $searchTerm  // Removed description as it doesn't exist in schema
                ])
                ->limit($limit);

            $results = [];
            foreach ($query->toArray() as $department) {
                $results[] = [
                    'id' => $department->id,
                    'type' => 'department',
                    'title' => $department->name,
                    'subtitle' => 'Department',
                    'description' => 'Hospital Department',
                    'url' => '/departments/view/' . $department->id,
                    'icon' => 'fas fa-building',
                    'badge' => 'Department',
                    'badge_class' => 'info'
                ];
            }

            return $results;
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Error searching departments: ' . $e->getMessage());
            return [];
        }
    }

    private function searchUsers($table, $searchTerm, $currentUser, $limit)
    {
        // Only admin can search users
        if ($currentUser->role !== 'admin') {
            return [];
        }

        try {
            $query = $table->find()
                ->where([
                    'OR' => [
                        'username LIKE' => $searchTerm,
                        'email LIKE' => $searchTerm
                    ]
                ])
                ->limit($limit);

            $results = [];
            foreach ($query->toArray() as $user) {
                $results[] = [
                    'id' => $user->id,
                    'type' => 'user',
                    'title' => $user->username,
                    'subtitle' => $user->email ?? 'No email',
                    'description' => 'User • Role: ' . ucfirst($user->role),
                    'url' => '/users/view/' . $user->id,
                    'icon' => 'fas fa-user-cog',
                    'badge' => ucfirst($user->role),
                    'badge_class' => $this->getRoleBadgeClass($user->role)
                ];
            }

            return $results;
        } catch (\Exception $e) {
            \Cake\Log\Log::error('Error searching users: ' . $e->getMessage());
            return [];
        }
    }

    private function getStatusBadgeClass($status)
    {
        switch (strtolower($status)) {
            case 'completed': return 'success';
            case 'cancelled': return 'danger';
            case 'no show': return 'warning';
            default: return 'primary';
        }
    }

    private function getRoleBadgeClass($role)
    {
        switch (strtolower($role)) {
            case 'admin': return 'danger';
            case 'doctor': return 'success';
            case 'patient': return 'primary';
            case 'staff': return 'warning';
            default: return 'secondary';
        }
    }
}