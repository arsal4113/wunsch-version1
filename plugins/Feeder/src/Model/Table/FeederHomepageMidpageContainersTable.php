<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Feeder\Model\Entity\FeederHomepageMidpageContainer;

/**
 * FeederHomepageMidpageContainers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $FeederHomepages
 */
class FeederHomepageMidpageContainersTable extends Table
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
        'homepage_id' => [
            'type' => 'value'
        ],
        'video_desktop_mp4' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_tablet_mp4' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_mobile_mp4' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_desktop_webm' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_tablet_webm' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'video_mobile_webm' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'image_desktop' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'image_tablet' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'image_mobile' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'use_video' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'click_url' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'header_text' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'button_text' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'button_color' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'background_color' => [
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

        $this->setTable('feeder_homepage_midpage_containers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('FeederHomepages', [
            'foreignKey' => 'homepage_id',
            'className' => 'Feeder.FeederHomepages'
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
            ->allowEmpty('id');

        $validator
            ->scalar('video_desktop_mp4')
            ->maxLength('video_desktop_mp4', 1024)
            ->allowEmpty('video_desktop_mp4');

        $validator
            ->scalar('video_tablet_mp4')
            ->maxLength('video_tablet_mp4', 1024)
            ->allowEmpty('video_tablet_mp4');

        $validator
            ->scalar('video_mobile_mp4')
            ->maxLength('video_mobile_mp4', 1024)
            ->allowEmpty('video_mobile_mp4');

        $validator
            ->scalar('video_desktop_webm')
            ->maxLength('video_desktop_webm', 1024)
            ->allowEmpty('video_desktop_webm');

        $validator
            ->scalar('video_tablet_webm')
            ->maxLength('video_tablet_webm', 1024)
            ->allowEmpty('video_tablet_webm');

        $validator
            ->scalar('video_mobile_webm')
            ->maxLength('video_mobile_webm', 1024)
            ->allowEmpty('video_mobile_webm');

        $validator
            ->scalar('image_desktop')
            ->maxLength('image_desktop', 1024)
            ->allowEmpty('image_desktop');

        $validator
            ->scalar('image_tablet')
            ->maxLength('image_tablet', 1024)
            ->allowEmpty('image_tablet');

        $validator
            ->scalar('image_mobile')
            ->maxLength('image_mobile', 1024)
            ->allowEmpty('image_mobile');

        $validator
            ->boolean('use_video')
            ->requirePresence('use_video')
            ->notEmpty('use_video');

        $validator
            ->scalar('click_url')
            ->maxLength('click_url', 1024)
            ->allowEmpty('click_url');

        $validator
            ->scalar('header_text')
            ->maxLength('header_text', 1024)
            ->allowEmpty('header_text');

        $validator
            ->scalar('button_text')
            ->maxLength('button_text', 1024)
            ->allowEmpty('button_text');

        $validator
            ->scalar('button_color')
            ->maxLength('button_color', 128)
            ->allowEmpty('button_color');

        $validator
            ->scalar('background_color')
            ->maxLength('background_color', 128)
            ->allowEmpty('background_color');

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
        $rules->add($rules->existsIn(['homepage_id'], 'FeederHomepages'));
        return $rules;
    }
}
