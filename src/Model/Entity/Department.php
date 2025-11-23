<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Department extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'status' => true,
        'created_at' => true,
        'updated_at' => true,
        'doctors' => true,
        'waiting_list' => true,
    ];
}