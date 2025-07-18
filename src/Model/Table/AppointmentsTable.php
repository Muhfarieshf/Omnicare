<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Appointments Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\DoctorsTable&\Cake\ORM\Association\BelongsTo $Doctors
 *
 * @method \App\Model\Entity\Appointment newEmptyEntity()
 * @method \App\Model\Entity\Appointment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Appointment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Appointment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Appointment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Appointment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Appointment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Appointment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Appointment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Appointment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Appointment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Appointment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Appointment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Appointment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Appointment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Appointment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Appointment> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AppointmentsTable extends Table
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

        $this->setTable('appointments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('patient_id')
            ->notEmptyString('patient_id');

        $validator
            ->integer('doctor_id')
            ->notEmptyString('doctor_id');

        $validator
            ->date('appointment_date')
            ->requirePresence('appointment_date', 'create')
            ->notEmptyDate('appointment_date');

        $validator
            ->time('appointment_time')
            ->requirePresence('appointment_time', 'create')
            ->notEmptyTime('appointment_time');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->allowEmptyString('status');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

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
        $rules->add($rules->existsIn(['patient_id'], 'Patients'), ['errorField' => 'patient_id']);
        $rules->add($rules->existsIn(['doctor_id'], 'Doctors'), ['errorField' => 'doctor_id']);

        return $rules;
    }
}
