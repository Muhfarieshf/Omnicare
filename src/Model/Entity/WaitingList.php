<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class WaitingList extends Entity
{
    protected array $_accessible = [
        'patient_id' => true,
        'doctor_id' => true,
        'department_id' => true,
        'preferred_date' => true,
        'preferred_time' => true,
        'duration_minutes' => true,
        'priority' => true,
        'status' => true,
        'notes' => true,
        'notified_at' => true,
        'fulfilled_at' => true,
        'fulfilled_appointment_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'patient' => true,
        'doctor' => true,
        'department' => true,
        'fulfilled_appointment' => true,
    ];

    /**
     * Get priority label
     *
     * @return string
     */
    protected function _getPriorityLabel()
    {
        $priorities = [
            1 => 'Highest',
            2 => 'Very High',
            3 => 'High',
            4 => 'Medium-High',
            5 => 'Medium',
            6 => 'Medium-Low',
            7 => 'Low',
            8 => 'Very Low',
            9 => 'Lowest',
            10 => 'Lowest',
        ];

        return $priorities[$this->priority] ?? 'Medium';
    }

    /**
     * Check if entry is pending
     *
     * @return bool
     */
    protected function _getIsPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if entry is fulfilled
     *
     * @return bool
     */
    protected function _getIsFulfilled()
    {
        return $this->status === 'fulfilled';
    }

    /**
     * Check if entry is cancelled
     *
     * @return bool
     */
    protected function _getIsCancelled()
    {
        return $this->status === 'cancelled';
    }
}




