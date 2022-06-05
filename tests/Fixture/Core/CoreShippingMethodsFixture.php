<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreShippingMethodsFixture
 *
 */
class CoreShippingMethodsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model'      => 'CoreShippingMethods',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Paketversand',
                'code' => 'package',
                'created' => '2016-02-03 14:56:04',
                'modified' => '2016-02-03 14:56:04'
            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }

}