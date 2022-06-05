<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductLinksFixture
 *
 */
class CoreProductLinksFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'linked_product_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_product_link_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_product_id' => ['type' => 'index', 'columns' => ['core_product_id'], 'length' => []],
            'linked_product_id' => ['type' => 'index', 'columns' => ['linked_product_id'], 'length' => []],
            'core_product_link_type_id' => ['type' => 'index', 'columns' => ['core_product_link_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'core_product_links_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_product_id'], 'references' => ['core_products', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'core_product_links_ibfk_2' => ['type' => 'foreign', 'columns' => ['linked_product_id'], 'references' => ['core_products', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'core_product_links_ibfk_3' => ['type' => 'foreign', 'columns' => ['core_product_link_type_id'], 'references' => ['core_product_link_types', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
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
            'core_product_id' => 1,
            'linked_product_id' => 1,
            'core_product_link_type_id' => 1,
            'created' => '2015-08-18 14:56:05',
            'modified' => '2015-08-18 14:56:05'
        ],
    ];
}
