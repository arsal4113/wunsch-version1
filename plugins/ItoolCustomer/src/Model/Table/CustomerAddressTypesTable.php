<?php

namespace ItoolCustomer\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerAddressTypes Model
 *
 * @property \ItoolCustomer\Model\Table\CustomerAddressesTable|\Cake\ORM\Association\BelongsToMany $CustomerAddresses
 *
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerAddressType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerAddressTypesTable extends Table
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

        $this->setTable('customer_address_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('CustomerAddresses', [
            'foreignKey' => 'customer_address_type_id',
            'targetForeignKey' => 'customer_address_id',
            'joinTable' => 'customer_addresses_customer_address_types',
            'className' => 'ItoolCustomer.CustomerAddresses'
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
            ->scalar('code')
            ->maxLength('code', 200)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
