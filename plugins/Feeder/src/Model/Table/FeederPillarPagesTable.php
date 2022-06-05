<?php
namespace Feeder\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederPillarPages Model
 *
 * @method \Feeder\Model\Entity\FeederPillarPage get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederPillarPage findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederPillarPagesTable extends Table
{
    const ITEMS_SOURCE_IDS = 'itemIds';
    const ITEMS_SOURCE_TOP_SELLERS = 'topSellers';
    const ITEMS_SOURCE_FROM_CATEGORY = 'fromCategory';

    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'title_tag' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'url_path' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'meta_tag' => [
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

        $this->setTable('feeder_pillar_pages');
        $this->setDisplayField('title_tag');
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title_tag')
            ->maxLength('title_tag', 200)
            ->allowEmpty('title_tag');

        $validator
            ->scalar('url_path')
            ->maxLength('url_path', 1000)
            ->notEmpty('url_path');

        $validator
            ->scalar('meta_tag')
            ->maxLength('meta_tag', 200)
            ->allowEmpty('meta_tag');

        $validator
            ->scalar('robots_tag')
            ->maxLength('robots_tag', 200)
            ->allowEmpty('robots_tag');

        $validator
            ->scalar('block_configuration')
            ->maxLength('block_configuration', 16777215)
            ->allowEmpty('block_configuration');

        $validator
            ->scalar('guide_image')
            ->maxLength('guide_image', 512)
            ->allowEmpty('guide_image');

        $validator
            ->scalar('guide_headline')
            ->maxLength('guide_headline', 256)
            ->allowEmpty('guide_headline');

        return $validator;
    }

    public function getPillarPages()
    {
        return $this->find('all');
    }

    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederPillarPages.afterSave', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }

    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederPillarPages.afterDelete', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }
}
