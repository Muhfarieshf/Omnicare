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
        'status' => true,
        'remarks' => true,
        'created_at' => true,
        'updated_at' => true,
        'patient' => true,
        'doctor' => true,
    ];
}