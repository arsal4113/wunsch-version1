<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductAttributeValueTextsFixture
 */
class CoreProductAttributeValueTextsFixture extends TestFixture
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
        'core_product_eav_attribute_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_marketplace_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'value' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_product_id' => ['type' => 'index', 'columns' => ['core_product_id', 'core_product_eav_attribute_id'], 'length' => []],
            'core_product_eav_attribute_id' => ['type' => 'index', 'columns' => ['core_product_eav_attribute_id'], 'length' => []],
            'core_marketplace_id' => ['type' => 'index', 'columns' => ['core_marketplace_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'core_product_attribute_value_texts_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_product_id'], 'references' => ['core_products', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'core_product_attribute_value_texts_ibfk_2' => ['type' => 'foreign', 'columns' => ['core_product_eav_attribute_id'], 'references' => ['core_product_eav_attributes', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'core_product_attribute_value_texts_ibfk_3' => ['type' => 'foreign', 'columns' => ['core_marketplace_id'], 'references' => ['core_marketplaces', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
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
                'core_product_id' => 1,
                'core_product_eav_attribute_id' => 1,
                'core_marketplace_id' => 1,
                'value' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2020-12-17 05:30:20',
                'modified' => '2020-12-17 05:30:20',
            ],
        ];
        parent::init();
    }
}
