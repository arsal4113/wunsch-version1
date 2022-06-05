<?php
namespace Feeder\Test\Fixture;

use Cake\Core\Configure;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Datasource\ConnectionManager;
/**
 * FeederFizzyBubblesFixture
 *
 */
class FeederFizzyBubblesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_fizzy_bubbles',
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
                'url' => 'Lorem ipsum dolor sit amet',
                'title_text' => 'Lorem ipsum dolor sit amet',
                'title_color' => 'Lorem ipsum dolor sit amet',
                'title_opacity' => 1,
                'subline_text' => 'Lorem ipsum dolor sit amet',
                'subline_color' => 'Lorem ipsum dolor sit amet',
                'subline_opacity' => 1,
                'image_src' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 'Lorem ipsum dolor ',
                'start_time' => '2019-09-02 13:07:57',
                'end_time' => '2019-09-02 13:07:57'
            ],
        ];
        parent::init();
    }
}
