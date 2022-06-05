<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCredentialsFixture
 */
class EbayCredentialsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCredentials',
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
                'id' => 6,
                'ebay_account_type_id' => 2,
                'key_set_name' => 'deals_guru live',
                'app_id' => 'iwayssal-DealsGur-PRD-ef1a91299-e692a0d4',
                'dev_id' => 'fe99e7f9-ee4d-4c88-a553-8b44db222f20',
                'cert_id' => 'PRD-f1a91299c82e-5661-4115-b878-7242',
                'ru_name' => '1',
                'is_active' => 1,
                'created' => '2020-12-22 20:58:43',
                'modified' => '2020-12-22 20:58:43',
            ],
        ];
        parent::init();
    }
}
