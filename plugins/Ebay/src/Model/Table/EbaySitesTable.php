<?php
namespace Ebay\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Ebay\Model\Entity\EbaySite;

/**
 * EbaySites Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EbaySites
 * @property \Cake\ORM\Association\BelongsTo $EbayGlobals
 * @property \Cake\ORM\Association\HasMany $EbayCategories
 * @property \Cake\ORM\Association\HasMany $EbayCategorySpecificValueRecommendations
 * @property \Cake\ORM\Association\HasMany $EbayLaunchProfiles
 * @property \Cake\ORM\Association\HasMany $EbayListings
 * @property \Cake\ORM\Association\BelongsToMany $EbayAccounts
 */
class EbaySitesTable extends Table
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
        'ebay_site_id' => [
            'type' => 'value'
        ],
        'ebay_global_id' => [
            'type' => 'value'
        ],
        'core_marketplace_id' => [
            'type' => 'value'
        ],
        'core_currency_id' => [
            'type' => 'value'
        ],
        'is_active' => [
            'type' => 'value'
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'language' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'ebay_site_code_type' => [
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
        $this->table('ebay_sites');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->hasMany('EbayCategories', [
            'foreignKey' => 'ebay_site_id',
            'className' => 'Ebay.EbayCategories'
        ]);
        $this->belongsToMany('EbayAccounts', [
            'foreignKey' => 'ebay_site_id',
            'targetForeignKey' => 'ebay_account_id',
            'joinTable' => 'ebay_accounts_ebay_sites',
            'className' => 'Ebay.EbayAccounts'
        ]);
        $this->belongsTo('CoreCurrencies', [
            'foreignKey' => 'core_currency_id',
            'className' => 'CoreCurrencies',
            'joinType' => 'LEFT'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('language', 'create')
            ->notEmpty('language');

        $validator
            ->allowEmpty('is_active');

        return $validator;
    }
}
