<?php

namespace ItoolCustomer\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Newsletters Model
 *
 * @property \Cake\ORM\Association\BelongsTo|CustomersTable $Customers
 *
 * @method \ItoolCustomer\Model\Entity\Newsletter get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Newsletter findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NewslettersTable extends Table
{
    const DAILY = 'DAILY';
    const WEEKLY = 'WEEKLY';
    const SUBSCRIPTION_TYPES = [
        self::DAILY,
        self::WEEKLY
    ];

    const VALID_EMAIL_SCORE = 0.5;

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('newsletters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.Customers'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->boolean('subscribed')
            ->requirePresence('subscribed', 'create')
            ->notEmpty('subscribed');

        $validator
            ->scalar('subscribe_type')
            ->requirePresence('subscribe_type', 'create')
            ->notEmpty('subscribe_type');

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

        return $rules;
    }

    public function beforeFind($event, Query $query, $options)
    {
        $query->where(['OR' => ['validation_score >=' => static::VALID_EMAIL_SCORE, 'validation_score IS' => null]]);
        return $query;
    }
}
