<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreSellerTypesFixture
 *
 */
class CoreSellerTypesFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'CoreSellerTypes',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'core_user_role_id' => 1,
                'code' => 'admin',
                'name' => 'Admin',
                'created' => '2016-08-19 13:52:16',
                'modified' => '2016-08-19 13:52:16'
            ]
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }
}
