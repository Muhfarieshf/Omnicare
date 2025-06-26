<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Doctor extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'department_id' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'department' => true,
        'appointments' => true,
    ];
}