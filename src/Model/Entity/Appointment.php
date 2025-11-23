<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Appointment extends Entity
{
    protected array $_accessible = [
        'patient_id' => true,
        'doctor_id' => true,
        'appointment_date' => true,
        'appointment_time' => true,
        'duration_minutes' => true,
        'status' => true,
        'remarks' => true,
        'confirmed_at' => true,
        'started_at' => true,
        'completed_at' => true,
        'cancelled_at' => true,
        'cancelled_by' => true,
        'cancellation_reason' => true,
        'requires_approval' => true,
        'approved_by' => true,
        'approved_at' => true,
        'created_at' => true,
        'updated_at' => true,
        'patient' => true,
        'doctor' => true,
        'cancelledByUser' => true,
        'approvedByUser' => true,
        'statusHistory' => true,
    ];

    /**
     * Get appointment end time
     *
     * @return \Cake\I18n\Time|null
     */
    protected function _getEndTime()
    {
        if (!$this->appointment_time || !$this->duration_minutes) {
            return null;
        }

        $start = $this->appointment_time;
        if ($start instanceof \Cake\I18n\Time) {
            // Create a mutable copy to avoid modifying the original
            return $start->copy()->addMinutes($this->duration_minutes);
        }

        return null;
    }

    /**
     * Check if appointment is in the past
     *
     * @return bool
     */
    protected function _getIsPast()
    {
        if (!$this->appointment_date || !$this->appointment_time) {
            return false;
        }

        try {
            $date = $this->appointment_date;
            $time = $this->appointment_time;
            
            // Create a combined datetime
            if ($date instanceof \Cake\I18n\Date && $time instanceof \Cake\I18n\Time) {
                $appointmentDateTime = \Cake\I18n\FrozenTime::create(
                    $date->year,
                    $date->month,
                    $date->day,
                    $time->hour,
                    $time->minute,
                    $time->second
                );
                return $appointmentDateTime->isPast();
            }
        } catch (\Exception $e) {
            // If there's an error, return false
            return false;
        }

        return false;
    }

    /**
     * Check if appointment can be cancelled
     *
     * @return bool
     */
    protected function _getCanBeCancelled()
    {
        $cancellableStatuses = ['Scheduled', 'Confirmed', 'Pending Approval'];
        return in_array($this->status, $cancellableStatuses) && !$this->is_past;
    }
}