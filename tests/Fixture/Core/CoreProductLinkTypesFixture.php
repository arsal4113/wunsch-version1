<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductLinkTypesFixture
 *
 */
class CoreProductLinkTypesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductLinkTypes',
        'connection' => 'default'
    ];
    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'code' => 'cross_selling',
            'name' => 'Cross Selling',
            'created' => '2015-08-18 14:07:05',
            'modified' => '2015-08-18 14:07:05'
        ],
    ];
}
