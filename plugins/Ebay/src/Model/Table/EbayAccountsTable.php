<?php

namespace Ebay\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * EbayAccounts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EbayAccountTypes
 * @property \Cake\ORM\Association\BelongsTo $EbayCredentials
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \Cake\ORM\Association\HasMany $EbayAutoListerConfigurations
 * @property \Cake\ORM\Association\HasMany $EbayFeedbackMessages
 * @property \Cake\ORM\Association\HasMany $EbayLaunchProfiles
 * @property \Cake\ORM\Association\HasMany $EbayListings
 * @property EbayRestApiAccessTokensTable $EbayRestApiAccessTokens
 * @property \Ebay\Model\Table\EbayItemLocksTable $EbayItemLocks
 * @property \Cake\ORM\Association\BelongsToMany $EbaySites
 * @property \Cake\ORM\Association\HasOne $EbayBusinessPolicyProfiles
 */
class EbayAccountsTable extends Table
{
    use DbCacheTrait;

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
        'ebay_account_type_id' => [
            'type' => 'value'
        ],
        'ebay_credential_id' => [
            'type' => 'value'
        ],
        'core_seller_id' => [
            'type' => 'value'
        ],
        'is_active' => [
            'type' => 'value'
        ],
        'code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'token' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'token_expiration_time' => [
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

        $this->addBehavior('Timestamp');
        $this->addBehavior('Ocl');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('EbayAccountTypes', [
            'foreignKey' => 'ebay_account_type_id',
            'joinType' => 'LEFT',
            'className' => 'Ebay.EbayAccountTypes'
        ]);
        $this->belongsTo('EbayCredentials', [
            'foreignKey' => 'ebay_credential_id',
            'joinType' => 'LEFT',
            'className' => 'Ebay.EbayCredentials'
        ]);
        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER',
            'className' => 'CoreSellers'
        ]);
        $this->belongsToMany('EbaySites', [
            'foreignKey' => 'ebay_account_id',
            'targetForeignKey' => 'ebay_site_id',
            'joinTable' => 'ebay_accounts_ebay_sites',
            'className' => 'Ebay.EbaySites'
        ]);
        $this->hasMany('EbayRestApiAccessTokens', [
            'foreignKey' => 'ebay_account_id',
            'className' => 'Ebay.EbayRestApiAccessTokens'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('is_active', 'valid', ['rule' => 'numeric'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('token');

        $validator
            ->allowEmpty('token_expiration_time');

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
        $rules->add($rules->existsIn(['ebay_account_type_id'], 'EbayAccountTypes'));
        $rules->add($rules->existsIn(['ebay_credential_id'], 'EbayCredentials'));
        $rules->add($rules->existsIn(['core_seller_id'], 'CoreSellers'));
        return $rules;
    }

    /**
     * Get eBay accounts by status
     *
     * @param integer $isActive
     * @return \Cake\Datasource\ResultSetInterface
     */
    public function getEbayAccounts($isActive = 1)
    {
        $ebayAccounts = $this->find()
            ->contain([
                'EbayCredentials',
                'EbayAccountTypes',
                'EbaySites'
            ])
            ->cache('get_active_ebay_accounts', Application::SHORT_TERM_CACHE)
            ->where([
                $this->getAlias() . '.is_active' => $isActive,
            ])->all();

        return $ebayAccounts;
    }

    /**
     * Load active accounts
     *
     * @return array|\Cake\ORM\Query
     */
    public function loadActiveAccounts()
    {
        $conditions = [$this->getAlias() . '.is_active' => 1];
        $contain = ['EbaySites.CoreCurrencies'];

        return $this->find('all')
            ->cache('load_active_accounts', Application::SHORT_TERM_CACHE)
            ->where($conditions)
            ->contain($contain);
    }

    /**
     * @param Event $event
     * @param Entity $entity
     * @param \ArrayObject $options
     */
    public function afterSave(Event $event, Entity $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);

        if ($entity->isDirty('token_expiration_time')) {
            $event = new Event('Model.EbayAccounts.TokenExpirationTimeChanged', $this, [
                'ebayAccount' => $entity
            ]);
            $this->getEventManager()->dispatch($event);
        }
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
        return true;
    }

    /**
     * @param $ebayAccountId
     * @return bool|\Cake\Datasource\EntityInterface|false|mixed
     * @throws \Exception
     */
    public function setEbayTokenAsExpired($ebayAccountId)
    {
        $account = $this->find()
            ->where(['id' => $ebayAccountId])
            ->first();
        if (!empty($account)) {
            $account->token_expiration_time = new \DateTime('now', new \DateTimeZone('c'));
            $account->token = null;
            return $this->save($account);
        }
        return false;
    }
}
