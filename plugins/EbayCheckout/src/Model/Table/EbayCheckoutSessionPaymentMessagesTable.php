<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessionPaymentMessages Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessionPayments
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionPaymentMessage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionPaymentMessagesTable extends Table
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

        $this->setTable('ebay_checkout_session_payment_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EbayCheckoutSessionPayments', [
            'foreignKey' => 'ebay_checkout_session_payment_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.EbayCheckoutSessionPayments'
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
            ->allowEmpty('legal_message');

        $validator
            ->integer('required_for_user_confirmation')
            ->allowEmpty('required_for_user_confirmation');

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
        $rules->add($rules->existsIn(['ebay_checkout_session_payment_id'], 'EbayCheckoutSessionPayments'));

        return $rules;
    }
}
