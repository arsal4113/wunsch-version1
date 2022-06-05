<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederWorldsFixture
 *
 */
class FeederWorldsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_worlds',
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
                'name' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'link' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 0,
                'modified' => '2018-10-02 11:36:09',
                'created' => '2018-10-02 11:36:09'
            ],
        ];
        parent::init();
    }
}
