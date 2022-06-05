<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Feeder\Model\Entity\FeederInfluencerMiniCategory;

/**
 * FeederInfluencerMiniCategories Model
 *
 * @property \Cake\ORM\Association\BelongsTo $FeederInfluencers
 */
class FeederInfluencerMiniCategoriesTable extends Table
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
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'url' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'feeder_influencer_id' => [
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

        $this->setTable('feeder_influencer_mini_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('FeederInfluencers', [
            'foreignKey' => 'feeder_influencer_id',
            'joinType' => 'INNER',
            'className' => 'Feeder.FeederInfluencers',
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
            ->allowEmptyString('id');

        $validator
            ->scalar('name')
            ->maxLength('name', 512)
            ->allowEmptyString('name');

        $validator
            ->scalar('url')
            ->maxLength('url', 128)
            ->allowEmptyString('url');

        $validator
            ->scalar('image')
            ->maxLength('image', 512)
            ->allowEmptyFile('image');

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
        $rules->add($rules->existsIn(['feeder_influencer_id'], 'FeederInfluencers'));
        return $rules;
    }
}
