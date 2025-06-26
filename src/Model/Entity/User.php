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
        'created_at' => true,
        'updated_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];
}