<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Feeder\Model\Entity\FeederCategoriesVideoElement;

/**
 * FeederCategoriesVideoElements Model
 *
 */
class FeederCategoriesVideoElementsTable extends Table
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
        'is_active' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_mp4' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_webm' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'background_color' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'headline' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'headline_color' => [
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

        $this->setTable('feeder_categories_video_elements');
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
            ->allowEmptyString('id');

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        $validator
            ->scalar('video_mp4')
            ->maxLength('video_mp4', 1024)
            ->allowEmptyString('video_mp4');

        $validator
            ->scalar('video_webm')
            ->maxLength('video_webm', 1024)
            ->allowEmptyString('video_webm');

        $validator
            ->scalar('background_color')
            ->maxLength('background_color', 128)
            ->allowEmptyString('background_color');

        $validator
            ->scalar('headline')
            ->maxLength('headline', 1024)
            ->allowEmptyString('headline');

        $validator
            ->scalar('headline_color')
            ->maxLength('headline_color', 128)
            ->allowEmptyString('headline_color');

        return $validator;
    }
}
