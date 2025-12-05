<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaitingList Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\DoctorsTable&\Cake\ORM\Association\BelongsTo $Doctors
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $FulfilledAppointment
 *
 * @method \App\Model\Entity\WaitingList newEmptyEntity()
 * @method \App\Model\Entity\WaitingList newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\WaitingList> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaitingList get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\WaitingList findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\WaitingList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\WaitingList> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaitingList|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\WaitingList saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\WaitingList>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\WaitingList>|false saveMany(iterable $entities, array $data, array $options = [])
 * @method iterable<\App\Model\Entity\WaitingList>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\WaitingList> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\WaitingList>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\WaitingList>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\WaitingList>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\WaitingList> deleteManyOrFail(iterable $entities, array $options = [])
 */
class WaitingListTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('waiting_list');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('FulfilledAppointment', [
            'className' => 'Appointments',
            'foreignKey' => 'fulfilled_appointment_id',
            'joinType' => 'LEFT',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('patient_id')
            ->requirePresence('patient_id', 'create')
            ->notEmptyString('patient_id');

        $validator
            ->integer('doctor_id')
            ->allowEmptyString('doctor_id');

        $validator
            ->integer('department_id')
            ->allowEmptyString('department_id');

        $validator
            ->date('preferred_date')
            ->allowEmptyDate('preferred_date');

        $validator
            ->time('preferred_time')
            ->allowEmptyTime('preferred_time');

        $validator
            ->integer('duration_minutes')
            ->requirePresence('duration_minutes', 'create')
            ->notEmptyString('duration_minutes')
            ->add('duration_minutes', 'validRange', [
                'rule' => function ($value, $context) {
                    return $value >= 15 && $value <= 480;
                },
                'message' => 'Duration must be between 15 and 480 minutes (8 hours)'
            ]);

        $validator
            ->integer('priority')
            ->requirePresence('priority', 'create')
            ->notEmptyString('priority')
            ->add('priority', 'validRange', [
                'rule' => function ($value, $context) {
                    return $value >= 1 && $value <= 10;
                },
                'message' => 'Priority must be between 1 (highest) and 10 (lowest)'
            ]);

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->inList('status', ['pending', 'notified', 'fulfilled', 'cancelled'])
            ->allowEmptyString('status');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->dateTime('notified_at')
            ->allowEmptyDateTime('notified_at');

        $validator
            ->dateTime('fulfilled_at')
            ->allowEmptyDateTime('fulfilled_at');

        $validator
            ->integer('fulfilled_appointment_id')
            ->allowEmptyString('fulfilled_appointment_id');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Existing Foreign Key Rules
        $rules->add($rules->existsIn(['patient_id'], 'Patients'), ['errorField' => 'patient_id']);
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'), [
            'errorField' => 'doctor_id',
            'message' => 'Invalid doctor'
        ]);
        $rules->add($rules->existsIn(['department_id'], 'Departments'), [
            'errorField' => 'department_id',
            'message' => 'Invalid department'
        ]);
        $rules->add($rules->existsIn(['fulfilled_appointment_id'], 'FulfilledAppointment'), [
            'errorField' => 'fulfilled_appointment_id',
            'message' => 'Invalid appointment'
        ]);

        // --- NEW RULE: PREVENT DUPLICATES ---
        // Prevent the same patient from queuing for the exact same date/time preference twice
        $rules->add($rules->isUnique(
            ['patient_id', 'preferred_date', 'preferred_time'],
            'You are already on the waiting list for this preferred date and time.'
        ));

        return $rules;
    }

    /**
     * Find pending entries
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findPending(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['WaitingList.status' => 'pending'])
            ->order(['WaitingList.priority' => 'ASC', 'WaitingList.created_at' => 'ASC']);
    }

    /**
     * Find entries for a specific doctor
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findForDoctor(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['WaitingList.doctor_id' => $options['doctor_id']])
            ->where(['WaitingList.status' => 'pending'])
            ->order(['WaitingList.priority' => 'ASC', 'WaitingList.created_at' => 'ASC']);
    }

    /**
     * Find entries for a specific department
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findForDepartment(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['WaitingList.department_id' => $options['department_id']])
            ->where(['WaitingList.status' => 'pending'])
            ->order(['WaitingList.priority' => 'ASC', 'WaitingList.created_at' => 'ASC']);
    }
}




