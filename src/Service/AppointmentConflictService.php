<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Table\AppointmentsTable;
use App\Model\Table\DoctorSchedulesTable;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Appointment Conflict Detection Service
 * Handles conflict detection for appointments to prevent double-booking
 * and validate time slots against doctor schedules.
 */
class AppointmentConflictService
{
    use LocatorAwareTrait;

    protected AppointmentsTable $appointmentsTable;
    protected DoctorSchedulesTable $doctorSchedulesTable;

    public function __construct()
    {
        $tableLocator = $this->getTableLocator();
        $this->appointmentsTable = $tableLocator->get('Appointments');
        $this->doctorSchedulesTable = $tableLocator->get('DoctorSchedules');
    }

    /**
     * Check if doctor is available at the requested time
     */
    public function checkDoctorAvailability(
        int $doctorId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeAppointmentId = null
    ): array {
        if (is_string($date)) {
            $date = new \Cake\I18n\Date($date);
        }

        // --- NEW CHECK: VALIDATE WORKING HOURS ---
        $scheduleCheck = $this->validateDoctorSchedule($doctorId, $date, $time, $durationMinutes);
        if (!$scheduleCheck['available']) {
            return $scheduleCheck;
        }
        // -----------------------------------------

        $startDateTime = $this->combineDateTime($date, $time);
        $endDateTime = $startDateTime->addMinutes($durationMinutes);

        $conflicts = $this->findConflictingAppointments(
            $doctorId,
            $date,
            $startDateTime,
            $endDateTime,
            $excludeAppointmentId
        );

        if (empty($conflicts)) {
            return [
                'available' => true,
                'conflicts' => [],
                'message' => 'Doctor is available at this time.'
            ];
        }

        $conflictMessages = [];
        foreach ($conflicts as $conflict) {
            $conflictStart = $this->combineDateTime($conflict->appointment_date, $conflict->appointment_time);
            $conflictEnd = $conflictStart->addMinutes($conflict->duration_minutes ?? 30);
            
            $conflictMessages[] = sprintf(
                'Doctor has an appointment with %s from %s to %s',
                $conflict->patient->name ?? 'Unknown',
                $conflictStart->format('h:i A'),
                $conflictEnd->format('h:i A')
            );
        }

        return [
            'available' => false,
            'conflicts' => $conflicts,
            'message' => 'Doctor is not available at this time. ' . implode('. ', $conflictMessages)
        ];
    }

    /**
     * Check if the requested time falls within the doctor's working schedule
     */
    protected function validateDoctorSchedule(int $doctorId, \Cake\I18n\Date $date, $time, int $duration): array
    {
        $dayOfWeek = (int)$date->format('w'); // 0 (Sunday) to 6 (Saturday)
        
        $schedule = $this->doctorSchedulesTable->find()
            ->where([
                'doctor_id' => $doctorId,
                'day_of_week' => $dayOfWeek
            ])
            ->first();

        // CHANGE: If NO schedule record exists, we now assume Dr. is AVAILABLE by default
        if (!$schedule) {
            return ['available' => true];
        }

        // Case 1: Record exists and is explicitly marked as "Unavailable"
        if (!$schedule->is_available) {
            return [
                'available' => false,
                'conflicts' => [],
                'message' => 'Doctor has explicitly marked this day as unavailable.'
            ];
        }

        // Case 2: Record exists (Available), but check if appointment is within the specific shift hours
        $reqTime = ($time instanceof \Cake\I18n\Time) ? $time : new \Cake\I18n\Time($time);
        $reqEndTime = $reqTime->addMinutes($duration);

        $shiftStart = $schedule->start_time;
        $shiftEnd = $schedule->end_time;

        // Check if current request fits inside the defined shift
        if ($reqTime->format('H:i:s') < $shiftStart->format('H:i:s') || 
            $reqEndTime->format('H:i:s') > $shiftEnd->format('H:i:s')) {
            
            return [
                'available' => false,
                'conflicts' => [],
                'message' => sprintf(
                    'Appointment is outside working hours (%s - %s) defined for this day.',
                    $shiftStart->format('h:i A'),
                    $shiftEnd->format('h:i A')
                )
            ];
        }

        return ['available' => true];
    }
    
    /**
     * Check if patient is available at the requested time
     */
    public function checkPatientAvailability(
        int $patientId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeAppointmentId = null
    ): array {
        if (is_string($date)) {
            $date = new \Cake\I18n\Date($date);
        }

        $startDateTime = $this->combineDateTime($date, $time);
        $endDateTime = $startDateTime->addMinutes($durationMinutes);

        $conflicts = $this->findConflictingPatientAppointments(
            $patientId,
            $date,
            $startDateTime,
            $endDateTime,
            $excludeAppointmentId
        );

        if (empty($conflicts)) {
            return [
                'available' => true,
                'conflicts' => [],
                'message' => 'Patient is available at this time.'
            ];
        }

        $conflictMessages = [];
        foreach ($conflicts as $conflict) {
            $conflictStart = $this->combineDateTime($conflict->appointment_date, $conflict->appointment_time);
            $conflictEnd = $conflictStart->addMinutes($conflict->duration_minutes ?? 30);

            $docName = $conflict->doctor->name ?? 'Unknown';
            $prefix = (stripos($docName, 'Dr.') === 0) ? '' : 'Dr. ';

            $conflictMessages[] = sprintf(
                'Patient has an appointment with %s%s from %s to %s',
                $prefix,
                $docName,
                $conflictStart->format('h:i A'),
                $conflictEnd->format('h:i A')
            );
        }

        return [
            'available' => false,
            'conflicts' => $conflicts,
            'message' => 'Patient is not available at this time. ' . implode('. ', $conflictMessages)
        ];
    }

    /**
     * Check for conflicts (both doctor and patient)
     */
    public function checkAvailability(
        int $doctorId,
        int $patientId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeAppointmentId = null
    ): array {
        $doctorCheck = $this->checkDoctorAvailability($doctorId, $date, $time, $durationMinutes, $excludeAppointmentId);
        $patientCheck = $this->checkPatientAvailability($patientId, $date, $time, $durationMinutes, $excludeAppointmentId);

        $available = $doctorCheck['available'] && $patientCheck['available'];
        $messages = [];

        if (!$doctorCheck['available']) {
            $messages[] = $doctorCheck['message'];
        }
        if (!$patientCheck['available']) {
            $messages[] = $patientCheck['message'];
        }

        return [
            'available' => $available,
            'doctor_conflicts' => $doctorCheck['conflicts'],
            'patient_conflicts' => $patientCheck['conflicts'],
            'message' => $available ? 'Time slot is available.' : implode(' ', $messages)
        ];
    }

    /**
     * Find conflicting appointments for a doctor
     */
    protected function findConflictingAppointments(
        int $doctorId,
        \Cake\I18n\Date $date,
        \Cake\I18n\FrozenTime $startDateTime,
        \Cake\I18n\FrozenTime $endDateTime,
        ?int $excludeAppointmentId = null
    ): array {
        $activeStatuses = ['Scheduled', 'Confirmed', 'In Progress', 'Pending Approval'];

        $query = $this->appointmentsTable->find()
            ->contain(['Patients', 'Doctors'])
            ->where([
                'Appointments.doctor_id' => $doctorId,
                'Appointments.appointment_date' => $date,
                'Appointments.status IN' => $activeStatuses
            ]);

        if ($excludeAppointmentId !== null) {
            $query->where(['Appointments.id !=' => $excludeAppointmentId]);
        }

        $appointments = $query->toArray();
        $conflicts = [];

        foreach ($appointments as $appointment) {
            $appointmentStart = $this->combineDateTime(
                $appointment->appointment_date,
                $appointment->appointment_time
            );
            $appointmentEnd = $appointmentStart->addMinutes($appointment->duration_minutes ?? 30);

            if ($this->timesOverlap($startDateTime, $endDateTime, $appointmentStart, $appointmentEnd)) {
                $conflicts[] = $appointment;
            }
        }

        return $conflicts;
    }

    /**
     * Find conflicting appointments for a patient
     */
    protected function findConflictingPatientAppointments(
        int $patientId,
        \Cake\I18n\Date $date,
        \Cake\I18n\FrozenTime $startDateTime,
        \Cake\I18n\FrozenTime $endDateTime,
        ?int $excludeAppointmentId = null
    ): array {
        $activeStatuses = ['Scheduled', 'Confirmed', 'In Progress', 'Pending Approval'];

        $query = $this->appointmentsTable->find()
            ->contain(['Patients', 'Doctors'])
            ->where([
                'Appointments.patient_id' => $patientId,
                'Appointments.appointment_date' => $date,
                'Appointments.status IN' => $activeStatuses
            ]);

        if ($excludeAppointmentId !== null) {
            $query->where(['Appointments.id !=' => $excludeAppointmentId]);
        }

        $appointments = $query->toArray();
        $conflicts = [];

        foreach ($appointments as $appointment) {
            $appointmentStart = $this->combineDateTime(
                $appointment->appointment_date,
                $appointment->appointment_time
            );
            $appointmentEnd = $appointmentStart->addMinutes($appointment->duration_minutes ?? 30);

            if ($this->timesOverlap($startDateTime, $endDateTime, $appointmentStart, $appointmentEnd)) {
                $conflicts[] = $appointment;
            }
        }

        return $conflicts;
    }

    protected function timesOverlap(
        \Cake\I18n\FrozenTime $start1,
        \Cake\I18n\FrozenTime $end1,
        \Cake\I18n\FrozenTime $start2,
        \Cake\I18n\FrozenTime $end2
    ): bool {
        return $start1->lessThan($end2) && $start2->lessThan($end1);
    }

    protected function combineDateTime($date, $time): \Cake\I18n\FrozenTime
    {
        $dateStr = $date instanceof \DateTimeInterface ? $date->format('Y-m-d') : (string)$date;
        $timeStr = $time instanceof \DateTimeInterface ? $time->format('H:i:s') : (string)$time;
        
        if (strlen($timeStr) === 5) {
            $timeStr .= ':00';
        }
        if (strlen($timeStr) === 4) {
            $timeStr = '0' . $timeStr . ':00';
        }
        
        return new \Cake\I18n\FrozenTime($dateStr . ' ' . $timeStr);
    }
}