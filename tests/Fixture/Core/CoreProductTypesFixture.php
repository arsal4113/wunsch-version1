<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductTypesFixture
 *
 */
class CoreProductTypesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductTypes',
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
            'code' => 'simple',
            'name' => 'Simple Product',
            'created' => '2015-04-15 16:50:18',
            'modified' => '2015-04-15 16:50:18'
        ],
    ];
}
