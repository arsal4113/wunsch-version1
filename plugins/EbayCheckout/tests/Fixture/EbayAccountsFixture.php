<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayAccountsFixture
 */
class EbayAccountsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayAccounts',
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
                'ebay_account_type_id' => '2',
                'ebay_credential_id' => '6',
                'core_seller_id' => '2',
                'epn_identifier' => '5575398383, 5338321111',
                'is_active' => '1',
                'code' => 'deals_guru',
                'name' => 'Deals Guru',
                'token' => '',
                'token_expiration_time' => '2023-05-17 11:57:00',
                'use_notifications' => '0',
                'created' => '2018-03-16 16:51:15',
                'modified' => '2020-12-23 19:56:27'
            ],
        ];
        parent::init();
    }
}
