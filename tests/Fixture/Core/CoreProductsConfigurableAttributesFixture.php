<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductsConfigurableAttributesFixture
 */
class CoreProductsConfigurableAttributesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductsConfigurableAttributes',
        'connection' => 'default'
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
                'created' => '2020-10-02 01:38:27',
                'modified' => '2020-10-02 01:38:27',
            ],
        ];
        parent::init();
    }
}
