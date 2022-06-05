<?php

namespace Feeder\Model\Table;

use App\Application;
use Cake\Cache\Cache;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederFizzyBubbles Model
 *
 * @method \Feeder\Model\Entity\FeederFizzyBubble get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederFizzyBubble findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederFizzyBubblesTable extends Table
{

    const FIZZY_BUBBLES_BOTH_BROWSE_CACHE_KEY = 'fizzy_both_browse';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('feeder_fizzy_bubbles');
        $this->setDisplayField('title_text');
        $this->setPrimaryKey('id');
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
            ->scalar('url')
            ->maxLength('url', 1020)
            ->allowEmpty('url');

        $validator
            ->scalar('title_text')
            ->maxLength('title_text', 200)
            ->allowEmpty('title_text');

        $validator
            ->scalar('title_color')
            ->maxLength('title_color', 200)
            ->allowEmpty('title_color');

        $validator
            ->scalar('title_background_color')
            ->maxLength('title_background_color', 200)
            ->allowEmpty('title_background_color');

        $validator
            ->integer('title_opacity')
            ->requirePresence('title_opacity', 'create')
            ->notEmpty('title_opacity');

        $validator
            ->scalar('subline_text')
            ->maxLength('subline_text', 200)
            ->allowEmpty('subline_text');

        $validator
            ->scalar('subline_color')
            ->maxLength('subline_color', 200)
            ->allowEmpty('subline_color');

        $validator
            ->scalar('subline_background_color')
            ->maxLength('subline_background_color', 200)
            ->allowEmpty('subline_background_color');

        $validator
            ->integer('subline_opacity')
            ->requirePresence('subline_opacity', 'create')
            ->notEmpty('subline_opacity');

        $validator
            ->scalar('image_src')
            ->maxLength('image_src', 510)
            ->allowEmpty('image_src');

        $validator
            ->scalar('img_alt_tag')
            ->maxLength('img_alt_tag', 200)
            ->allowEmpty('img_alt_tag');

        $validator
            ->scalar('sort_order')
            ->maxLength('sort_order', 20)
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
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        if(!$entity->hasErrors()) {
            Cache::delete(self::FIZZY_BUBBLES_BOTH_BROWSE_CACHE_KEY, Application::SHORT_TERM_CACHE);
        }
        return true;
    }
}
