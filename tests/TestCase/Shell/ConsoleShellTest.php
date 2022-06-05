<?php
namespace App\Test\TestCase\Shell;

use App\Shell\ConsoleShell;
use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Shell\ConsoleShell Test Case
 */
class ConsoleShellTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    public $psyShell;

    /**
     * Test subject
     *
     * @var \App\Shell\ConsoleShell
     */
    public $Console;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->Console = new ConsoleShell($this->io);
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        //$this->exec('console');
        //$this->assertEquals([], $this->_out->messages());
    }

}


