<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class CustomerGendersFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CustomerGenders',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'gender' => 'all',
            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }

}