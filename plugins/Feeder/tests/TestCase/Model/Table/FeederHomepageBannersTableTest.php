<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederHomepageBannersTable;

/**
 * Feeder\Model\Table\FeederHomepageBannersTable Test Case
 */
class FeederHomepageBannersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederHomepageBannersTable
     */
    public $FeederHomepageBanners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.feeder.feeder_homepage_banners',
        'plugin.feeder.feeder_homepages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeederHomepageBanners') ? [] : ['className' => FeederHomepageBannersTable::class];
        $this->FeederHomepageBanners = TableRegistry::get('FeederHomepageBanners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederHomepageBanners);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
