<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Table\AppointmentsTable;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Appointment Conflict Detection Service
 * 
 * Handles conflict detection for appointments to prevent double-booking
 * and validate time slots.
 */
class AppointmentConflictService
{
    use LocatorAwareTrait;

    protected AppointmentsTable $appointmentsTable;

    public function __construct()
    {
        $tableLocator = $this->getTableLocator();
        $this->appointmentsTable = $tableLocator->get('Appointments');
    }

    /**
     * Check if doctor is available at the requested time
     *
     * @param int $doctorId Doctor ID
     * @param string|\Cake\I18n\Date $date Appointment date
     * @param string|\Cake\I18n\Time $time Appointment time
     * @param int $durationMinutes Appointment duration in minutes
     * @param int|null $excludeAppointmentId Appointment ID to exclude from check (for updates)
     * @return array ['available' => bool, 'conflicts' => array, 'message' => string]
     */
    public function checkDoctorAvailability(
        int $doctorId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeAppointmentId = null
    ): array {
        // Convert to CakePHP date/time objects if needed
        if (is_string($date)) {
            $date = new \Cake\I18n\Date($date);
        }
        if (is_string($time)) {
            $time = new \Cake\I18n\Time($time);
        }

        // Calculate appointment end time
        $startDateTime = $this->combineDateTime($date, $time);
        $endDateTime = $startDateTime->copy()->addMinutes($durationMinutes);

        // Find conflicting appointments
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
            $conflictMessages[] = sprintf(
                'Doctor has an appointment with %s from %s to %s',
                $conflict->patient->name ?? 'Unknown',
                $conflict->appointment_time->format('H:i'),
                $conflict->appointment_time->copy()->addMinutes($conflict->duration_minutes)->format('H:i')
            );
        }

        return [
            'available' => false,
            'conflicts' => $conflicts,
            'message' => 'Doctor is not available at this time. ' . implode('. ', $conflictMessages)
        ];
    }

    /**
     * Check if patient is available at the requested time
     *
     * @param int $patientId Patient ID
     * @param string|\Cake\I18n\Date $date Appointment date
     * @param string|\Cake\I18n\Time $time Appointment time
     * @param int $durationMinutes Appointment duration in minutes
     * @param int|null $excludeAppointmentId Appointment ID to exclude from check (for updates)
     * @return array ['available' => bool, 'conflicts' => array, 'message' => string]
     */
    public function checkPatientAvailability(
        int $patientId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeAppointmentId = null
    ): array {
        // Convert to CakePHP date/time objects if needed
        if (is_string($date)) {
            $date = new \Cake\I18n\Date($date);
        }
        if (is_string($time)) {
            $time = new \Cake\I18n\Time($time);
        }

        // Calculate appointment end time
        $startDateTime = $this->combineDateTime($date, $time);
        $endDateTime = $startDateTime->copy()->addMinutes($durationMinutes);

        // Find conflicting appointments
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
            $conflictMessages[] = sprintf(
                'Patient has an appointment with Dr. %s from %s to %s',
                $conflict->doctor->name ?? 'Unknown',
                $conflict->appointment_time->format('H:i'),
                $conflict->appointment_time->copy()->addMinutes($conflict->duration_minutes)->format('H:i')
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
     *
     * @param int $doctorId Doctor ID
     * @param int $patientId Patient ID
     * @param string|\Cake\I18n\Date $date Appointment date
     * @param string|\Cake\I18n\Time $time Appointment time
     * @param int $durationMinutes Appointment duration in minutes
     * @param int|null $excludeAppointmentId Appointment ID to exclude from check
     * @return array ['available' => bool, 'doctor_conflicts' => array, 'patient_conflicts' => array, 'message' => string]
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
     *
     * @param int $doctorId Doctor ID
     * @param \Cake\I18n\Date $date Appointment date
     * @param \Cake\I18n\FrozenTime $startDateTime Start datetime
     * @param \Cake\I18n\FrozenTime $endDateTime End datetime
     * @param int|null $excludeAppointmentId Appointment ID to exclude
     * @return array Conflicting appointments
     */
    protected function findConflictingAppointments(
        int $doctorId,
        \Cake\I18n\Date $date,
        \Cake\I18n\FrozenTime $startDateTime,
        \Cake\I18n\FrozenTime $endDateTime,
        ?int $excludeAppointmentId = null
    ): array {
        // Statuses that should be considered as conflicts
        $activeStatuses = ['Scheduled', 'Confirmed', 'In Progress', 'Pending Approval'];

        $query = $this->appointmentsTable->find()
            ->contain(['Patients', 'Doctors'])
            ->where([
                'doctor_id' => $doctorId,
                'appointment_date' => $date,
                'status IN' => $activeStatuses
            ]);

        // Exclude current appointment if updating
        if ($excludeAppointmentId !== null) {
            $query->where(['id !=' => $excludeAppointmentId]);
        }

        $appointments = $query->toArray();
        $conflicts = [];

        foreach ($appointments as $appointment) {
            $appointmentStart = $this->combineDateTime(
                $appointment->appointment_date,
                $appointment->appointment_time
            );
            $appointmentEnd = $appointmentStart->copy()->addMinutes($appointment->duration_minutes ?? 30);

            // Check for time overlap
            if ($this->timesOverlap($startDateTime, $endDateTime, $appointmentStart, $appointmentEnd)) {
                $conflicts[] = $appointment;
            }
        }

        return $conflicts;
    }

    /**
     * Find conflicting appointments for a patient
     *
     * @param int $patientId Patient ID
     * @param \Cake\I18n\Date $date Appointment date
     * @param \Cake\I18n\FrozenTime $startDateTime Start datetime
     * @param \Cake\I18n\FrozenTime $endDateTime End datetime
     * @param int|null $excludeAppointmentId Appointment ID to exclude
     * @return array Conflicting appointments
     */
    protected function findConflictingPatientAppointments(
        int $patientId,
        \Cake\I18n\Date $date,
        \Cake\I18n\FrozenTime $startDateTime,
        \Cake\I18n\FrozenTime $endDateTime,
        ?int $excludeAppointmentId = null
    ): array {
        // Statuses that should be considered as conflicts
        $activeStatuses = ['Scheduled', 'Confirmed', 'In Progress', 'Pending Approval'];

        $query = $this->appointmentsTable->find()
            ->contain(['Patients', 'Doctors'])
            ->where([
                'patient_id' => $patientId,
                'appointment_date' => $date,
                'status IN' => $activeStatuses
            ]);

        // Exclude current appointment if updating
        if ($excludeAppointmentId !== null) {
            $query->where(['id !=' => $excludeAppointmentId]);
        }

        $appointments = $query->toArray();
        $conflicts = [];

        foreach ($appointments as $appointment) {
            $appointmentStart = $this->combineDateTime(
                $appointment->appointment_date,
                $appointment->appointment_time
            );
            $appointmentEnd = $appointmentStart->copy()->addMinutes($appointment->duration_minutes ?? 30);

            // Check for time overlap
            if ($this->timesOverlap($startDateTime, $endDateTime, $appointmentStart, $appointmentEnd)) {
                $conflicts[] = $appointment;
            }
        }

        return $conflicts;
    }

    /**
     * Check if two time ranges overlap
     *
     * @param \Cake\I18n\FrozenTime $start1 Start of first range
     * @param \Cake\I18n\FrozenTime $end1 End of first range
     * @param \Cake\I18n\FrozenTime $start2 Start of second range
     * @param \Cake\I18n\FrozenTime $end2 End of second range
     * @return bool True if ranges overlap
     */
    protected function timesOverlap(
        \Cake\I18n\FrozenTime $start1,
        \Cake\I18n\FrozenTime $end1,
        \Cake\I18n\FrozenTime $start2,
        \Cake\I18n\FrozenTime $end2
    ): bool {
        // Two ranges overlap if: start1 < end2 AND start2 < end1
        return $start1->lt($end2) && $start2->lt($end1);
    }

    /**
     * Combine date and time into a datetime object
     *
     * @param \Cake\I18n\Date|string $date Date
     * @param \Cake\I18n\Time|string $time Time
     * @return \Cake\I18n\FrozenTime Combined datetime
     */
    protected function combineDateTime($date, $time): \Cake\I18n\FrozenTime
    {
        if ($date instanceof \Cake\I18n\Date && $time instanceof \Cake\I18n\Time) {
            return \Cake\I18n\FrozenTime::create(
                $date->year,
                $date->month,
                $date->day,
                $time->hour,
                $time->minute,
                $time->second
            );
        }

        // Fallback for string inputs
        $dateStr = $date instanceof \Cake\I18n\Date ? $date->format('Y-m-d') : $date;
        $timeStr = $time instanceof \Cake\I18n\Time ? $time->format('H:i:s') : $time;
        
        return \Cake\I18n\FrozenTime::createFromFormat('Y-m-d H:i:s', $dateStr . ' ' . $timeStr);
    }
}




