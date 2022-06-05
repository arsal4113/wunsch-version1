<?php

namespace App\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Inflector;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * CoreSellers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoreLanguages
 * @property \Cake\ORM\Association\BelongsTo $CoreCountries
 * @property \Cake\ORM\Association\BelongsTo $CoreSellerTypes
 * @property \Cake\ORM\Association\HasMany $CoreConfigurations
 * @property \Cake\ORM\Association\HasMany $CoreCustomerAddresses
 * @property \Cake\ORM\Association\HasMany $CoreCustomers
 * @property \Cake\ORM\Association\HasMany $CoreUserRoles
 * @property \Cake\ORM\Association\HasMany $CoreUsers
 */
class CoreSellersTable extends Table
{
    use DbCacheTrait;

    /**
     * Searchable columns
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'code' => [
            'type' => 'value'
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true
        ],
        'core_language_id' => [
            'type' => 'value'
        ],
        'core_country_id' => [
            'type' => 'value'
        ],
        'is_active' => [
            'type' => 'value'
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

        $this->setTable('core_sellers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->addBehavior('Ocl', [
            'identifier' => 'core_seller_id',
            'db_field' => 'id'
        ]);
        $this->addBehavior('SoftDelete');

        $this->belongsTo('CoreLanguages', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->belongsTo('CoreCountries', [
            'foreignKey' => 'core_country_id'
        ]);
        $this->hasMany('CoreConfigurations', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->hasMany('CoreCustomerAddresses', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->hasMany('CoreCustomers', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->hasMany('CoreUserRoles', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->hasMany('CoreUsers', [
            'foreignKey' => 'core_seller_id'
        ]);
        $this->belongsTo('CoreSellerTypes', [
            'foreignKey' => 'core_seller_type_id',
            'joinType' => 'LEFT'
        ]);
        $this->hasMany('CoreSellerAddresses', [
            'foreignKey' => 'core_seller_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        return $validator;
    }

    /**
     * Register validation rules
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationRegister(Validator $validator)
    {
        $validator->add('email', [
            'valid' => ['rule' => 'email'],
            'checkExistsUserEmail' => [
                'rule' => 'checkExistsUserEmail',
                'provider' => 'table',
                'message' => __('This email is already registered.')
            ]
        ])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator->add('password', 'length', [
            'rule' => ['lengthBetween', 8, 40],
            'message' => __('The password length should be between 8-40 characters')
        ])
            ->requirePresence('password', 'create')
            ->notEmpty('password');
        $validator->add('confirm_password', [
            'compare' => [
                'rule' => ['compareWith', 'password'],
                'message' => __('The password and confirmation password do not match.')
            ]
        ]);

        return $validator;
    }

    /**
     * @param $value
     * @param $context
     * @return bool
     */
    public function checkExistsUserEmail($value, $context)
    {
        $user = $this->CoreUsers->find()->where(['email' => $value])->first();
        return empty($user);
    }

    /**
     * @param $value
     * @param $context
     * @return bool
     */
    public function checkExistsName($value, $context)
    {
        $seller = $this->find()->where(['code' => Inflector::camelize($value)])->first();
        return empty($seller);
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
        $rules->add($rules->existsIn(['core_language_id'], 'CoreLanguages'));
        $rules->add($rules->existsIn(['core_country_id'], 'CoreCountries'));
        return $rules;
    }

    /**
     * @param Event $event
     * @param Entity $entity
     * @param ArrayObject $options
     */
    public function beforeSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        if ($entity->isNew()) {
            do {
                $sellerUuid = Text::uuid();
                $checkUuid = $this->find()->where(['uuid' => $sellerUuid])->first();
            } while (!empty($checkUuid));
            $entity->uuid = $sellerUuid;
        }
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
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
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
        return true;
    }
}
