<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederGlobalPriceLimitFixture
 *
 */
class FeederGlobalPriceLimitFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
  //  public $table = 'feeder_global_price_limit';
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_global_price_limit',
        'connection' => 'default'
    ];
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    
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
                'price_limit' => 20,
                'created' => '2018-10-22 17:05:45',
                'modified' => '2018-10-22 17:05:45'
            ],
        ];
        parent::init();
    }
}
