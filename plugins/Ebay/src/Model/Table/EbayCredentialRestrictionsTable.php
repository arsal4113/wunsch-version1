<?php
namespace Ebay\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ebay\Model\Entity\EbayCredentialRestriction;

/**
 * EbayCredentialRestrictions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EbayAccountTypes
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \Cake\ORM\Association\BelongsTo $EbayCredentials
 */
class EbayCredentialRestrictionsTable extends Table
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
        'core_seller_id' => [
            'type' => 'value'
        ],
        'ebay_credential_id' => [
            'type' => 'value'
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

        $this->setTable('ebay_credential_restrictions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('EbayAccountTypes', [
            'foreignKey' => 'ebay_account_type_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbayAccountTypes'
        ]);
        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER',
            'className' => 'CoreSellers'
        ]);
        $this->belongsTo('EbayCredentials', [
            'foreignKey' => 'ebay_credential_id',
            'joinType' => 'INNER',
            'className' => 'Ebay.EbayCredentials'
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
        $rules->add($rules->existsIn(['core_seller_id'], 'CoreSellers'));
        $rules->add($rules->existsIn(['ebay_credential_id'], 'EbayCredentials'));
        return $rules;
    }
}
