<?php

namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederHeroItemsFixture
 *
 */
class FeederHeroItemsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'table'      => 'feeder_hero_items',
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
                'id'              => '14',
                'type'            => '1',
                'title'           => NULL,
                'category_id'     => '1',
                'webm'            => NULL,
                'mp4'             => NULL,
                'image'           => 'https://storage.googleapis.com/wunsch-upload/feeder_hero_items/image/gadgets_ventilator.png',
                'image_alt_tag'   => '',
                'image_title_tag' => '',
                'item_id'         => '323593478001',
                'url'             => NULL,
                'item_image_url'  => NULL,
                'gender_id'       => '1',
                'is_active'       => '1',
                'sort_order'      => '0',
                'start_time'      => NULL,
                'end_time'        => NULL,
                'modified'        => '2018-06-25 14:29:18',
                'created'         => '2018-06-25 13:26:53'
            ],
            [
                'id'              => '1',
                'type'            => '1',
                'title'           => NULL,
                'category_id'     => '1',
                'webm'            => NULL,
                'mp4'             => NULL,
                'image'           => 'https://storage.googleapis.com/wunsch-upload/feeder_hero_items/image/gadgets_ventilator.png',
                'image_alt_tag'   => '',
                'image_title_tag' => '',
                'item_id'         => '512609413917',
                'url'             => NULL,
                'item_image_url'  => NULL,
                'gender_id'       => '1',
                'is_active'       => '1',
                'sort_order'      => '0',
                'start_time'      => NULL,
                'end_time'        => NULL,
                'modified'        => '2018-06-25 14:29:18',
                'created'         => '2018-06-25 13:26:53'
            ]
        ];
        parent::init();
    }
}
