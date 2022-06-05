<?php
namespace Feeder\Test\Fixture;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederCategoriesVideoElementsFixture
 */
class FeederCategoriesVideoElementsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_categories_video_elements',
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
                'is_active' => 1,
                'video_mp4' => 'Lorem ipsum dolor sit amet',
                'video_webm' => 'Lorem ipsum dolor sit amet',
                'background_color' => 'Lorem ipsum dolor sit amet',
                'headline' => 'Lorem ipsum dolor sit amet',
                'headline_color' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
