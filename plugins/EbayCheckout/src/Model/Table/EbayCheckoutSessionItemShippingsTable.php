<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessionItemShippings Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessionItems
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItemShipping findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionItemShippingsTable extends Table
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

        $this->setTable('ebay_checkout_session_item_shippings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EbayCheckoutSessionItems', [
            'foreignKey' => 'ebay_checkout_session_item_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.EbayCheckoutSessionItems'
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
            ->allowEmpty('base_delivery_cost_currency');

        $validator
            ->decimal('base_delivery_cost_value')
            ->allowEmpty('base_delivery_cost_value');

        $validator
            ->allowEmpty('delivery_discount_currency');

        $validator
            ->decimal('delivery_discount_value')
            ->allowEmpty('delivery_discount_value');

        $validator
            ->allowEmpty('additional_unit_cost_currency');

        $validator
            ->decimal('additional_unit_cost_value')
            ->allowEmpty('additional_unit_cost_value');

        $validator
            ->dateTime('max_estimated_delivery_date')
            ->allowEmpty('max_estimated_delivery_date');

        $validator
            ->dateTime('min_estimated_delivery_date')
            ->allowEmpty('min_estimated_delivery_date');

        $validator
            ->integer('selected')
            ->allowEmpty('selected');

        $validator
            ->allowEmpty('shipping_carrier_code');

        $validator
            ->allowEmpty('shipping_service_code');

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
        $rules->add($rules->existsIn(['ebay_checkout_session_item_id'], 'EbayCheckoutSessionItems'));

        return $rules;
    }
}
