<?php

namespace VisitManager\Model\Table;

use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use VisitManager\Utility\Classes\ProductTrackerUrl;

/**
 * ProductVisits Model
 *
 */
class ProductVisitsTable extends Table
{
    const SESSION_NAME = 'logVisit';
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
        'user_session' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'marketplace_product' => [
            'type' => 'value'
        ],
        'marketplace_name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'search_term' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'position' => [
            'type' => 'value'
        ],
        'marketplace_category' => [
            'type' => 'value'
        ],
        'hits' => [
            'type' => 'value'
        ],
        'user_group' => [
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

        $this->setTable('product_visits');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->addBehavior('VisitManager.ProductUrl');
        $this->addBehavior('VisitManager.Session');
        $this->addBehavior('VisitManager.ConsoleWrite');
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
            ->scalar('user_session')
            ->requirePresence('user_session')
            ->notEmpty('user_session');

        $validator
            ->integer('marketplace_product')
            ->requirePresence('marketplace_product')
            ->notEmpty('marketplace_product');

        $validator
            ->scalar('marketplace_name')
            ->allowEmpty('marketplace_name');

        $validator
            ->scalar('search_term')
            ->allowEmpty('search_term');

        $validator
            ->integer('position')
            ->allowEmpty('position');

        $validator
            ->integer('marketplace_category')
            ->allowEmpty('marketplace_category');

        $validator
            ->integer('hits')
            ->allowEmpty('hits');

        $validator
            ->scalar('user_group')
            ->allowEmpty('user_group');

        return $validator;
    }

    /**
     * @return string
     */
    public function getCurrentSession(): string
    {
        $sessionId = $this->processSession(self::SESSION_NAME);
        return $sessionId;
    }

    /**
     * @param $decodedQueryString
     * @param $userSession
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    private function getProductVisitEntity($decodedQueryString, $userSession)
    {
        return $this->find()
            ->where([
                'user_session' => $userSession ?? null,
                'marketplace_product' => $decodedQueryString['marketplaceProduct'] ?? null,
                'user_group' => $decodedQueryString['userGroup'] ?? null,
                'position' => $decodedQueryString['productPosition'] ?? null
            ])
            ->first();
    }

    /**
     * @param $decodedQueryString
     * @param $sessionId
     */
    private function processNewVisit($decodedQueryString, $sessionId)
    {
        $visitEntity = $this->newEntity();
        $visitEntity->user_session = $sessionId;
        $visitEntity->marketplace_product = $decodedQueryString['marketplaceProduct'] ?? '';
        $visitEntity->marketplace_name = $decodedQueryString['marketplaceName'] ?? '';
        $visitEntity->search_term = $decodedQueryString['searchTerm'] ?? '';
        $visitEntity->position = $decodedQueryString['productPosition'] ?? '';
        $visitEntity->hits = 1;
        $visitEntity->user_group = $decodedQueryString['userGroup'] ?? '';
        $visitEntity->marketplace_category = $decodedQueryString['marketplaceCategory'] ?? '';
        try {
            $this->save($visitEntity);
        } catch (\Exception $exception) {
            Log::warning('Unable to save new Visit.' . $exception->getMessage());
        }
    }

    /**
     * @param $visitEntity
     */
    private function processExistingVisit($visitEntity)
    {
        $visitEntity->hits = $visitEntity->hits + 1;
        try {
            $this->save($visitEntity);
        } catch (\Exception $exception) {
            Log::warning('Unable to save Existing Visit.' . $exception->getMessage());
        }
    }

    /**
     * @param $trackingData
     * @return bool
     */
    public function logVisit($trackingData)
    {
        $sessionId = $this->getCurrentSession();
        $decodedQueryString = $this->generateParametersFromQuery($trackingData);
        $visitEntity = $this->getProductVisitEntity($decodedQueryString, $sessionId);
        if (empty($visitEntity)) {
            $this->processNewVisit($decodedQueryString, $sessionId);
        } else {
            $this->processExistingVisit($visitEntity);
        }
        return true;
    }
}
