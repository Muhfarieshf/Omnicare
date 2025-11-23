<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class AppointmentStatusHistory extends Entity
{
    protected array $_accessible = [
        'appointment_id' => true,
        'old_status' => true,
        'new_status' => true,
        'changed_by' => true,
        'changed_at' => true,
        'notes' => true,
        'ip_address' => true,
        'appointment' => true,
        'changedByUser' => true,
    ];

    /**
     * Get status change description
     *
     * @return string
     */
    protected function _getStatusChangeDescription()
    {
        $oldStatus = $this->old_status ?? 'N/A';
        $newStatus = $this->new_status ?? 'N/A';
        
        return "Changed from {$oldStatus} to {$newStatus}";
    }

    /**
     * Check if this is the initial status
     *
     * @return bool
     */
    protected function _getIsInitialStatus()
    {
        return $this->old_status === null || $this->old_status === '';
    }
}




