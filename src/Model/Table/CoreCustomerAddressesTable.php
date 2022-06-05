<?php
namespace App\Model\Table;

use App\Model\Entity\CoreCustomerAddress;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreCustomerAddresses Model
 */
class CoreCustomerAddressesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('core_customer_addresses');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CoreCustomers', [
            'foreignKey' => 'core_customer_id',
            'joinType' => 'INNER'
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
            ->requirePresence('phone', 'create')
            ->notEmpty('phone')
            ->requirePresence('street_1', 'create')
            ->notEmpty('street_1')
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode')
            ->requirePresence('city', 'create')
            ->notEmpty('city')
            ->requirePresence('country_code', 'create')
            ->notEmpty('country_code')
            ->requirePresence('country_name', 'create')
            ->notEmpty('country_name');

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
        $rules->add($rules->existsIn(['core_customer_id'], 'CoreCustomers'));
        return $rules;
    }
}
