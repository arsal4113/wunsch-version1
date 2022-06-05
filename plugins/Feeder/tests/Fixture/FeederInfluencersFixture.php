<?php

namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederInfluencersFixture
 */
class FeederInfluencersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'table'      => 'feeder_influencers',
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
                'id'                 => '1',
                'name'               => 'test',
                'url_path'           => 'test',
                'title_tag'          => 'test',
                'meta_description'   => 'test',
                'robot_tag'          => 'test',
                'area_1_headline'    => 'test',
                'area_1_text'        => 'test',
                'area_2_text'        => 'test',
                'area_2_link'        => 'test',
                'area_3_image'       => 'test',
                'area_3_video'       => 'test',
                'area_5_text'        => 'test',
                'area_5_image_1'     => 'test',
                'area_5_image_2'     => 'test',
                'area_5_image_3'     => 'test',
                'area_5_image_4'     => 'test',
                'area_5_image_5'     => 'test',
                'area_5_image_6'     => 'test',
                'area_6_image_1'     => 'test',
                'area_6_image_2'     => 'test',
                'area_6_image_3'     => 'test',
                'area_7_text'        => 'test',
                'area_7_text_mobile' => 'test',
                'area_8_image'       => 'test',
                'area_8_headline_1'  => 'test',
                'area_8_headline_2'  => 'test',
                'area_8_subline'     => 'test',
                'area_8_button_link' => 'test',
                'area_8_world_id'    => '1',
                'area_8_ig_name'     => 'test',
                'area_8_ig_link'     => 'test',
                'area_9_image'       => 'test',
                'area_9_headline_1'  => 'test',
                'area_9_headline_2'  => 'test',
                'area_9_subline'     => 'test',
                'area_9_button_link' => 'test',
                'area_9_world_id'    => '1',
                'area_9_ig_name'     => 'test',
                'area_9_ig_link'     => 'test',
            ],
        ];
        parent::init();
    }
}
