<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreSellersFixture
 */
class CoreSellersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_country_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_language_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_seller_type_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'code' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'is_active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'is_deleted' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'activation_token' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'uuid' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_language_id' => ['type' => 'index', 'columns' => ['core_language_id'], 'length' => []],
            'is_active' => ['type' => 'index', 'columns' => ['is_active'], 'length' => []],
            'core_country_id' => ['type' => 'index', 'columns' => ['core_country_id'], 'length' => []],
            'core_seller_type_id' => ['type' => 'index', 'columns' => ['core_seller_type_id'], 'length' => []],
            'is_deleted' => ['type' => 'index', 'columns' => ['is_deleted'], 'length' => []],
            'uuid' => ['type' => 'index', 'columns' => ['uuid'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'core_sellers_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_language_id'], 'references' => ['core_languages', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id'                  => 1,
                'code'                => 'admin',
                'name'                => 'Admin',
                'core_language_id'    => 1,
                'core_country_id'     => 1,
                'core_seller_type_id' => 1,
                'uuid'                => 'fb058b6c-7fbb-43b4-8680-a4c9ec62f114',
                'is_active'           => 1,
                'created'             => '2015-11-10 15:46:17',
                'modified'            => '2015-11-10 15:46:17'
            ],
            [
                'id'                  => 2,
                'code'                => 'admin',
                'name'                => 'Admin',
                'core_language_id'    => 1,
                'core_country_id'     => 1,
                'core_seller_type_id' => 1,
                'activation_token'    => '125d25',
                'uuid'                  => 'd0ec6484-c07d-11e7-abc4-cec278b6b50a',
                'is_active'           => 0,
                'created'             => '2015-11-10 15:46:17',
                'modified'            => '2015-11-10 15:46:17'
            ]
        ];
        parent::init();
    }
}
