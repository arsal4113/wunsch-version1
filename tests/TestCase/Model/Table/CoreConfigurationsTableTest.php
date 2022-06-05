<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoreConfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoreConfigurationsTable Test Case
 */
class CoreConfigurationsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CoreConfigurations',
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
        $config = TableRegistry::exists('CoreConfigurations') ? [] : ['className' => 'App\Model\Table\CoreConfigurationsTable'];
        $this->CoreConfigurations = TableRegistry::get('CoreConfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreConfigurations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->assertTrue($this->CoreConfigurations->behaviors()->has('Timestamp'));
        $this->assertTrue($this->CoreConfigurations->associations()->has('CoreSellers'));
    }

    public function testFindAll()
    {
        $auctionSeller = $this->CoreConfigurations->find();
        $this->assertInstanceOf("Cake\Orm\Query", $auctionSeller);
        $result = $auctionSeller->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $auctionSeller = $this->CoreConfigurations->newEntity([
            'id' => 2,
            'core_seller_id' => 1,
            'configuration_group' => 'ConfigGroup',
            'configuration_path' => 'config_path',
            'configuration_value' => 'config_value',
            'created' => '2015-04-10 12:09:21',
            'modified' => '2015-04-10 12:09:21'
        ]);
        $result = $this->CoreConfigurations->save($auctionSeller);
        $this->assertInstanceOf('App\Model\Entity\CoreConfiguration', $result);

    }

    public function testDelete()
    {
        $auctionSeller = $this->CoreConfigurations->newEntity([
            'id' => 2,
            'core_seller_id' => 1,
            'configuration_group' => 'ConfigGroup',
            'configuration_path' => 'config_path',
            'configuration_value' => 'config_value',
            'created' => '2015-04-10 12:09:21',
            'modified' => '2015-04-10 12:09:21'
        ]);
        $result = $this->CoreConfigurations->save($auctionSeller);
        $this->assertInstanceOf('App\Model\Entity\CoreConfiguration', $result);
        $result = $this->CoreConfigurations->delete($auctionSeller);
        $this->assertEquals(true, $result);

    }

    public function testSellerConfigurations()
    {

        $auctionSeller = $this->CoreConfigurations->loadSellerConfiguration(1, 'configuration_path');
        $configurationGroup = $this->CoreConfigurations->getDistinctConfigurationGroup();
        $configurationGroupNames = $this->CoreConfigurations->getConfigGroupNames();
        $configurationInfo = $this->CoreConfigurations->getConfigurationInfo();

        $this->assertEquals(false, $auctionSeller);
    }
}
