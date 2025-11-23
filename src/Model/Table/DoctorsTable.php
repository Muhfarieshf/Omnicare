<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Doctors Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\HasMany $Appointments
 *
 * @method \App\Model\Entity\Doctor newEmptyEntity()
 * @method \App\Model\Entity\Doctor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Doctor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Doctor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Doctor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Doctor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Doctor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Doctor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Doctor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Doctor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Doctor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Doctor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Doctor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Doctor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Doctor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Doctor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Doctor> deleteManyOrFail(iterable $entities, array $options = [])
 */
class DoctorsTable extends Table
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

        $this->setTable('doctors');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Appointments', [
            'foreignKey' => 'doctor_id',
        ]);
        $this->hasMany('DoctorSchedules', [
            'foreignKey' => 'doctor_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
        $this->hasMany('WaitingList', [
            'foreignKey' => 'doctor_id',
            'dependent' => false,
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('department_id')
            ->notEmptyString('department_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
