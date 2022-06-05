<?php
namespace Dashboard\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Dashboard\Model\Entity\DashboardConfiguration;

/**
 * DashboardConfigurations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \Cake\ORM\Association\BelongsTo $CoreUsers
 */
class DashboardConfigurationsTable extends Table
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
        'core_seller_type_id' => [
            'type' => 'value'
        ],        
        'core_seller_id' => [
            'type' => 'value'
        ],
        'core_user_id' => [
            'type' => 'value'
        ],
        'cell_name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'cell_action' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'cell_configuration' => [
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
        parent::initialize($config);

        $this->table('dashboard_configurations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ocl');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('CoreSellerTypes', [
            'foreignKey' => 'core_seller_type_id',
            'joinType' => 'LEFT',
            'className' => 'Dashboard.CoreSellerTypes'
        ]);        

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'LEFT',
            'className' => 'Dashboard.CoreSellers'
        ]);
        
        $this->belongsTo('CoreUsers', [
            'foreignKey' => 'core_user_id',
            'className' => 'Dashboard.CoreUsers'
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
            ->allowEmpty('core_seller_type_id');

        $validator
            ->allowEmpty('core_seller_id');

        $validator
            ->allowEmpty('core_user_id');

        $validator
            ->requirePresence('cell_name', 'create')
            ->notEmpty('cell_name');

        $validator
            ->allowEmpty('cell_configuration');

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
        return $rules;
    }
}
