<?php
namespace Dashboard\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DashboardConfigurationsFixture
 *
 */
class DashboardConfigurationsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_seller_type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_seller_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_user_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cell_name' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cell_configuration' => ['type' => 'string', 'length' => 512, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sort_order' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_seller_id' => ['type' => 'index', 'columns' => ['core_seller_id'], 'length' => []],
            'core_user_id' => ['type' => 'index', 'columns' => ['core_user_id'], 'length' => []],
            'core_seller_type_id' => ['type' => 'index', 'columns' => ['core_seller_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'dashboard_configurations_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_seller_id'], 'references' => ['core_sellers', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'dashboard_configurations_ibfk_2' => ['type' => 'foreign', 'columns' => ['core_user_id'], 'references' => ['core_users', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'dashboard_configurations_ibfk_3' => ['type' => 'foreign', 'columns' => ['core_seller_type_id'], 'references' => ['core_seller_types', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
                'id' => 1,
                'core_seller_type_id' => 1,
                'core_seller_id' => 5,
                'core_user_id' => 1,
                'cell_name' => 'Customers',
                'cell_configuration' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 1,
                'created' => '2021-01-05 23:26:36',
                'modified' => '2021-01-05 23:26:36',
            ],
            [
                'id' => 2,
                'core_seller_type_id' => 1,
                'core_seller_id' => 1,
                'core_user_id' => 6,
                'cell_name' => 'Customers',
                'cell_configuration' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 1,
                'created' => '2021-01-05 23:26:36',
                'modified' => '2021-01-05 23:26:36',
            ],
            [
                'id' => 3,
                'core_seller_type_id' => 1,
                'core_seller_id' => 8,
                'core_user_id' => 9,
                'cell_name' => 'Customers',
                'cell_configuration' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 1,
                'created' => '2021-01-05 23:26:36',
                'modified' => '2021-01-05 23:26:36',
            ],

        ];
        parent::init();
    }
}
