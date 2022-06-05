<?php

namespace HelpDesk\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HelpDeskFaqs Model
 *
 * @property \HelpDesk\Model\Table\HelpDeskCategoriesTable|\Cake\ORM\Association\BelongsTo $HelpDeskCategories
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
class HelpDeskFaqsTable extends Table
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
        'help_desk_category_id' => [
            'type' => 'link',
            'before' => true,
            'after' => true
        ],
        'question' => [
            'type' => 'link',
            'before' => true,
            'after' => true,
        ],
        'answer' => [
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

        $this->setTable('help_desk_faqs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->setDisplayField('help_desk_category_id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->belongsTo('HelpDeskCategories', [
            'className' => 'HelpDesk.HelpDeskCategories',
            'foreignKey' => 'help_desk_category_id'
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
            ->scalar('help_desk_category_id')
            ->maxLength('help_desk_category_id', 11)
            ->requirePresence('help_desk_category_id', 'create')
            ->notEmpty('help_desk_category_id');

        $validator
            ->scalar('question')
            ->requirePresence('question', 'create')
            ->notEmpty('question');

        $validator
            ->scalar('answer')
            ->requirePresence('answer', 'create')
            ->notEmpty('answer');

        $validator
            ->integer('sort_order')
            ->maxLength('sort_order', 11)
            ->requirePresence('sort_order', 'create')
            ->allowEmpty('sort_order');

        return $validator;
    }

}
