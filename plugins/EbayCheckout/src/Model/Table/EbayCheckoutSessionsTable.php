<?php

namespace EbayCheckout\Model\Table;

use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckoutSessions Model
 *
 * @property \App\Model\Table\CoreSellersTable|\Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \EbayCheckout\Model\Table\EbayCheckoutsTable|\Cake\ORM\Association\BelongsTo $EbayCheckouts
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable|\Cake\ORM\Association\BelongsTo $SelectedEbayCheckoutSessionPayments
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessions
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionBillingAddressesTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionBillingAddresses
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionItems
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionTotalsTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionTotals
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionPaymentsTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionPayments
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionShippingAddressesTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionShippingAddresses
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionsTable extends Table
{
    use DbCacheTrait;
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'first_name' => [
            'type' => 'value'
        ],
        'last_name' => [
            'type' => 'value'
        ],
        'email' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'ebay_checkout_session_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'purchase_order_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'modified' => [
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

        $this->setTable('ebay_checkout_sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Searchable');
        $this->addBehavior('Timestamp');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER',
            'className' => 'CoreSellers'
        ]);
        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.Customers'
        ]);
        $this->belongsTo('EbayCheckouts', [
            'foreignKey' => 'ebay_checkout_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.EbayCheckouts'
        ]);
        $this->belongsTo('SelectedEbayCheckoutSessionPayments', [
            'foreignKey' => 'selected_ebay_checkout_session_payment_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionPayments'
        ]);
        $this->belongsTo('EbayCheckoutSessions', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
        ]);
        $this->hasOne('EbayCheckoutSessionBillingAddresses', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionBillingAddresses'
        ]);
        $this->hasMany('EbayCheckoutSessionItems', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionItems'
        ]);
        $this->hasMany('EbayCheckoutSessionTotals', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionTotals',
            'sort' => [
                'EbayCheckoutSessionTotals.sort_order' => 'ASC'
            ]
        ]);
        $this->hasMany('EbayCheckoutSessionPayments', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionPayments'
        ]);
        $this->hasOne('EbayCheckoutSessionShippingAddresses', [
            'foreignKey' => 'ebay_checkout_session_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionShippingAddresses'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->allowEmpty('session_token');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('first_name');

        $validator
            ->allowEmpty('last_name');

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
        $rules->add($rules->existsIn(['core_seller_id'], 'CoreSellers'));
        $rules->add($rules->existsIn(['ebay_checkout_id'], 'EbayCheckouts'));
        $rules->add($rules->existsIn(['selected_ebay_checkout_session_payment_id'], 'EbayCheckoutSessionPayments'));

        return $rules;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearUserCache();
        return true;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearUserCache();
        return true;
    }
}
