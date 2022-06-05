<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayAccountTypesFixture
 */
class EbayAccountTypesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayAccountTypes',
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
                'id' => '1',
                'name' => 'Sandbox',
                'type' => 'sandbox',
                'login_url' => 'https://signin.sandbox.{domain}/ws/eBayISAPI.dll?SignIn&RuName={RuName}&SessID={SessionID}',
                'is_active' => '1',
                'created' => '2018-03-16 10:25:43',
                'modified' => '2018-03-16 11:25:55'
            ],
        ];
        parent::init();
    }
}
