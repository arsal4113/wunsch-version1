<?php
namespace Feeder\Test\TestCase\Shell;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Shell\CheckHeroItemsOutOfStockShell;

/**
 * Feeder\Shell\CheckHeroItemsOutOfStockShell Test Case
 */
class CheckHeroItemsOutOfStockShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    public $fixtures = [
        'app.Core/EbayAccounts',
        'app.Core/EbayCredentials',
        'app.Core/EbayAccountTypes',
        'app.EbayRestApiAccessTokens',
        'plugin.Feeder.FeederHeroItems',
        //'app.Core/feeder_hero_items',
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
     * @var \Feeder\Shell\CheckHeroItemsOutOfStockShell
     */
    public $CheckHeroItemsOutOfStock;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->CheckHeroItemsOutOfStock = new CheckHeroItemsOutOfStockShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CheckHeroItemsOutOfStock);

        parent::tearDown();
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        //$this->exec('check_hero_items_out_of_stock');
        $this->CheckHeroItemsOutOfStock->initialize();
        $result = $this->CheckHeroItemsOutOfStock->main();
        $this->assertEquals([], $this->_out->messages());
    }
}
