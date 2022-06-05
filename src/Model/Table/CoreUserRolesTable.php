<?php
namespace App\Model\Table;

use App\Model\Entity\CoreUserRole;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Acl\Model\Behavior\AclBehavior;

/**
 * CoreUserRoles Model
 */
class CoreUserRolesTable extends Table
{

    /**
     * Searchable columns
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'core_seller_id' => [
            'type' => 'value'
        ],
        'code' => [
            'type' => 'like',
            'before' => true,
            'after' => true
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true
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
        $this->table('core_user_roles');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);
        $this->addBehavior('Ocl');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->belongsToMany('CoreUsers', [
            'foreignKey' => 'core_user_role_id',
            'targetForeignKey' => 'core_user_id',
            'joinTable' => 'core_user_roles_core_users'
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
            ->add('core_seller_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('core_seller_id')
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
    
    /**
     * Create initial seller user role
     * 
     * @param integer $coreSellerId
     * @param string $code
     * @param string $name
     * @throws Exception
     */
    public function createInitialSellerUserRole($coreSellerId, $code, $name)
    {
    	$data = [
    		$this->alias() => [
    			'core_seller_id' => $coreSellerId,
    			'code' => $code,
    			'name' => $name,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
    		]
    	];
    	
    	$entity = $this->newEntity($data);
    	if(!$this->save($entity)) {
    		throw new Exception(__('Failed to create initial user role for seller with ID: ') . $fileName);
    	}
    	
    	return $entity->id;
    }
}
