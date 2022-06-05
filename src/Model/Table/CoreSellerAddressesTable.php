<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreSellerAddresses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 *
 * @method \App\Model\Entity\CoreSellerAddress get($primaryKey, $options = [])
 * @method \App\Model\Entity\CoreSellerAddress newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CoreSellerAddress[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CoreSellerAddress|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CoreSellerAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CoreSellerAddress[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CoreSellerAddress findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoreSellerAddressesTable extends Table
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

        $this->table('core_seller_addresses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ocl');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('CoreCountries', [
            'foreignKey' => 'core_country_id',
            'joinType' => 'LEFT'
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
            ->notEmpty('street_name');

        $validator
            ->notEmpty('core_country_id');

        $validator
            ->notEmpty('street_number');

        $validator
            ->notEmpty('city');

        $validator
            ->notEmpty('zip_code');

        $validator
            ->notEmpty('phone_number');

        $validator
            ->notEmpty('company_name');

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

        return $rules;
    }
}
