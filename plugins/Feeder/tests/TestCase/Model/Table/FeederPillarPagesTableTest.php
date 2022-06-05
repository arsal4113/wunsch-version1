<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederPillarPagesTable;

/**
 * Feeder\Model\Table\FeederPillarPagesTable Test Case
 */
class FeederPillarPagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederPillarPagesTable
     */
    public $FeederPillarPages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Feeder.FeederPillarPages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederPillarPages') ? [] : ['className' => FeederPillarPagesTable::class];
        $this->FeederPillarPages = TableRegistry::getTableLocator()->get('FeederPillarPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederPillarPages);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $feederPillarPages = $this->FeederPillarPages->find();
        $this->assertInstanceOf("Cake\Orm\Query", $feederPillarPages);
        $result = $feederPillarPages->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $feederPillarPages = $this->FeederPillarPages->newEntity([
            'id' => 2,
            'title_tag' => 'Lorem ipsum dolor sit amet',
            'meta_tag' => 'Lorem ipsum dolor sit amet',
            'url_path' => 'Lorem ipsum dolor sit amet',
            'tags' => 'Lorem ipsum dolor sit amet',
            'facebook_og_url' => 'Lorem ipsum dolor sit amet',
            'facebook_og_title' => 'Lorem ipsum dolor sit amet',
            'facebook_og_description' => 'Lorem ipsum dolor sit amet',
            'facebook_og_image' => 'Lorem ipsum dolor sit amet',
            'block_configuration' => json_encode([['categoryIds' => 1 , 'itemSource' => 'topSellers', 'itemsTopSellerCategories' => 1 , 'itemsCategory' => 1]]),
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
        ]);
        $result = $this->FeederPillarPages->save($feederPillarPages);
        $this->assertInstanceOf('Feeder\Model\Entity\FeederPillarPage', $result);

    }
}
