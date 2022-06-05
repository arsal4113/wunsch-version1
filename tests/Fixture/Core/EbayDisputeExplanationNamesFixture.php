<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayListingsFixture
 *
 */
class EbayDisputeExplanationNamesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayDisputeExplanationNames',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                 'ebay_dispute_explanation_id' => 1,
                'core_language_id' => 1,
                'name'  => 'lipsum name',
                'created' => '2016-01-26 12:28:13',
                'modified' => '2016-01-26 12:28:13'
            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }


}
