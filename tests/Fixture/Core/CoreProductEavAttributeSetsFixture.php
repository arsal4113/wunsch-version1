<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreProductEavAttributeSetsFixture
 *
 */
class CoreProductEavAttributeSetsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreProductEavAttributeSets',
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
            'core_seller_id' => 1,
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'created' => '2015-07-08 11:28:12',
            'modified' => '2015-07-08 11:28:12'
        ],
    ];
}
