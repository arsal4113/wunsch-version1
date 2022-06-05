<?php

namespace UrlRewrite\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UrlRewriteRedirectTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $UrlRewriteRedirects
 */
class UrlRewriteRedirectTypesTable extends Table
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
        'code' => [
            'type' => 'value'
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'header' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
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

        $this->setTable('url_rewrite_redirect_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->hasMany('UrlRewriteRedirects', [
            'foreignKey' => 'url_rewrite_redirect_type_id',
            'className' => 'UrlRewrite.UrlRewriteRedirects'
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
            ->integer('code')
            ->requirePresence('code')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name')
            ->notEmpty('name');

        return $validator;
    }
}
