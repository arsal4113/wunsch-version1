<?php
namespace App\Model\Table;

use App\Model\Entity\CoreUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Acl\Model\Behavior\AclBehavior;
use Cake\Core\Exception\Exception;

/**
 * CoreUsers Model
 * 
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \Cake\ORM\Association\BelongsToMany $CoreUserRoles
 */
class CoreUsersTable extends Table
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
        'is_active' => [
            'type' => 'value'
        ],
        'first_name' => [
            'type' => 'value'
        ],
        'last_name' => [
            'type' => 'value'
        ],
        'email' => [
            'type' => 'like',
            'before' => true,
            'after' => true
        ],
        'is_super_user' => [
            'type' => 'value'
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
        $this->setTable('core_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);
        $this->addBehavior('Ocl');
        $this->addBehavior('SoftDelete');
        $this->addBehavior('Search.Searchable');
        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->belongsToMany('CoreUserRoles', [
            'foreignKey' => 'core_user_id',
            'targetForeignKey' => 'core_user_role_id',
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
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->add('core_seller_id', 'valid', ['rule' => 'numeric'])
            ->requirePresence('core_seller_id', 'create')
            ->notEmpty('core_seller_id')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        return $validator;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationRegister(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create')
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        return $validator;
    }

    /**
     * Validate email change
     * 
     * @param Validator $validator
     * @return Validator
     */
    public function validationChangeEmail(Validator $validator)
    {
        $validator
            ->add('new_email', [
                'valid' => ['rule' => 'email'],
                'checkExistsUserEmail' => [
                    'rule' => 'checkExistsUserEmail',
                    'provider' => 'table',
                    'message' => __('This email is already registered.')
                ]
            ])
            ->requirePresence('new_email', 'update')
            ->notEmpty('new_email');

        $validator->add('new_email_confirm', [
            'compare' => [
                'rule' => ['compareWith', 'new_email'],
                'message' => __('The new email and confirmation new email do not match.')
            ]
        ]);

        return $validator;
    }


    /**
     * Check, whether user email exists
     * 
     * @param $value
     * @param $context
     * @return bool
     */
    public function checkExistsUserEmail($value, $context)
    {
        $this->removeBehavior('Ocl');
        $user = $this->find()->where(['email' => $value])->first();
        $isNotExists = empty($user);
        $this->addBehavior('Ocl');

        return $isNotExists;
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
        return $rules;
    }

    /**
     * Create initial seller user
     *
     * @param array $userData
     * @return object
     */
    public function createInitialSellerUser($userData)
    {
        $entity = $this->newEntity($userData);
        $this->save($entity);

        return $entity;
    }

    /**
     * Get user roles ID
     *
     * @param integer $userId
     * @return multitype:NULL
     */
    public function getUserRoleIds($userId)
    {
        $coreUser = $this->get($userId, [
            'contain' => ['CoreUserRoles']
        ]);

        $coreUserRoles = [];
        if (!empty($coreUser->core_user_roles)) {
            foreach ($coreUser->core_user_roles as $coreUserRole) {
                $coreUserRoles[] = $coreUserRole->id;
            }
        }

        return $coreUserRoles;
    }
}
