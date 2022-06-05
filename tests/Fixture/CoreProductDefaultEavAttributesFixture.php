<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductDefaultEavAttributesFixture
 *
 */
class CoreProductDefaultEavAttributesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_marketplace_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'code' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'data_type' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'is_required' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'multiple_values' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'sort_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'is_configurable' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_marketplace_id' => ['type' => 'index', 'columns' => ['core_marketplace_id'], 'length' => []],
            'code' => ['type' => 'index', 'columns' => ['code'], 'length' => []],
            'data_type' => ['type' => 'index', 'columns' => ['data_type'], 'length' => []],
            'is_required' => ['type' => 'index', 'columns' => ['is_required'], 'length' => []],
            'multiple_values' => ['type' => 'index', 'columns' => ['multiple_values'], 'length' => []],
            'is_configurable' => ['type' => 'index', 'columns' => ['is_configurable'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'core_product_default_eav_attributes_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_marketplace_id'], 'references' => ['core_marketplaces', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
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
            'core_marketplace_id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'data_type' => 'Lorem ips',
            'is_required' => 1,
            'multiple_values' => 1,
            'sort_order' => 1,
            'is_configurable' => 1,
            'created' => '2015-08-03 10:55:58',
            'modified' => '2015-08-03 10:55:58'
        ],
    ];
}
