<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Patient extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'gender' => true,
        'dob' => true,
        'contact_number' => true,
        'email' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'appointments' => true,
    ];
}