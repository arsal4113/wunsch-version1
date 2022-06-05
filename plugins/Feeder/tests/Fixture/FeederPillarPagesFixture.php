<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederPillarPagesFixture
 *
 */
class FeederPillarPagesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'FeederPillarPages',
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
                'title_tag' => 'Lorem ipsum dolor sit amet',
                'meta_tag' => 'Lorem ipsum dolor sit amet',
                'url_path' => 'Lorem ipsum dolor sit amet',
                'tags' => 'Lorem ipsum dolor sit amet',
                'facebook_og_url' => 'Lorem ipsum dolor sit amet',
                'facebook_og_title' => 'Lorem ipsum dolor sit amet',
                'facebook_og_description' => 'Lorem ipsum dolor sit amet',
                'facebook_og_image' => 'Lorem ipsum dolor sit amet',
                'block_configuration' => json_encode([['categoryIds' => 1 , 'itemSource' => 'fromCategory', 'itemsTopSellerCategories' => 1 , 'itemsCategory' => 1],['categoryIds' => 1 , 'itemSource' => 'topSellers', 'itemsTopSellerCategories' => 1 , 'itemsCategory' => 1]]),
                'items_status' => 2,
                'robots_tag' => 'Lorem ipsum dolor sit amet',
                'first_block_image' => 'Lorem ipsum dolor sit amet',
                'first_block_title' => 'Lorem ipsum dolor sit amet',
                'fist_block_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'fist_block_cta_text' => 'Lorem ipsum dolor sit amet',
                'fist_block_cta_link' => 'Lorem ipsum dolor sit amet',
                'second_block_image' => 'Lorem ipsum dolor sit amet',
                'second_block_title' => 'Lorem ipsum dolor sit amet',
                'second_block_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'second_block_cta_text' => 'Lorem ipsum dolor sit amet',
                'second_block_cta_link' => 'Lorem ipsum dolor sit amet',
                'third_block_image' => 'Lorem ipsum dolor sit amet',
                'third_block_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'third_block_follow_color' => 'Lorem ipsum dolor sit amet',
                'fourth_block_title' => 'Lorem ipsum dolor sit amet',
                'fourth_block_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'fourth_block_cta_text' => 'Lorem ipsum dolor sit amet',
                'fourth_block_cta_link' => 'Lorem ipsum dolor sit amet',
                'fifth_block_title' => 'Lorem ipsum dolor sit amet',
                'fifth_block_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'fifth_block_cta_text' => 'Lorem ipsum dolor sit amet',
                'fifth_block_cta_link' => 'Lorem ipsum dolor sit amet',
                'uploaded_image_size' => 12,
                'guide_image' => 'Lorem ipsum dolor sit amet',
                'guide_headline' => 'Lorem ipsum dolor sit amet',
                'created' => '2019-09-02 13:07:57',
                'modified' => '2019-09-02 13:07:57'
            ],
        ];
        parent::init();
    }
}
