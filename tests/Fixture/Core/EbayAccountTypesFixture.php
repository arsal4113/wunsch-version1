<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayAccountTypesFixture
 *
 */
class EbayAccountTypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayAccountTypes',
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
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'login_url' => 'https://signin.sandbox.{domain}/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',
            'is_active' => 1,
            'created' => '2015-07-17 09:51:40',
            'modified' => '2015-07-17 09:51:40'
        ],
    ];
}
