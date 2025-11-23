<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\Table\AppointmentsTable;
use App\Model\Table\DoctorSchedulesTable;
use App\Model\Table\DoctorsTable;
use App\Model\Table\WaitingListTable;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Smart Scheduling Service
 * 
 * Handles availability suggestions, alternative doctor recommendations,
 * and waiting list management.
 */
class SmartSchedulingService
{
    use LocatorAwareTrait;

    protected AppointmentsTable $appointmentsTable;
    protected DoctorSchedulesTable $doctorSchedulesTable;
    protected DoctorsTable $doctorsTable;
    protected WaitingListTable $waitingListTable;
    protected AppointmentConflictService $conflictService;

    public function __construct()
    {
        $tableLocator = $this->getTableLocator();
        $this->appointmentsTable = $tableLocator->get('Appointments');
        $this->doctorSchedulesTable = $tableLocator->get('DoctorSchedules');
        $this->doctorsTable = $tableLocator->get('Doctors');
        $this->waitingListTable = $tableLocator->get('WaitingList');
        $this->conflictService = new AppointmentConflictService();
    }

    /**
     * Get available time slots for a doctor on a specific date
     *
     * @param int $doctorId Doctor ID
     * @param string|\Cake\I18n\Date $date Date to check
     * @param int $durationMinutes Appointment duration in minutes (default: 30)
     * @param int $slotIntervalMinutes Time slot interval in minutes (default: 30)
     * @return array Available time slots
     */
    public function getAvailableTimeSlots(
        int $doctorId,
        $date,
        int $durationMinutes = 30,
        int $slotIntervalMinutes = 30
    ): array {
        if (is_string($date)) {
            $date = new Date($date);
        }

        // Get doctor's schedule for this day of week
        $dayOfWeek = (int)$date->format('w'); // 0 = Sunday, 6 = Saturday
        $schedule = $this->doctorSchedulesTable->find()
            ->where([
                'doctor_id' => $doctorId,
                'day_of_week' => $dayOfWeek,
                'is_available' => true
            ])
            ->first();

        if (!$schedule) {
            return []; // Doctor not available on this day
        }

        // Get existing appointments for this doctor on this date
        $existingAppointments = $this->appointmentsTable->find()
            ->where([
                'doctor_id' => $doctorId,
                'appointment_date' => $date,
                'status IN' => ['Scheduled', 'Confirmed', 'In Progress', 'Pending Approval']
            ])
            ->toArray();

        // Generate time slots
        $availableSlots = [];
        $startTime = Time::createFromFormat('H:i:s', $schedule->start_time->format('H:i:s'));
        $endTime = Time::createFromFormat('H:i:s', $schedule->end_time->format('H:i:s'));

        $currentTime = $startTime->copy();
        $now = Time::now();

        // If checking for today, start from current time + buffer
        if ($date->isToday()) {
            $currentHour = (int)$now->format('H');
            $currentMinute = (int)$now->format('i');
            // Round up to next slot
            $bufferMinutes = 30 - ($currentMinute % 30);
            $currentTime = Time::createFromFormat('H:i:s', sprintf('%02d:00:00', $currentHour));
            $currentTime = $currentTime->addMinutes($bufferMinutes + 15); // 15 min buffer
        }

        while ($currentTime->lt($endTime)) {
            $slotEnd = $currentTime->copy()->addMinutes($durationMinutes);

            // Check if slot fits within schedule
            if ($slotEnd->lte($endTime)) {
                // Check if slot conflicts with existing appointments
                $isAvailable = true;
                foreach ($existingAppointments as $appointment) {
                    $appointmentStart = Time::createFromFormat('H:i:s', $appointment->appointment_time->format('H:i:s'));
                    $appointmentEnd = $appointmentStart->copy()->addMinutes($appointment->duration_minutes ?? 30);

                    // Check for overlap
                    if ($this->timesOverlap($currentTime, $slotEnd, $appointmentStart, $appointmentEnd)) {
                        $isAvailable = false;
                        break;
                    }
                }

                if ($isAvailable) {
                    $availableSlots[] = [
                        'time' => $currentTime->format('H:i'),
                        'datetime' => $currentTime,
                        'available' => true
                    ];
                }
            }

            $currentTime = $currentTime->addMinutes($slotIntervalMinutes);
        }

        return $availableSlots;
    }

    /**
     * Find alternative doctors in the same department
     *
     * @param int $departmentId Department ID
     * @param string|\Cake\I18n\Date $date Preferred date
     * @param string|\Cake\I18n\Time $time Preferred time
     * @param int $durationMinutes Appointment duration
     * @param int|null $excludeDoctorId Doctor ID to exclude
     * @return array Alternative doctors with availability
     */
    public function findAlternativeDoctors(
        int $departmentId,
        $date,
        $time,
        int $durationMinutes = 30,
        ?int $excludeDoctorId = null
    ): array {
        if (is_string($date)) {
            $date = new Date($date);
        }
        if (is_string($time)) {
            $time = new Time($time);
        }

        // Find all active doctors in the department
        $doctors = $this->doctorsTable->find()
            ->contain(['Departments'])
            ->where([
                'Doctors.department_id' => $departmentId,
                'Doctors.status' => 'active'
            ]);

        if ($excludeDoctorId !== null) {
            $doctors->where(['Doctors.id !=' => $excludeDoctorId]);
        }

        $alternatives = [];

        foreach ($doctors->toArray() as $doctor) {
            // Check availability
            $availability = $this->conflictService->checkDoctorAvailability(
                $doctor->id,
                $date,
                $time,
                $durationMinutes
            );

            // Get available slots near the preferred time
            $availableSlots = $this->getAvailableTimeSlots($doctor->id, $date, $durationMinutes);
            $nearbySlots = $this->findNearbySlots($availableSlots, $time, 2); // Within 2 hours

            $alternatives[] = [
                'doctor' => $doctor,
                'available' => $availability['available'],
                'available_slots' => $nearbySlots,
                'conflicts' => $availability['conflicts']
            ];
        }

        // Sort by availability (available first) and number of slots
        usort($alternatives, function ($a, $b) {
            if ($a['available'] !== $b['available']) {
                return $a['available'] ? -1 : 1;
            }
            return count($b['available_slots']) - count($a['available_slots']);
        });

        return $alternatives;
    }

    /**
     * Suggest best available time for a doctor
     *
     * @param int $doctorId Doctor ID
     * @param string|\Cake\I18n\Date $startDate Start of date range
     * @param string|\Cake\I18n\Date $endDate End of date range
     * @param int $durationMinutes Appointment duration
     * @param string|\Cake\I18n\Time|null $preferredTime Preferred time (optional)
     * @return array Suggested times
     */
    public function suggestBestTime(
        int $doctorId,
        $startDate,
        $endDate,
        int $durationMinutes = 30,
        $preferredTime = null
    ): array {
        if (is_string($startDate)) {
            $startDate = new Date($startDate);
        }
        if (is_string($endDate)) {
            $endDate = new Date($endDate);
        }
        if ($preferredTime && is_string($preferredTime)) {
            $preferredTime = new Time($preferredTime);
        }

        $suggestions = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $slots = $this->getAvailableTimeSlots($doctorId, $currentDate, $durationMinutes);

            if (!empty($slots)) {
                // If preferred time is set, prioritize slots near it
                if ($preferredTime) {
                    $slots = $this->sortSlotsByPreference($slots, $preferredTime);
                }

                $suggestions[] = [
                    'date' => $currentDate->format('Y-m-d'),
                    'date_display' => $currentDate->format('M d, Y'),
                    'slots' => array_slice($slots, 0, 5), // Top 5 slots
                    'total_slots' => count($slots)
                ];
            }

            $currentDate = $currentDate->addDays(1);
        }

        return $suggestions;
    }

    /**
     * Add patient to waiting list
     *
     * @param int $patientId Patient ID
     * @param int|null $doctorId Doctor ID (optional)
     * @param int|null $departmentId Department ID (optional)
     * @param string|\Cake\I18n\Date|null $preferredDate Preferred date
     * @param string|\Cake\I18n\Time|null $preferredTime Preferred time
     * @param int $durationMinutes Appointment duration
     * @param int $priority Priority (1-10, 1 = highest)
     * @param string|null $notes Additional notes
     * @return \App\Model\Entity\WaitingList Waiting list entry
     */
    public function addToWaitingList(
        int $patientId,
        ?int $doctorId = null,
        ?int $departmentId = null,
        $preferredDate = null,
        $preferredTime = null,
        int $durationMinutes = 30,
        int $priority = 5,
        ?string $notes = null
    ) {
        if ($preferredDate && is_string($preferredDate)) {
            $preferredDate = new Date($preferredDate);
        }
        if ($preferredTime && is_string($preferredTime)) {
            $preferredTime = new Time($preferredTime);
        }

        $waitingListEntry = $this->waitingListTable->newEntity([
            'patient_id' => $patientId,
            'doctor_id' => $doctorId,
            'department_id' => $departmentId,
            'preferred_date' => $preferredDate,
            'preferred_time' => $preferredTime,
            'duration_minutes' => $durationMinutes,
            'priority' => $priority,
            'status' => 'pending',
            'notes' => $notes
        ]);

        return $this->waitingListTable->save($waitingListEntry);
    }

    /**
     * Notify waiting list when a slot becomes available
     *
     * @param int $appointmentId Cancelled/appointment ID that freed up a slot
     * @return array Notified entries
     */
    public function notifyWaitingList(int $appointmentId): array
    {
        // Get the cancelled appointment
        $appointment = $this->appointmentsTable->get($appointmentId, [
            'contain' => ['Doctors', 'Patients']
        ]);

        if (!$appointment) {
            return [];
        }

        // Find matching waiting list entries
        $waitingListEntries = $this->waitingListTable->find('pending')
            ->contain(['Patients', 'Doctors', 'Departments'])
            ->where([
                'OR' => [
                    'doctor_id' => $appointment->doctor_id,
                    'department_id' => $appointment->doctor->department_id ?? null
                ]
            ])
            ->order(['priority' => 'ASC', 'created_at' => 'ASC'])
            ->limit(10)
            ->toArray();

        $notified = [];

        foreach ($waitingListEntries as $entry) {
            // Check if the freed slot matches the entry's preferences
            $matches = true;

            if ($entry->preferred_date && $entry->preferred_date->format('Y-m-d') !== $appointment->appointment_date->format('Y-m-d')) {
                $matches = false;
            }

            if ($entry->preferred_time && $entry->preferred_time->format('H:i') !== $appointment->appointment_time->format('H:i')) {
                // Allow some flexibility (within 1 hour)
                $timeDiff = abs($entry->preferred_time->diffInMinutes($appointment->appointment_time));
                if ($timeDiff > 60) {
                    $matches = false;
                }
            }

            if ($matches) {
                // Update entry status
                $entry->status = 'notified';
                $entry->notified_at = \Cake\I18n\FrozenTime::now();
                $this->waitingListTable->save($entry);
                $notified[] = $entry;
            }
        }

        return $notified;
    }

    /**
     * Find nearby time slots
     *
     * @param array $slots Available slots
     * @param \Cake\I18n\Time $preferredTime Preferred time
     * @param int $hoursRange Hours range to consider
     * @return array Nearby slots
     */
    protected function findNearbySlots(array $slots, Time $preferredTime, int $hoursRange = 2): array
    {
        $nearby = [];
        $rangeMinutes = $hoursRange * 60;

        foreach ($slots as $slot) {
            if ($slot['datetime'] instanceof Time) {
                $diff = abs($slot['datetime']->diffInMinutes($preferredTime));
                if ($diff <= $rangeMinutes) {
                    $slot['time_diff_minutes'] = $diff;
                    $nearby[] = $slot;
                }
            }
        }

        // Sort by time difference
        usort($nearby, function ($a, $b) {
            return $a['time_diff_minutes'] <=> $b['time_diff_minutes'];
        });

        return $nearby;
    }

    /**
     * Sort slots by preference (closest to preferred time first)
     *
     * @param array $slots Available slots
     * @param \Cake\I18n\Time $preferredTime Preferred time
     * @return array Sorted slots
     */
    protected function sortSlotsByPreference(array $slots, Time $preferredTime): array
    {
        foreach ($slots as &$slot) {
            if ($slot['datetime'] instanceof Time) {
                $slot['time_diff_minutes'] = abs($slot['datetime']->diffInMinutes($preferredTime));
            }
        }

        usort($slots, function ($a, $b) {
            return ($a['time_diff_minutes'] ?? 999) <=> ($b['time_diff_minutes'] ?? 999);
        });

        return $slots;
    }

    /**
     * Check if two time ranges overlap
     *
     * @param \Cake\I18n\Time $start1 Start of first range
     * @param \Cake\I18n\Time $end1 End of first range
     * @param \Cake\I18n\Time $start2 Start of second range
     * @param \Cake\I18n\Time $end2 End of second range
     * @return bool True if ranges overlap
     */
    protected function timesOverlap(Time $start1, Time $end1, Time $start2, Time $end2): bool
    {
        return $start1->lt($end2) && $start2->lt($end1);
    }
}




