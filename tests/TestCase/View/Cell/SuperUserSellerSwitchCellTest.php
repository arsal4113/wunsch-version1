<?php
namespace App\Test\TestCase\View\Cell;

use App\View\Cell\SuperUserSellerSwitchCell;
use Cake\TestSuite\TestCase;

/**
 * App\View\Cell\SuperUserSellerSwitchCell Test Case
 */
class SuperUserSellerSwitchCellTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->request = $this->getMock('Cake\Network\Request');
        $this->response = $this->getMock('Cake\Network\Response');
        $this->SuperUserSellerSwitch = new SuperUserSellerSwitchCell($this->request, $this->response);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SuperUserSellerSwitch);

        parent::tearDown();
    }

    /**
     * Test display method
     *
     * @return void
     */
    public function testDisplay()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
