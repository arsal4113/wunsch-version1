<?php

namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederHeroItems Model
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable|\Cake\ORM\Association\BelongsToMany $FeederCategories
 * @property \Feeder\Model\Table\FeederCategoriesTable|\Cake\ORM\Association\BelongsTo $CustomerGenders
 *
 * @method \Feeder\Model\Entity\FeederHeroItem get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHeroItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeederHeroItemsTable extends Table
{
    const BANNER_PRODUCTS_FACTOR = 60;
    const BANNER_SMALL_POSITIONS = [3, 16, 25, 30, 46];
    const BANNER_LARGE_POSITIONS = [6, 36];

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
        'type' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'item_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'item_image_url' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'sort_order' => [
            'type' => 'value'
        ],
        'is_active' => [
            'type' => 'value'
        ],
        'start_time' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'end_time' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'modified' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'created' => [
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

        $this->setTable('feeder_hero_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->addBehavior('Feeder.TimeRange');

        $this->belongsToMany('FeederCategories', [
            'foreignKey' => 'feeder_hero_item_id',
            'targetForeignKey' => 'feeder_category_id',
            'joinTable' => 'feeder_categories_feeder_hero_items',
            'className' => 'Feeder.FeederCategories'
        ]);

        $this->belongsTo('CustomerGenders', [
            'foreignKey' => 'gender_id',
            'className' => 'ItoolCustomer.CustomerGenders'
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
            ->scalar('type')
            ->maxLength('type', 510)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

        $validator
            ->dateTime('start_time')
            ->allowEmpty('start_time');

        $validator
            ->dateTime('end_time')
            ->allowEmpty('end_time');


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
