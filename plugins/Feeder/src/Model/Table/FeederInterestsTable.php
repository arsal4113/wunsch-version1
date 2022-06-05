<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederInterests Model
 *
 * @property \ItoolCustomer\Model\Table\CustomerGendersTable|\Cake\ORM\Association\BelongsTo $CustomerGenders
 * @property \Feeder\Model\Table\FeederInterestSubcategoriesTable|\Cake\ORM\Association\BelongsToMany $FeederInterestSubcategories
 *
 * @method \Feeder\Model\Entity\FeederInterest get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederInterest newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterest[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederInterest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterest[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInterest findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederInterestsTable extends Table
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

        $this->setTable('feeder_interests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CustomerGenders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'INNER',
            'className' => 'Feeder.CustomerGenders'
        ]);
        $this->belongsToMany('FeederInterestSubcategories', [
            'foreignKey' => 'feeder_interest_id',
            'targetForeignKey' => 'feeder_interest_subcategory_id',
            'joinTable' => 'feeder_interests_feeder_interest_subcategories',
            'className' => 'Feeder.FeederInterestSubcategories'
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
            ->scalar('image')
            ->maxLength('image', 510)
            ->allowEmpty('image');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

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
        $rules->add($rules->existsIn(['gender_id'], 'CustomerGenders'));

        return $rules;
    }
}
