<?php
namespace Ebay\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayAccountsEbaySites Model
 */
class EbayAccountsEbaySitesTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('ebay_accounts_ebay_sites');
		$this->displayField('id');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Ebay.EbayAccounts', [
			'foreignKey' => 'ebay_account_id',
		]);
		$this->belongsTo('Ebay.EbaySites', [
			'foreignKey' => 'ebay_site_id',
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->add('ebay_account_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('ebay_account_id', 'create')
			->notEmpty('ebay_account_id')
			->add('ebay_site_id', 'valid', ['rule' => 'numeric'])
			->requirePresence('ebay_site_id', 'create')
			->notEmpty('ebay_site_id');

		return $validator;
	}

}
