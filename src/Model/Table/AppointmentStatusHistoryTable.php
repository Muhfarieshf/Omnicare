<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppointmentStatusHistory Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $ChangedByUser
 *
 * @method \App\Model\Entity\AppointmentStatusHistory newEmptyEntity()
 * @method \App\Model\Entity\AppointmentStatusHistory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AppointmentStatusHistory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatusHistory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AppointmentStatusHistory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AppointmentStatusHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AppointmentStatusHistory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatusHistory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AppointmentStatusHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AppointmentStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AppointmentStatusHistory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AppointmentStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AppointmentStatusHistory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AppointmentStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AppointmentStatusHistory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AppointmentStatusHistory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AppointmentStatusHistory> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AppointmentStatusHistoryTable extends Table
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

        $this->setTable('appointment_status_history');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChangedByUser', [
            'className' => 'Users',
            'foreignKey' => 'changed_by',
            'joinType' => 'INNER',
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
            ->integer('appointment_id')
            ->requirePresence('appointment_id', 'create')
            ->notEmptyString('appointment_id');

        $validator
            ->scalar('old_status')
            ->maxLength('old_status', 20)
            ->allowEmptyString('old_status');

        $validator
            ->scalar('new_status')
            ->maxLength('new_status', 20)
            ->requirePresence('new_status', 'create')
            ->notEmptyString('new_status')
            ->inList('new_status', [
                'Scheduled',
                'Confirmed',
                'In Progress',
                'Completed',
                'Cancelled',
                'No Show',
                'Pending Approval'
            ]);

        $validator
            ->integer('changed_by')
            ->requirePresence('changed_by', 'create')
            ->notEmptyString('changed_by');

        $validator
            ->dateTime('changed_at')
            ->allowEmptyDateTime('changed_at');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 45)
            ->allowEmptyString('ip_address');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
{
    $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);
    
    
    $rules->add($rules->existsIn(['changed_by'], 'ChangedByUser'), ['errorField' => 'changed_by']);

    return $rules;
}
    /**
     * Find history for a specific appointment
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findForAppointment(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['AppointmentStatusHistory.appointment_id' => $options['appointment_id']])
            ->order(['AppointmentStatusHistory.changed_at' => 'DESC'])
            ->contain(['ChangedByUser']);
    }

    /**
     * Find history by status change
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findStatusChange(SelectQuery $query, array $options): SelectQuery
    {
        $conditions = [];
        
        if (isset($options['old_status'])) {
            $conditions['AppointmentStatusHistory.old_status'] = $options['old_status'];
        }
        
        if (isset($options['new_status'])) {
            $conditions['AppointmentStatusHistory.new_status'] = $options['new_status'];
        }

        return $query->where($conditions)
            ->order(['AppointmentStatusHistory.changed_at' => 'DESC']);
    }
}




