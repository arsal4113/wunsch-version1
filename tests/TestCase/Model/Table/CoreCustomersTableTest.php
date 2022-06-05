<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoreCustomersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoreCustomersTable Test Case
 */
class CoreCustomersTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CoreCustomers',
        'app.CoreCustomerAddresses',
        'app.CoreSellers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CoreCustomers') ? [] : ['className' => 'App\Model\Table\CoreCustomersTable'];
        $this->CoreCustomers = TableRegistry::get('CoreCustomers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreCustomers);

        parent::tearDown();
    }

    public function testFindAll()
    {
        $auctionSeller = $this->CoreCustomers->find();
        $this->assertInstanceOf("Cake\Orm\Query", $auctionSeller);
        $result = $auctionSeller->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);

    }

}
