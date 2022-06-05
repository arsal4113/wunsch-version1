<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutSessionTotalsFixture
 *
 */
class EbayCheckoutSessionTotalsFixture extends TestFixture
{

    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckoutSessionTotals',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'ebay_checkout_session_id' => 1,
                'code' => 'priceSubtotal',
                'label' => 'Lorem ipsum dolor sit amet',
                'currency' => 'EUR',
                'value' => 1.83,
                'sort_order' => 0,
                'modified' => '2017-11-13 17:49:44',
                'created' => '2017-11-13 17:49:44'
            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }
 
  
}
