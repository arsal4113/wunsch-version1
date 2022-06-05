<?php

namespace ZipData\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ZipDataZips Model
 *
 */
class ZipDataZipsTable extends Table
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
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'city' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'area' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'last_import' => [
            'type' => 'value'
        ],
        'search_hash' => [
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

        $this->setTable('zip_data_zips');
        $this->setDisplayField('id');
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
            ->allowEmpty('id');

        $validator
            ->scalar('code')
            ->maxLength('code', 100)
            ->requirePresence('code')
            ->notEmpty('code');

        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->requirePresence('city')
            ->notEmpty('city');

        $validator
            ->scalar('area')
            ->maxLength('area', 100)
            ->requirePresence('area')
            ->notEmpty('area');

        return $validator;
    }

    /**
     * @param $data
     * @return bool|\Cake\Datasource\EntityInterface[]|\Cake\ORM\ResultSet
     */
    public function bulkUpdate($data)
    {
        $updateEntities = [];
        $entities = $this->find()
            ->where([
                'search_hash IN' => array_keys($data)
            ])
            ->limit(count($data));

        foreach ($entities as $entity) {
            $updateEntities[] = $this->patchEntity($entity, $data[$entity->search_hash]);
            unset($data[$entity->search_hash]);
        }
        if (!empty($data)) {
            $updateEntities = array_merge($updateEntities, $this->newEntities($data));
        }

        return $this->saveMany($updateEntities);
    }
}
