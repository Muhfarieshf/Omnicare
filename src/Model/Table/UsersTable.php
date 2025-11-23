<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'LEFT',
        ]);
        
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id', 
            'joinType' => 'LEFT',
        ]);
        
        $this->hasMany('CancelledAppointments', [
            'className' => 'Appointments',
            'foreignKey' => 'cancelled_by',
            'dependent' => false,
        ]);
        
        $this->hasMany('ApprovedAppointments', [
            'className' => 'Appointments',
            'foreignKey' => 'approved_by',
            'dependent' => false,
        ]);
        
        $this->hasMany('AppointmentStatusHistory', [
            'foreignKey' => 'changed_by',
            'dependent' => false,
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password')
            ->minLength('password', 6, 'Password must be at least 6 characters long');

        $validator
            ->scalar('role')
            ->maxLength('role', 20)
            ->requirePresence('role', 'create')
            ->notEmptyString('role')
            ->inList('role', ['admin', 'staff', 'doctor', 'patient']);

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->inList('status', ['active', 'inactive']);

        return $validator;
    }

    // Add validation for registration
    public function validationRegister(Validator $validator): Validator
    {
        $validator = $this->validationDefault($validator);
        
        $validator
            ->add('confirm_password', 'compareWith', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Passwords do not match'
            ]);
            
        return $validator;
    }
}