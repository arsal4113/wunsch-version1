<?php
namespace Feeder\Test\TestCase\Shell;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Shell\RefreshFeederCategoriesShell;

/**
 * Feeder\Shell\RefreshFeederCategoriesShell Test Case
 */
class RefreshFeederCategoriesShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;
    
    public $fixtures = [
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederHeroItems',
        'plugin.feeder.FeederCategoriesVideoElements',
        'app.Core/CoreCountries',
        'app.FeederCategoriesFeederHeroItems',
        'plugin.feeder.FeederCategoriesCoreCountries',
    ];

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \Feeder\Shell\RefreshFeederCategoriesShell
     */
    public $RefreshFeederCategories;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->RefreshFeederCategories = new RefreshFeederCategoriesShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RefreshFeederCategories);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->RefreshFeederCategories->main();
        $this->assertEquals([], $this->_out->messages());
    }
}
