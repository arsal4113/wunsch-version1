<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederInterestSubcategories Model
 *
 * @property \Feeder\Model\Table\FeederInterestsTable|\Cake\ORM\Association\BelongsToMany $FeederInterests
 * @property \ItoolCustomer\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsToMany $Customers
 *
 * @method \Feeder\Model\Entity\FeederInterestSubcategory get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterestSubcategory findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederInterestSubcategoriesTable extends Table
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

        $this->setTable('feeder_interest_subcategories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('FeederInterests', [
            'foreignKey' => 'feeder_interest_subcategory_id',
            'targetForeignKey' => 'feeder_interest_id',
            'joinTable' => 'feeder_interests_feeder_interest_subcategories',
            'className' => 'Feeder.FeederInterests'
        ]);
        $this->belongsToMany('Customers', [
            'foreignKey' => 'feeder_interest_subcategory_id',
            'targetForeignKey' => 'customer_id',
            'joinTable' => 'customers_feeder_interest_subcategories',
            'className' => 'ItoolCustomer.Customer'
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
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmpty('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 200)
            ->allowEmpty('type');

        $validator
            ->scalar('ids')
            ->maxLength('ids', 510)
            ->requirePresence('ids', 'create')
            ->notEmpty('ids');

        $validator
            ->boolean('sale_only')
            ->requirePresence('sale_only', 'create')
            ->notEmpty('sale_only');

        return $validator;
    }
}
