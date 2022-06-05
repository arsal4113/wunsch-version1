<?php

namespace UrlRewrite\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UrlRewriteRoutes Model
 */
class UrlRewriteRoutesTable extends Table
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
        'target_url' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'plugin' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'controller' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'action' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'args' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'creator' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'timestamp' => [
            'type' => 'value'
        ],
        'created' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'modified' => [
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

        $this->setTable('url_rewrite_routes');
        $this->setDisplayField('id');
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
            ->allowEmpty('id');

        $validator
            ->scalar('target_url')
            ->maxLength('target_url', 250)
            ->requirePresence('target_url', 'create')
            ->notEmpty('target_url');

        $validator
            ->scalar('plugin')
            ->maxLength('plugin', 100)
            ->allowEmpty('plugin');

        $validator
            ->scalar('controller')
            ->maxLength('controller', 100)
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->scalar('action')
            ->maxLength('action', 100)
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->scalar('args')
            ->maxLength('args', 200)
            ->requirePresence('args', 'create')
            ->notEmpty('args');

        $validator
            ->scalar('creator')
            ->maxLength('creator', 100)
            ->requirePresence('creator', 'create')
            ->notEmpty('creator');

        $validator
            ->integer('timestamp')
            ->requirePresence('timestamp')
            ->notEmpty('timestamp');

        return $validator;
    }
}
