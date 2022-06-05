<?php
namespace ItoolCustomer\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomerGenders Model
 *
 * @method \ItoolCustomer\Model\Entity\CustomerGender get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerGender findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomerGendersTable extends Table
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
        'gender' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ]
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

        $this->setTable('customer_genders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Searchable');
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
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        return $validator;
    }
}
