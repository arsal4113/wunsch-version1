<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederWorlds Model
 *
 * @method \Feeder\Model\Entity\FeederWorld get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederWorld newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederWorld[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederWorld|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederWorld patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederWorld[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederWorld findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeederWorldsTable extends Table
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
        'image' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'link' => [
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

        $this->setTable('feeder_worlds');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('name')
            ->maxLength('name', 510)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('image')
            ->maxLength('image', 2040)
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->scalar('image_alt_tag')
            ->maxLength('image_alt_tag', 512)
            ->allowEmptyString('image_alt_tag');

        $validator
            ->scalar('image_title_tag')
            ->maxLength('image_title_tag', 512)
            ->allowEmptyString('image_title_tag');

        $validator
            ->scalar('link')
            ->maxLength('link', 2040)
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        return $validator;
    }
}
