<?php
namespace App\Model\Table;

use App\Model\Entity\Member;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Member Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Subscription
 */
class MemberTable extends Table
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

        $this->table('member');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('fname', 'create')
            ->notEmpty('fname');

        $validator
            ->requirePresence('lname', 'create')
            ->notEmpty('lname');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->add('dob', 'valid', ['rule' => 'datetime'])
            ->requirePresence('dob', 'create')
            ->notEmpty('dob');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('pcode', 'create')
            ->notEmpty('pcode');

        $validator
            ->allowEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->add('subscriber', 'valid', ['rule' => 'boolean'])
            ->requirePresence('subscriber', 'create')
            ->notEmpty('subscriber');

        $validator
            ->add('participant', 'valid', ['rule' => 'boolean'])
            ->requirePresence('participant', 'create')
            ->notEmpty('participant');

        $validator
            ->add('validated', 'valid', ['rule' => 'boolean'])
            ->requirePresence('validated', 'create')
            ->notEmpty('validated');

        $validator
            ->add('consent', 'valid', ['rule' => 'boolean'])
            ->requirePresence('consent', 'create')
            ->notEmpty('consent');

        $validator
            ->add('public_profile', 'valid', ['rule' => 'boolean'])
            ->requirePresence('public_profile', 'create')
            ->notEmpty('public_profile');

        $validator
            ->add('sponsor', 'valid', ['rule' => 'boolean'])
            ->requirePresence('sponsor', 'create')
            ->notEmpty('sponsor');

        $validator
            ->allowEmpty('number');

        $validator
            ->requirePresence('wave', 'create')
            ->notEmpty('wave');

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
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['subscription_id'], 'Subscription'));
        return $rules;
    }
}
