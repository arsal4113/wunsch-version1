<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessionShippingAddresses Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessions
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionShippingAddressesTable extends Table
{
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'address_line_1' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'postal_code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'city' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ebay_checkout_session_shipping_addresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('EbayCheckoutSessions', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
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
            ->allowEmpty('recipient');

        $validator
            ->allowEmpty('address_line_1');

        $validator
            ->allowEmpty('address_line_2');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('country');

        $validator
            ->allowEmpty('phone_number');

        $validator
            ->allowEmpty('postal_code');

        $validator
            ->allowEmpty('state_or_province');

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
        $rules->add($rules->existsIn(['ebay_checkout_session_id'], 'EbayCheckoutSessions'));

        return $rules;
    }
}
