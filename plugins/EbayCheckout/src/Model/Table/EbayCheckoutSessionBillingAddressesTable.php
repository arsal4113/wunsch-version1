<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessionBillingAddresses Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessions
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionBillingAddressesTable extends Table
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

        $this->setTable('ebay_checkout_session_billing_addresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->allowEmpty('first_name');

        $validator
            ->allowEmpty('last_name');

        $validator
            ->allowEmpty('address_line_1');

        $validator
            ->allowEmpty('address_line_2');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('country');

        $validator
            ->allowEmpty('county');

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
