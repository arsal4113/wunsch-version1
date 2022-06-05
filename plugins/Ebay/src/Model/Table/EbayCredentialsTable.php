<?php

namespace Ebay\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ebay\Model\Entity\EbayCredential;

/**
 * EbayCredentials Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EbayAccountTypes
 * @property \Cake\ORM\Association\HasMany $EbayAccounts
 * @property \Cake\ORM\Association\HasMany $EbayCredentialRestrictions
 */
class EbayCredentialsTable extends Table
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
        'ebay_account_type_id' => [
            'type' => 'value'
        ],
        'key_set_name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'app_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'dev_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'cert_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'ru_name' => [
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

        $this->table('ebay_credentials');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('EbayAccountTypes', [
            'foreignKey' => 'ebay_account_type_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbayAccountTypes'
        ]);
        $this->hasMany('EbayAccounts', [
            'foreignKey' => 'ebay_credential_id',
            'className' => 'Ebay.EbayAccounts'
        ]);
        $this->hasMany('EbayCredentialRestrictions', [
            'foreignKey' => 'ebay_credential_id',
            'className' => 'Ebay.EbayCredentialRestrictions'
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
            ->requirePresence('key_set_name', 'create')
            ->notEmpty('key_set_name');

        $validator
            ->requirePresence('ru_name', 'create')
            ->notEmpty('ru_name');

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
        return $rules;
    }


    public function getCredential($ebayAccountTypeId, $coreSellerId = null)
    {
        $credential = null;
        if (is_numeric($coreSellerId)) {
            $restriction = $this->EbayCredentialRestrictions->find()
                ->where([
                    'ebay_account_type_id' => $ebayAccountTypeId,
                    'core_seller_id' => $coreSellerId
                ])
                ->first();
            if (!empty($restriction)) {
                $credential = $this->find()
                    ->where([
                        'id' => $restriction->ebay_credential_id,
                    ])
                    ->first();
            }
        }
        if (empty($credential)) {
            $credential = $this->find()
                ->where([
                    'ebay_account_type_id' => $ebayAccountTypeId,
                    'is_active' => 1
                ])
                ->first();
        }
        return $credential;
    }
}
