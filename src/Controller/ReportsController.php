<?php
// CREATE FILE: src/Controller/ReportsController.php
namespace App\Controller;

use App\Controller\AppController;

class ReportsController extends AppController
{
    public function index()
    {
        $currentUser = $this->Authentication->getIdentity();
        
        // Role-specific reports
        if ($currentUser->role === 'doctor') {
            return $this->doctorReports();
        } elseif ($currentUser->role === 'admin') {
            return $this->adminReports();
        } elseif ($currentUser->role === 'patient') {
            return $this->patientReports();
        }
        
        $this->Flash->error(__('No reports available for your role.'));
        return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
    }

    private function doctorReports()
    {
        // Find the current doctor
        $doctorUsername = $this->Authentication->getIdentity()->username;
        $doctorName = $this->_convertUsernameToName($doctorUsername);
        
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        $doctor = $doctorsTable->find()
            ->contain(['Departments'])
            ->where([
                'OR' => [
                    ['Doctors.name LIKE' => '%' . $doctorName . '%'],
                    ['Doctors.name LIKE' => '%Dr. ' . $doctorName . '%']
                ]
            ])
            ->first();

        if (!$doctor) {
            $this->Flash->warning(__('Doctor profile not found. Showing limited reports.'));
            $doctor = (object)['id' => null, 'name' => $doctorName];
        }

        // Generate report data
        $reportData = $this->generateDoctorReportData($doctor);
        
        $this->set(compact('doctor', 'reportData'));
        $this->render('doctor_index');
    }

    private function generateDoctorReportData($doctor)
    {
        $appointmentsTable = $this->getTableLocator()->get('Appointments');
        
        if (!$doctor->id) {
            return [
                'todayCount' => 0,
                'weekCount' => 0,
                'monthCount' => 0,
                'completedMonth' => 0,
                'noShowMonth' => 0,
                'cancelledMonth' => 0,
                'totalPatients' => 0,
                'recentAppointments' => []
            ];
        }

        // Today's appointments
        $todayCount = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date' => date('Y-m-d')
            ])->count();

        // This week's appointments
        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd = date('Y-m-d', strtotime('sunday this week'));
        $weekCount = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $weekStart,
                'appointment_date <=' => $weekEnd
            ])->count();

        // This month's appointments by status
        $monthStart = date('Y-m-01');
        $monthEnd = date('Y-m-t');
        
        $monthCount = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd
            ])->count();

        $completedMonth = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'Completed'
            ])->count();

        $noShowMonth = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'No Show'
            ])->count();

        $cancelledMonth = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'Cancelled'
            ])->count();

        // Total unique patients
        $totalPatients = $appointmentsTable->find()
            ->where(['doctor_id' => $doctor->id])
            ->distinct(['patient_id'])
            ->count();

        // Recent appointments for list
        $recentAppointments = $appointmentsTable->find()
            ->contain(['Patients'])
            ->where(['doctor_id' => $doctor->id])
            ->order(['appointment_date' => 'DESC', 'appointment_time' => 'DESC'])
            ->limit(10)
            ->toArray();

        return compact(
            'todayCount', 'weekCount', 'monthCount', 
            'completedMonth', 'noShowMonth', 'cancelledMonth',
            'totalPatients', 'recentAppointments'
        );
    }

    public function printDailySchedule($date = null)
    {
        $date = $date ?: date('Y-m-d');
        $currentUser = $this->Authentication->getIdentity();
        
        // Find doctor
        $doctorUsername = $currentUser->username;
        $doctorName = $this->_convertUsernameToName($doctorUsername);
        
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        $doctor = $doctorsTable->find()
            ->contain(['Departments'])
            ->where(['Doctors.name LIKE' => '%' . $doctorName . '%'])
            ->first();

        if (!$doctor) {
            $this->Flash->error(__('Doctor profile not found.'));
            return $this->redirect(['action' => 'index']);
        }

        // Get appointments for the date
        $appointmentsTable = $this->getTableLocator()->get('Appointments');
        $appointments = $appointmentsTable->find()
            ->contain(['Patients'])
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date' => $date
            ])
            ->order(['appointment_time' => 'ASC'])
            ->toArray();

        $this->viewBuilder()->setLayout('print');
        $this->set(compact('appointments', 'doctor', 'date'));
    }

    public function exportPatients()
    {
        $currentUser = $this->Authentication->getIdentity();
        
        // Find doctor
        $doctorUsername = $currentUser->username;
        $doctorName = $this->_convertUsernameToName($doctorUsername);
        
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        $doctor = $doctorsTable->find()
            ->where(['Doctors.name LIKE' => '%' . $doctorName . '%'])
            ->first();

        if (!$doctor) {
            $this->Flash->error(__('Doctor profile not found.'));
            return $this->redirect(['action' => 'index']);
        }

        // Get unique patients for this doctor
        $patientsTable = $this->getTableLocator()->get('Patients');
        $patients = $patientsTable->find()
            ->matching('Appointments', function($q) use ($doctor) {
                return $q->where(['Appointments.doctor_id' => $doctor->id]);
            })
            ->distinct(['Patients.id'])
            ->toArray();

        // Set response for CSV download
        $this->response = $this->response->withDownload('my_patients_' . date('Y-m-d') . '.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('patients'));
        $this->viewBuilder()->setOptions([
            'serialize' => 'patients',
            'header' => ['ID', 'Name', 'Gender', 'Date of Birth', 'Contact Number', 'Email'],
            'extract' => ['id', 'name', 'gender', 'dob', 'contact_number', 'email']
        ]);
    }

    public function monthlyReport()
    {
        $currentUser = $this->Authentication->getIdentity();
        $month = $this->request->getQuery('month', date('Y-m'));
        
        // Find doctor
        $doctorUsername = $currentUser->username;
        $doctorName = $this->_convertUsernameToName($doctorUsername);
        
        $doctorsTable = $this->getTableLocator()->get('Doctors');
        $doctor = $doctorsTable->find()
            ->contain(['Departments'])
            ->where(['Doctors.name LIKE' => '%' . $doctorName . '%'])
            ->first();

        if (!$doctor) {
            $this->Flash->error(__('Doctor profile not found.'));
            return $this->redirect(['action' => 'index']);
        }

        // Generate detailed monthly statistics
        $reportData = $this->generateMonthlyReport($doctor, $month);
        
        $this->set(compact('doctor', 'month', 'reportData'));
    }

    private function generateMonthlyReport($doctor, $month)
    {
        $appointmentsTable = $this->getTableLocator()->get('Appointments');
        
        $monthStart = $month . '-01';
        $monthEnd = date('Y-m-t', strtotime($monthStart));

        // Detailed statistics
        $totalAppointments = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd
            ])->count();

        $completed = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'Completed'
            ])->count();

        $noShow = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'No Show'
            ])->count();

        $cancelled = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd,
                'status' => 'Cancelled'
            ])->count();

        // Daily breakdown
        $dailyStats = $appointmentsTable->find()
            ->where([
                'doctor_id' => $doctor->id,
                'appointment_date >=' => $monthStart,
                'appointment_date <=' => $monthEnd
            ])
            ->select([
                'appointment_date',
                'count' => $appointmentsTable->find()->func()->count('*')
            ])
            ->group(['appointment_date'])
            ->order(['appointment_date' => 'ASC'])
            ->toArray();

        return compact(
            'totalAppointments', 'completed', 'noShow', 'cancelled', 'dailyStats',
            'monthStart', 'monthEnd'
        );
    }

    private function adminReports()
    {
        // Admin-specific reports implementation
        $this->set('reportType', 'admin');
        $this->render('admin_index');
    }

    private function patientReports()
    {
        // Patient-specific reports implementation  
        $this->set('reportType', 'patient');
        $this->render('patient_index');
    }

    /**
     * Convert username to name for matching
     */
    private function _convertUsernameToName($username)
    {
        $cleanUsername = preg_replace('/^dr[._]/', '', strtolower($username));
        $parts = preg_split('/[._-]/', $cleanUsername);
        $nameParts = array_map('ucfirst', $parts);
        return implode(' ', $nameParts);
    }
}