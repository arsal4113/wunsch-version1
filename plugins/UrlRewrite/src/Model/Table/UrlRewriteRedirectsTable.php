<?php

namespace UrlRewrite\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UrlRewriteRedirects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $UrlRewriteRedirectTypes
 */
class UrlRewriteRedirectsTable extends Table
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
        'url_rewrite_redirect_type_id' => [
            'type' => 'value'
        ],
        'source_url' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'target_url' => [
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

        $this->setTable('url_rewrite_redirects');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('UrlRewriteRedirectTypes', [
            'foreignKey' => 'url_rewrite_redirect_type_id',
            'joinType' => 'INNER',
            'className' => 'UrlRewrite.UrlRewriteRedirectTypes'
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
            ->scalar('source_url')
            ->maxLength('source_url', 250)
            ->requirePresence('source_url')
            ->notEmpty('source_url');

        $validator
            ->scalar('target_url')
            ->maxLength('target_url', 250)
            ->requirePresence('target_url')
            ->notEmpty('target_url');

        $validator
            ->scalar('creator')
            ->maxLength('creator', 200)
            ->requirePresence('creator', 'create')
            ->notEmpty('creator');

        $validator
            ->integer('timestamp')
            ->requirePresence('timestamp')
            ->notEmpty('timestamp');

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
        $rules->add($rules->existsIn(['url_rewrite_redirect_type_id'], 'UrlRewriteRedirectTypes'));
        return $rules;
    }
}
