<?php

namespace HelpDesk\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpDeskCategories Model
 *
 * @property \HelpDesk\Model\Table\HelpDeskFaqsTable|\Cake\ORM\Association\BelongsTo $HelpDeskFaqs
 *
 * @method \HelpDesk\Model\Entity\HelpDeskFaq newEntity($data = null, array $options = [])
 * @method \HelpDesk\Model\Entity\HelpDeskFaq[] newEntities(array $data, array $options = [])
 * @method \HelpDesk\Model\Entity\HelpDeskFaq|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \HelpDesk\Model\Entity\HelpDeskFaq patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \HelpDesk\Model\Entity\HelpDeskFaq[] patchEntities($entities, array $data, array $options = [])
 * @method \HelpDesk\Model\Entity\HelpDeskFaq findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HelpDeskCategoriesTable extends Table
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
        'category' => [
            'type' => 'link',
            'before' => true,
            'after' => true
        ],
        'sort_order' => [
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

        $this->setTable('help_desk_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->setDisplayField('category');
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
            ->scalar('category')
            ->maxLength('category', 2040)
            ->requirePresence('category', 'create');

        $validator
            ->integer('sort_order')
            ->maxLength('sort_order', 11)
            ->requirePresence('sort_order', 'create')
            ->allowEmpty('sort_order');

        return $validator;
    }


}
