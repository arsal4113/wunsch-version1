<?php
namespace Feeder\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederInfluencers Model
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable&\Cake\ORM\Association\BelongsTo $Area8Worlds
 * @property \Feeder\Model\Table\FeederCategoriesTable&\Cake\ORM\Association\BelongsTo $Area9Worlds
 * @property \Feeder\Model\Table\FeederInfluencerMiniCategoriesTable&\Cake\ORM\Association\HasMany $FeederInfluencerMiniCategories
 *
 * @method \Feeder\Model\Entity\FeederInfluencer get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederInfluencer findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederInfluencersTable extends Table
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

        $this->setTable('feeder_influencers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Area8Worlds', [
            'foreignKey' => 'area_8_world_id',
            'className' => 'Feeder.FeederCategories',
        ]);
        $this->belongsTo('Area9Worlds', [
            'foreignKey' => 'area_9_world_id',
            'className' => 'Feeder.FeederCategories',
        ]);
        $this->hasMany('FeederInfluencerMiniCategories', [
            'foreignKey' => 'feeder_influencer_id',
            'className' => 'Feeder.FeederInfluencerMiniCategories',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 512)
            ->allowEmptyString('name');

        $validator
            ->scalar('url_path')
            ->maxLength('url_path', 1024)
            ->allowEmptyString('url_path');

        $validator
            ->scalar('title_tag')
            ->maxLength('title_tag', 256)
            ->allowEmptyString('title_tag');
        
        $validator
            ->scalar('meta_description')
            ->maxLength('meta_description', 1020)
            ->allowEmptyString('meta_description');

        $validator
            ->scalar('robot_tag')
            ->maxLength('robot_tag', 256)
            ->allowEmptyString('robot_tag');

        $validator
            ->scalar('area_1_headline')
            ->maxLength('area_1_headline', 256)
            ->allowEmptyString('area_1_headline');

        $validator
            ->scalar('area_1_text')
            ->maxLength('area_1_text', 256)
            ->allowEmptyString('area_1_text');

        $validator
            ->scalar('area_2_text')
            ->maxLength('area_2_text', 1024)
            ->allowEmptyString('area_2_text');

        $validator
            ->scalar('area_2_link')
            ->maxLength('area_2_link', 512)
            ->allowEmptyString('area_2_link');

        $validator
            ->scalar('area_3_image')
            ->maxLength('area_3_image', 512)
            ->allowEmptyFile('area_3_image');

        $validator
            ->scalar('area_3_video')
            ->maxLength('area_3_video', 512)
            ->allowEmptyFile('area_3_video');

        $validator
            ->scalar('area_5_text')
            ->maxLength('area_5_text', 512)
            ->allowEmptyString('area_5_text');

        $validator
            ->scalar('area_5_image_1')
            ->maxLength('area_5_image_1', 512)
            ->allowEmptyFile('area_5_image_1');

        $validator
            ->scalar('area_5_image_2')
            ->maxLength('area_5_image_2', 512)
            ->allowEmptyFile('area_5_image_2');

        $validator
            ->scalar('area_5_image_3')
            ->maxLength('area_5_image_3', 512)
            ->allowEmptyFile('area_5_image_3');

        $validator
            ->scalar('area_5_image_4')
            ->maxLength('area_5_image_4', 512)
            ->allowEmptyFile('area_5_image_4');

        $validator
            ->scalar('area_5_image_5')
            ->maxLength('area_5_image_5', 512)
            ->allowEmptyFile('area_5_image_5');

        $validator
            ->scalar('area_5_image_6')
            ->maxLength('area_5_image_6', 512)
            ->allowEmptyFile('area_5_image_6');

        $validator
            ->scalar('area_6_image_1')
            ->maxLength('area_6_image_1', 512)
            ->allowEmptyFile('area_6_image_1');

        $validator
            ->scalar('area_6_image_2')
            ->maxLength('area_6_image_2', 512)
            ->allowEmptyFile('area_6_image_2');

        $validator
            ->scalar('area_6_image_3')
            ->maxLength('area_6_image_3', 512)
            ->allowEmptyFile('area_6_image_3');

        $validator
            ->scalar('area_7_text')
            ->maxLength('area_7_text', 512)
            ->allowEmptyString('area_7_text');

        $validator
            ->scalar('area_7_text_mobile')
            ->maxLength('area_7_text_mobile', 512)
            ->allowEmptyString('area_7_text_mobile');

        $validator
            ->scalar('area_8_image')
            ->maxLength('area_8_image', 512)
            ->allowEmptyFile('area_8_image');

        $validator
            ->scalar('area_8_headline_1')
            ->maxLength('area_8_headline_1', 128)
            ->allowEmptyString('area_8_headline_1');

        $validator
            ->scalar('area_8_headline_2')
            ->maxLength('area_8_headline_2', 128)
            ->allowEmptyString('area_8_headline_2');

        $validator
            ->scalar('area_8_subline')
            ->maxLength('area_8_subline', 128)
            ->allowEmptyString('area_8_subline');

        $validator
            ->scalar('area_8_button_link')
            ->maxLength('area_8_button_link', 512)
            ->allowEmptyString('area_8_button_link');

        $validator
            ->scalar('area_8_ig_name')
            ->maxLength('area_8_ig_name', 512)
            ->allowEmptyString('area_8_ig_name');

        $validator
            ->scalar('area_8_ig_link')
            ->maxLength('area_8_ig_link', 512)
            ->allowEmptyString('area_8_ig_link');

        $validator
            ->scalar('area_9_image')
            ->maxLength('area_9_image', 512)
            ->allowEmptyFile('area_9_image');

        $validator
            ->scalar('area_9_headline_1')
            ->maxLength('area_9_headline_1', 128)
            ->allowEmptyString('area_9_headline_1');

        $validator
            ->scalar('area_9_headline_2')
            ->maxLength('area_9_headline_2', 128)
            ->allowEmptyString('area_9_headline_2');

        $validator
            ->scalar('area_9_subline')
            ->maxLength('area_9_subline', 128)
            ->allowEmptyString('area_9_subline');

        $validator
            ->scalar('area_9_button_link')
            ->maxLength('area_9_button_link', 512)
            ->allowEmptyString('area_9_button_link');

        $validator
            ->scalar('area_9_ig_name')
            ->maxLength('area_9_ig_name', 512)
            ->allowEmptyString('area_9_ig_name');

        $validator
            ->scalar('area_9_ig_link')
            ->maxLength('area_9_ig_link', 512)
            ->allowEmptyString('area_9_ig_link');

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
        $rules->add($rules->existsIn(['area_8_world_id'], 'Area8Worlds'));
        $rules->add($rules->existsIn(['area_9_world_id'], 'Area9Worlds'));

        return $rules;
    }

    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederInfluencers.afterSave', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }

    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederInfluencers.afterDelete', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }
}
