<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DoctorSchedules Model
 *
 * @property \App\Model\Table\DoctorsTable&\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\DoctorSchedule newEmptyEntity()
 * @method \App\Model\Entity\DoctorSchedule newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\DoctorSchedule> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DoctorSchedule get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\DoctorSchedule findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\DoctorSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\DoctorSchedule> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\DoctorSchedule|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\DoctorSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\DoctorSchedule>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DoctorSchedule>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DoctorSchedule>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DoctorSchedule> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DoctorSchedule>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DoctorSchedule>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\DoctorSchedule>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\DoctorSchedule> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DoctorSchedulesTable extends Table
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

        $this->setTable('doctor_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Doctors', [
            'foreignKey' => 'doctor_id',
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
            ->integer('doctor_id')
            ->requirePresence('doctor_id', 'create')
            ->notEmptyString('doctor_id');

        $validator
            ->integer('day_of_week')
            ->requirePresence('day_of_week', 'create')
            ->notEmptyString('day_of_week')
            ->inList('day_of_week', [0, 1, 2, 3, 4, 5, 6], 'Day of week must be between 0 (Sunday) and 6 (Saturday)');

        $validator
            ->time('start_time')
            ->requirePresence('start_time', 'create')
            ->notEmptyTime('start_time');

        $validator
            ->time('end_time')
            ->requirePresence('end_time', 'create')
            ->notEmptyTime('end_time');

        $validator
            ->boolean('is_available')
            ->allowEmptyString('is_available');

        $validator
            ->scalar('notes')
            ->allowEmptyString('notes');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        // Custom validation: end_time must be after start_time
        $validator
            ->add('end_time', 'custom', [
                'rule' => function ($value, $context) {
                    if (isset($context['data']['start_time']) && $value) {
                        $start = new \Cake\I18n\Time($context['data']['start_time']);
                        $end = new \Cake\I18n\Time($value);
                        return $end->gt($start);
                    }
                    return true;
                },
                'message' => 'End time must be after start time'
            ]);

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
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'), ['errorField' => 'doctor_id']);
        
        // Prevent duplicate schedules for the same doctor and day
        $rules->add($rules->isUnique(
            ['doctor_id', 'day_of_week'],
            'This doctor already has a schedule for this day of the week'
        ));

        return $rules;
    }

    /**
     * Find schedules for a specific doctor
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findForDoctor(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['DoctorSchedules.doctor_id' => $options['doctor_id']])
            ->where(['DoctorSchedules.is_available' => true])
            ->order(['DoctorSchedules.day_of_week' => 'ASC']);
    }

    /**
     * Find available schedules for a specific day
     *
     * @param \Cake\ORM\Query\SelectQuery $query Query object
     * @param array $options Options array
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findAvailableForDay(SelectQuery $query, array $options): SelectQuery
    {
        return $query->where(['DoctorSchedules.day_of_week' => $options['day_of_week']])
            ->where(['DoctorSchedules.is_available' => true])
            ->contain(['Doctors']);
    }
}




