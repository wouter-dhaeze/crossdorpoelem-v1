<?php
namespace App\Model\Table;

use App\Model\Entity\Participant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Participant Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Subscription
 */
class ParticipantTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('participant');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Subscription', [
            'foreignKey' => 'subscription_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        $validator
            ->requirePresence('lname', 'create')
            ->notEmpty('lname');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->add('dob', 'valid', ['rule' => 'datetime'])
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->allowEmpty('number');

        $validator
            ->add('run_order', 'valid', ['rule' => 'numeric'])
            ->requirePresence('run_order', 'create')
            ->notEmpty('run_order');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['subscription_id'], 'Subscription'));
        return $rules;
    }
}
