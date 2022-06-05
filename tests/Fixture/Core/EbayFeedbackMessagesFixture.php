<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayFeedbackMessagesFixture
 *
 */
class EbayFeedbackMessagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayFeedbackMessages',
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
            'core_seller_id' => 1,
            'ebay_account_id' => 1,
            'ebay_feedback_type_id' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-08 13:28:25',
            'modified' => '2016-02-08 13:28:25'
        ],
    ];
}
