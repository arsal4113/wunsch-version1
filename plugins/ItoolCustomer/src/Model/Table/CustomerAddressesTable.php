<?php

namespace ItoolCustomer\Model\Table;

use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerAddresses Model
 *
 * @property \ItoolCustomer\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\CoreCountriesTable|\Cake\ORM\Association\BelongsTo $CoreCountries
 * @property \ItoolCustomer\Model\Table\CustomerAddressTypesTable|\Cake\ORM\Association\BelongsToMany $CustomerAddressTypes
 *
 * @method \ItoolCustomer\Model\Entity\CustomerAddress get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddress findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerAddressesTable extends Table
{
    use DbCacheTrait;
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'street_line_1' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'postal_code' => [
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

        $this->setTable('customer_addresses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
            'className' => 'ItoolCustomer.Customers'
        ]);
        $this->belongsTo('CoreCountries', [
            'foreignKey' => 'core_country_id',
            'joinType' => 'LEFT',
            'className' => 'CoreCountries'
        ]);
        $this->belongsToMany('CustomerAddressTypes', [
            'foreignKey' => 'customer_address_id',
            'targetForeignKey' => 'customer_address_type_id',
            'joinTable' => 'customer_addresses_customer_address_types',
            'className' => 'ItoolCustomer.CustomerAddressTypes'
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
            ->scalar('first_name')
            ->maxLength('first_name', 250)
            ->requirePresence('first_name', 'create')
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 250)
            ->requirePresence('last_name', 'create')
            ->allowEmpty('last_name');

        $validator
            ->scalar('street_line_1')
            ->maxLength('street_line_1', 250)
            ->requirePresence('street_line_1', 'create')
            ->allowEmpty('street_line_1');

        $validator
            ->scalar('street_line_2')
            ->maxLength('street_line_2', 250)
            ->allowEmpty('street_line_2');

        $validator
            ->scalar('city')
            ->maxLength('city', 200)
            ->requirePresence('city', 'create')
            ->allowEmpty('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 200)
            ->requirePresence('state', 'create')
            ->allowEmpty('state');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 50)
            ->requirePresence('postal_code', 'create')
            ->allowEmpty('postal_code');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 50)
            ->allowEmpty('phone_number');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['core_country_id'], 'CoreCountries'));

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
