<?php
namespace EbayCheckout\Test\TestCase\View\Cell;

use Cake\TestSuite\TestCase;
use EbayCheckout\View\Cell\ShippingAddressWidgetCell;

/**
 * EbayCheckout\View\Cell\ShippingAddressWidgetCell Test Case
 */
class ShippingAddressWidgetCellTest extends TestCase
{

    /**
     * Request mock
     *
     * @var \Cake\Network\Request|\PHPUnit_Framework_MockObject_MockObject
     */
    public $request;

    /**
     * Response mock
     *
     * @var \Cake\Http\Response|\PHPUnit_Framework_MockObject_MockObject
     */
    public $response;

    /**
     * Test subject
     *
     * @var \EbayCheckout\View\Cell\ShippingAddressWidgetCell
     */
    public $ShippingAddressWidget;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->request = $this->getMockBuilder('Cake\Network\Request')->getMock();
        $this->response = $this->getMockBuilder('Cake\Network\Response')->getMock();
        $this->ShippingAddressWidget = new ShippingAddressWidgetCell($this->request, $this->response);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ShippingAddressWidget);

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
