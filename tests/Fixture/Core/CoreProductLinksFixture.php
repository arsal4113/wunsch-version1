<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductLinksFixture
 *
 */
class CoreProductLinksFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductLinks',
        'connection' => 'default'
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
