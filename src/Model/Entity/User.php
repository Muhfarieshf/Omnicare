<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'email' => true,
        'role' => true,
        'status' => true,
        'patient_id' => true,    
        'doctor_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'patient' => true,
        'doctor' => true,
        'cancelled_appointments' => true,
        'approved_appointments' => true,
        'appointment_status_history' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}