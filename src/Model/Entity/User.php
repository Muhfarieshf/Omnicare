<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'role' => true,
        'status' => true,
        'patient_id' => true,    
        'doctor_id' => true,
        'created_at' => true,
        'updated_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}