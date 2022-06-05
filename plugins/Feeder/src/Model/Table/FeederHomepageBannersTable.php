<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederHomepageBanners Model
 *
 * @property \Feeder\Model\Table\FeederHomepagesTable|\Cake\ORM\Association\BelongsTo $FeederHomepages
 *
 * @method \Feeder\Model\Entity\FeederHomepageBanner get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederHomepageBanner findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeederHomepageBannersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('feeder_homepage_banners');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Feeder.TimeRange');

        $this->belongsTo('FeederHomepages', [
            'foreignKey' => 'feeder_homepage_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('banner_image')
            ->maxLength('banner_image', 1020)
            ->allowEmpty('banner_image');

        $validator
            ->scalar('banner_link')
            ->maxLength('banner_link', 1020)
            ->allowEmpty('banner_link');

        $validator
            ->scalar('banner_bp_lg')
            ->maxLength('banner_bp_lg', 1020)
            ->allowEmpty('banner_bp_lg');

        $validator
            ->scalar('banner_bp_md')
            ->maxLength('banner_bp_md', 1020)
            ->allowEmpty('banner_bp_md');

        $validator
            ->scalar('banner_bp_sm')
            ->maxLength('banner_bp_sm', 1020)
            ->allowEmpty('banner_bp_sm');

        $validator
            ->scalar('banner_bp_xs')
            ->maxLength('banner_bp_xs', 1020)
            ->allowEmpty('banner_bp_xs');

        $validator
            ->scalar('headline')
            ->maxLength('headline', 510)
            ->allowEmpty('headline');

        $validator
            ->scalar('headline_font_color')
            ->maxLength('headline_font_color', 100)
            ->allowEmpty('headline_font_color');

        $validator
            ->scalar('caption')
            ->maxLength('caption', 510)
            ->allowEmpty('caption');

        $validator
            ->scalar('caption_font_color')
            ->maxLength('caption_font_color', 100)
            ->allowEmpty('caption_font_color');

        $validator
            ->scalar('text_background_color')
            ->maxLength('text_background_color', 100)
            ->allowEmpty('text_background_color');

        $validator
            ->scalar('opacity')
            ->maxLength('opacity', 100)
            ->allowEmpty('opacity');

        $validator
            ->scalar('cta')
            ->maxLength('cta', 510)
            ->allowEmpty('cta');

        $validator
            ->scalar('cta_color')
            ->maxLength('cta_color', 100)
            ->allowEmpty('cta_color');

        $validator
            ->scalar('loader_color')
            ->maxLength('loader_color', 100)
            ->allowEmpty('loader_color');

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
        $rules->add($rules->existsIn(['feeder_homepage_id'], 'FeederHomepages'));

        return $rules;
    }
}
