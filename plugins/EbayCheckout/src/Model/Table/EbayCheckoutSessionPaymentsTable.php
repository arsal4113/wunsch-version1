<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessionPayments Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessions
 * @property |\Cake\ORM\Association\HasMany $EbayCheckoutSessionPaymentBrands
 * @property |\Cake\ORM\Association\HasMany $EbayCheckoutSessionPaymentMessages
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPayment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionPaymentsTable extends Table
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

        $this->setTable('ebay_checkout_session_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EbayCheckoutSessions', [
            'foreignKey' => 'ebay_checkout_session_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
        ]);
        $this->hasMany('EbayCheckoutSessionPaymentBrands', [
            'foreignKey' => 'ebay_checkout_session_payment_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionPaymentBrands'
        ]);
        $this->hasMany('EbayCheckoutSessionPaymentMessages', [
            'foreignKey' => 'ebay_checkout_session_payment_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionPaymentMessages'
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
            ->allowEmpty('payment_method_type');

        $validator
            ->allowEmpty('label');

        $validator
            ->allowEmpty('logo');

        $validator
            ->allowEmpty('additional_data');

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
