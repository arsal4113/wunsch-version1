<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductsFixture
 */
class CoreProductsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_seller_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_product_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_product_eav_attribute_set_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'parent_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sku' => ['type' => 'string', 'length' => 128, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_seller_id' => ['type' => 'index', 'columns' => ['core_seller_id', 'core_product_type_id', 'parent_id', 'sku'], 'length' => []],
            'parent_id' => ['type' => 'index', 'columns' => ['parent_id'], 'length' => []],
            'core_product_eav_attribute_set_id' => ['type' => 'index', 'columns' => ['core_product_eav_attribute_set_id'], 'length' => []],
            'core_product_type_id' => ['type' => 'index', 'columns' => ['core_product_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            //'core_products_ibfk_4' => ['type' => 'foreign', 'columns' => ['core_product_eav_attribute_set_id'], 'references' => ['core_product_eav_attribute_sets', 'id'], 'update' => 'noAction', 'delete' => 'restrict', 'length' => []],
            //'core_products_ibfk_5' => ['type' => 'foreign', 'columns' => ['core_seller_id'], 'references' => ['core_sellers', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            //'core_products_ibfk_6' => ['type' => 'foreign', 'columns' => ['core_product_type_id'], 'references' => ['core_product_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'core_seller_id' => 1,
                'core_product_type_id' => 1,
                'core_product_eav_attribute_set_id' => 1,
                'parent_id' => 1,
                'sku' => 'sku',
                'created' => '2016-02-22 12:17:06',
                'modified' => '2016-02-22 12:17:06'
            ],
        ];
        parent::init();
    }
}
