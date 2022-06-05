<?php

namespace Ebay\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayRestApiAccessTokens Model
 *
 * @property \Ebay\Model\Table\EbayAccountsTable|\Cake\ORM\Association\BelongsTo $EbayAccounts
 *
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken get($primaryKey, $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken newEntity($data = null, array $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken[] newEntities(array $data, array $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken[] patchEntities($entities, array $data, array $options = [])
 * @method \Ebay\Model\Entity\EbayRestApiAccessToken findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayRestApiAccessTokensTable extends Table
{
    use DbCacheTrait;

    const CACHE_KEY_PREFIX = 'cached_ebay_account_id_';
    const CACHE_CONFIG = 'short_term_cache';

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ebay_rest_api_access_tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EbayAccounts', [
            'foreignKey' => 'ebay_account_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbayAccounts'
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
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->requirePresence('token_type', 'create')
            ->notEmpty('token_type');

        $validator
            ->requirePresence('expire_timestamp', 'create')
            ->notEmpty('expire_timestamp');

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
        $rules->add($rules->existsIn(['ebay_account_id'], 'EbayAccounts'));

        return $rules;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);
        return true;
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
}
