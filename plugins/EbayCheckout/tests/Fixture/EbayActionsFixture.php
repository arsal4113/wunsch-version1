<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayActionsFixture
 */
class EbayActionsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayActions',
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
                'id' => 1,
                'code' => 'leaveFeedback',
                'name' => 'Leave eBay Feedback',
                'is_active' => 1,
                'created' => '2020-12-22 21:03:20',
                'modified' => '2020-12-22 21:03:20',
            ],
        ];
        parent::init();
    }
}
