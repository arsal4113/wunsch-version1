<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CurrencyComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CurrencyComponent Test Case
 */
class CurrencyComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\CurrencyComponent
     */
    public $Currency;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Currency = new CurrencyComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Currency);

        parent::tearDown();
    }

    /**
     * Test formatCurrency method
     *
     * @return void
     */
    public function testFormatCurrency()
    {
        $result = $this->Currency->formatCurrency(10, 'usd');
        $this->assertEquals('US $10.00', $result);
    }
}
