<?php
// src/Model/Entity/Appointment.php
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
// src/Model/Entity/Department.php
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
    ];
}
// src/Model/Entity/Doctor.php
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
// src/Model/Entity/Patient.php
<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Patient extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'email' => true,
        'phone' => true,
        'created_at' => true,
        'updated_at' => true,
        'appointments' => true,
    ];
}
// src/Model/Entity/User.php
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