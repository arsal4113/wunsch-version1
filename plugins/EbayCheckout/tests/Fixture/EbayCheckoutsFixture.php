<?php
namespace EbayCheckout\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCheckoutsFixture
 *
 */
class EbayCheckoutsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCheckouts',
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
            'id'                        => '1',
            'core_seller_id'            => '1',
            'name'                      => NULL,
            'title'                     => NULL,
            'x_frame_origins'           => NULL,
            'logo'                      => NULL,
            'main_color'                => NULL,
            'second_color'              => NULL,
            'font'                      => NULL,
            'font_color'                => NULL,
            'background_image'          => NULL,
            'background_image_position' => NULL,
            'background_color'          => NULL,
            'modified'                  => '2019-09-05 13:21:17',
            'created'                   => '2019-09-05 13:21:17'
            ],
        ];
        parent::init();
    }

}
