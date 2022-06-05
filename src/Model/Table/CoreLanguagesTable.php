<?php

namespace App\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreLanguages Model
 *
 * @property \Cake\ORM\Association\HasMany $CoreSellers
 * @property \Cake\ORM\Association\HasMany $EbayAutoListerConfigurations
 * @property \Cake\ORM\Association\HasMany $EbayDisputeExplanationNames
 * @property \Cake\ORM\Association\HasMany $EbayDisputeReasonNames
 * @property \Cake\ORM\Association\HasMany $EbayLaunchProfiles
 * @property \Cake\ORM\Association\HasMany $EbayListings
 */
class CoreLanguagesTable extends Table
{
    use DbCacheTrait;

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
        'iso_code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'name' => [
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

        $this->setTable('core_languages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->hasMany('CoreSellers', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->hasMany('EbayAutoListerConfigurations', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->hasMany('EbayDisputeExplanationNames', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->hasMany('EbayDisputeReasonNames', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->hasMany('EbayLaunchProfiles', [
            'foreignKey' => 'core_language_id'
        ]);
        $this->hasMany('EbayListings', [
            'foreignKey' => 'core_language_id'
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
            ->requirePresence('iso_code', 'create')
            ->notEmpty('iso_code');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
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
