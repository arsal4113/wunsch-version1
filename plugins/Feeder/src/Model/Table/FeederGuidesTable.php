<?php

namespace Feeder\Model\Table;

use Cake\Cache\Cache;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederGuides Model
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable&\Cake\ORM\Association\BelongsToMany $FeederCategories
 * @property \Feeder\Model\Table\FeederCategoriesTable&\Cake\ORM\Association\BelongsToMany $FeederPillarPages
 *
 * @method \Feeder\Model\Entity\FeederGuide get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederGuide newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederGuide[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederGuide|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederGuide saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederGuide patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederGuide[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederGuide findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederGuidesTable extends Table
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

        $this->setTable('feeder_guides');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsToMany('FeederCategories', [
            'foreignKey' => 'feeder_guide_id',
            'targetForeignKey' => 'feeder_category_id',
            'joinTable' => 'feeder_guides_feeder_categories',
            'className' => 'Feeder.FeederCategories'
        ]);

        $this->belongsToMany('FeederPillarPages', [
            'foreignKey' => 'feeder_guide_id',
            'targetForeignKey' => 'feeder_pillar_page_id',
            'joinTable' => 'feeder_guides_feeder_pillar_pages',
            'className' => 'Feeder.FeederPillarPages'
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
            ->scalar('url')
            ->maxLength('url', 1020)
            ->allowEmptyString('url');

        $validator
            ->scalar('title')
            ->maxLength('title', 200)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->maxLength('description', 1020)
            ->allowEmptyString('description');

        $validator
            ->integer('sort_order')
            ->notEmptyString('sort_order');

        $validator
            ->scalar('optional_urls')
            ->maxLength('optional_urls', 1020)
            ->allowEmptyString('optional_urls');

        $validator
            ->scalar('optional_url_headers')
            ->maxLength('optional_url_headers', 512)
            ->allowEmptyString('optional_url_headers');

        $validator
            ->scalar('optional_url_image')
            ->maxLength('optional_url_image', 256)
            ->allowEmptyString('optional_url_image');

        return $validator;
    }

    /**
     * @return Query
     */
    public function getGuides()
    {
        return $this->find('all');
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        Cache::delete('navigated_guides');

        $event = new Event('Model.FeederGuides.afterSave', $this);
        $this->getEventManager()->dispatch($event);
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
        Cache::delete('navigated_guides');

        $event = new Event('Model.FeederGuides.afterDelete', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }
}
