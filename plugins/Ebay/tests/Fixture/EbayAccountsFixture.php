<?php
namespace Ebay\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayAccountsFixture
 *
 */
class EbayAccountsFixture extends TestFixture
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
        'ebay_credential_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_seller_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_active' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'code' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'token' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'token_expiration_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'ebay_account_type_id' => ['type' => 'index', 'columns' => ['ebay_account_type_id'], 'length' => []],
            'ebay_credential_id' => ['type' => 'index', 'columns' => ['ebay_credential_id'], 'length' => []],
            'core_seller_id' => ['type' => 'index', 'columns' => ['core_seller_id'], 'length' => []],
            'is_active' => ['type' => 'index', 'columns' => ['is_active'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'ebay_accounts_ibfk_1' => ['type' => 'foreign', 'columns' => ['ebay_account_type_id'], 'references' => ['ebay_account_types', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
            'ebay_accounts_ibfk_2' => ['type' => 'foreign', 'columns' => ['ebay_credential_id'], 'references' => ['ebay_credentials', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
            'ebay_accounts_ibfk_3' => ['type' => 'foreign', 'columns' => ['core_seller_id'], 'references' => ['core_sellers', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
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
            'ebay_credential_id' => 1,
            'core_seller_id' => 1,
            'is_active' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'token_expiration_time' => '2015-11-25 10:47:01',
            'created' => '2015-11-25 10:47:01',
            'modified' => '2015-11-25 10:47:01'
        ],
    ];
}
