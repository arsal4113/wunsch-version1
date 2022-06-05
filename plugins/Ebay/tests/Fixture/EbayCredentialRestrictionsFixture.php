<?php
namespace Ebay\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCredentialRestrictionsFixture
 *
 */
class EbayCredentialRestrictionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ebay_account_type_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_seller_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ebay_credential_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ebay_account_type_id' => ['type' => 'index', 'columns' => ['ebay_account_type_id'], 'length' => []],
            'core_seller_id' => ['type' => 'index', 'columns' => ['core_seller_id'], 'length' => []],
            'ebay_credential_id' => ['type' => 'index', 'columns' => ['ebay_credential_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'ebay_credential_restrictions_ibfk_1' => ['type' => 'foreign', 'columns' => ['ebay_account_type_id'], 'references' => ['ebay_account_types', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'ebay_credential_restrictions_ibfk_2' => ['type' => 'foreign', 'columns' => ['core_seller_id'], 'references' => ['core_sellers', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'ebay_credential_restrictions_ibfk_3' => ['type' => 'foreign', 'columns' => ['ebay_credential_id'], 'references' => ['ebay_credentials', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'ebay_account_type_id' => 1,
            'core_seller_id' => 1,
            'ebay_credential_id' => 1
        ],
    ];
}
