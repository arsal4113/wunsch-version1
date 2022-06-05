<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederGuidesFixture
 */
class FeederGuidesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'table' => 'feeder_guides',
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
                'id' => '1','url' => 'test.com','meta_title' => 'test','robots_tag' => 'test','meta_description' => 'test','title' => 'test','description' => 'test','first_background_image' => 'test','second_background_image' => 'test','display_animation' => '1','animation_image' => 'test','background_color' => 'test','use_in_navigation' => '0','navigation_name' => 'test','sort_order' => '1','optional_urls' => 'pro-opencart.com','optional_url_headers' => NULL,'optional_url_image' => 'test'
            ],
        ];
        parent::init();
    }
}
