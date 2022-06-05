<?php
namespace App\Model\Table;

use App\Model\Entity\CoreCustomer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreCustomers Model
 */
class CoreCustomersTable extends Table
{

    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'core_seller_id' => [
            'type' => 'value'
        ],
        'firstname' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'lastname' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'email' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'created' => [
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
        $this->table('core_customers');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->addBehavior('Ocl', ['identifier' => 'core_seller_id']);
        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoreUsers', [
            'foreignKey' => 'core_user_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('DefaultShippingAddresses', [
            'className' => 'CoreCustomerAddresses',
            'foreignKey' => 'default_shipping_address_id',
            'propertyName' => 'default_shipping_address'
        ]);
        $this->belongsTo('DefaultBillingAddresses', [
            'className' => 'CoreCustomerAddresses',
            'foreignKey' => 'default_billing_address_id',
            'propertyName' => 'default_billing_address'
        ]);
        $this->hasMany('CoreCustomerAddresses', [
            'foreignKey' => 'core_customer_id'
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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname')
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

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
        $rules->add($rules->existsIn(['core_seller_id'], 'CoreSellers'));
        $rules->add($rules->existsIn(['default_shipping_address_id'], 'DefaultShippingAddresses'));
        $rules->add($rules->existsIn(['default_billing_address_id'], 'DefaultBillingAddresses'));
        return $rules;
    }

    /**
     * Get total number of customers, which belongs to certain user or seller
     *
     * @param mixed $identifier
     * @return mixed
     */
    public function getTotalNumberOfCustomers($identifier)
    {
        $query = $this->find();
        $query->where([
            $this->alias() . '.' . key($identifier) => $identifier[key($identifier)]
        ]);

        $query->select([
            'value' => $query->func()->count('*'),
        ]);

        $numberOfCustomers = $query->first();
        return $numberOfCustomers;
    }
}
