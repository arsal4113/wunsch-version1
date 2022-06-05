<?php

namespace Feeder\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Cache\Cache;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Feeder\Model\Entity\FeederHomepage;

/**
 * FeederHomepages Model
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable|\Cake\ORM\Association\BelongsTo $FeederCategories
 * @property \Feeder\Model\Table\FeederHomepageMidpageContainersTable|\Cake\ORM\Association\HasOne $FeederHomepageMidpageContainers
 *
 * @method \Feeder\Model\Entity\FeederHomepage get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepage findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederHomepagesTable extends Table
{
    const LOGO_CACHE_KEY = 'Feeder/FeederHomepage/catchLogo';

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
        'big_banner_image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'big_banner_link' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'first_small_banner_image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'first_small_banner_link' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'second_small_banner_image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'second_small_banner_link' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'third_small_banner_image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'third_small_banner_link' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'fourth_small_banner_image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'fourth_small_banner_link' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'surprise_item_ids' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],

        'feeder_category_id' => [
            'type' => 'value'
        ],

        'breakpoints_id' => [
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
        parent::initialize($config);

        $this->setTable('feeder_homepages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Searchable');

        $this->belongsTo('FeederCategories', [
            'foreignKey' => 'feeder_category_id',
            'className' => 'Feeder.FeederCategories'
        ]);

        $this->hasMany('FeederHomepageBanners', [
            'foreignKey' => 'feeder_homepage_id',
            'className' => 'Feeder.FeederHomepageBanners',
            'sort' => ['FeederHomepageBanners.sort_order' => 'ASC']
        ]);

        $this->hasOne('FeederHomepageMidpageContainers', [
            'foreignKey' => 'homepage_id',
            'className' => 'Feeder.FeederHomepageMidpageContainers',
            'joinType' => 'LEFT',
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
            ->scalar('big_banner_image')
            ->maxLength('big_banner_image', 1020)
            ->allowEmpty('big_banner_image');

        $validator
            ->scalar('big_banner_link')
            ->maxLength('big_banner_link', 1020)
            ->allowEmpty('big_banner_link');

        $validator
            ->scalar('first_small_banner_image')
            ->maxLength('first_small_banner_image', 1020)
            ->allowEmpty('first_small_banner_image');

        $validator
            ->scalar('first_small_banner_link')
            ->maxLength('first_small_banner_link', 1020)
            ->allowEmpty('first_small_banner_link');

        $validator
            ->scalar('second_small_banner_image')
            ->maxLength('second_small_banner_image', 1020)
            ->allowEmpty('second_small_banner_image');

        $validator
            ->scalar('second_small_banner_link')
            ->maxLength('second_small_banner_link', 1020)
            ->allowEmpty('second_small_banner_link');

        $validator
            ->scalar('third_small_banner_image')
            ->maxLength('third_small_banner_image', 1020)
            ->allowEmpty('third_small_banner_image');

        $validator
            ->scalar('third_small_banner_link')
            ->maxLength('third_small_banner_link', 1020)
            ->allowEmpty('third_small_banner_link');

        $validator
            ->scalar('fourth_small_banner_image')
            ->maxLength('fourth_small_banner_image', 1020)
            ->allowEmpty('fourth_small_banner_image');

        $validator
            ->scalar('fourth_small_banner_link')
            ->maxLength('fourth_small_banner_link', 1020)
            ->allowEmpty('fourth_small_banner_link');

        $validator
            ->scalar('surprise_item_ids')
            ->maxLength('surprise_item_ids', 2040)
            ->allowEmpty('surprise_item_ids');

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
        $rules->add($rules->existsIn(['feeder_category_id'], 'FeederCategories'));

        return $rules;
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

    /**
     * @param FeederHomepage $feederHomepage
     * @return mixed|string
     */
    public function getCatchLogo(FeederHomepage $feederHomepage)
    {
        if (Time::now()->between(
            $feederHomepage->logo_start_time ?: Time::yesterday(),
            $feederHomepage->logo_end_time ?: Time::tomorrow())) {
            $catchLogo = $feederHomepage->time_logo;
        } else {
            $catchLogo = $feederHomepage->main_logo;
        }
        return $catchLogo;
    }


}
