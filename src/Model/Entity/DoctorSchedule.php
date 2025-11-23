<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class DoctorSchedule extends Entity
{
    protected array $_accessible = [
        'doctor_id' => true,
        'day_of_week' => true,
        'start_time' => true,
        'end_time' => true,
        'is_available' => true,
        'notes' => true,
        'created_at' => true,
        'updated_at' => true,
        'doctor' => true,
    ];

    /**
     * Get day name
     *
     * @return string
     */
    protected function _getDayName()
    {
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        return $days[$this->day_of_week] ?? 'Unknown';
    }

    /**
     * Get duration in minutes
     *
     * @return int|null
     */
    protected function _getDurationMinutes()
    {
        if (!$this->start_time || !$this->end_time) {
            return null;
        }

        $start = $this->start_time;
        $end = $this->end_time;

        if ($start instanceof \Cake\I18n\Time && $end instanceof \Cake\I18n\Time) {
            return $end->diffInMinutes($start);
        }

        return null;
    }

    /**
     * Check if time is within schedule
     *
     * @param \Cake\I18n\Time $time Time to check
     * @return bool
     */
    public function isTimeWithinSchedule($time)
    {
        if (!$this->is_available || !$this->start_time || !$this->end_time) {
            return false;
        }

        if ($time instanceof \Cake\I18n\Time) {
            return $time->gte($this->start_time) && $time->lt($this->end_time);
        }

        return false;
    }
}




