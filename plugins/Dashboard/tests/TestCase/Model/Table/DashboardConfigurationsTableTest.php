<?php
namespace Dashboard\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Dashboard\Model\Table\DashboardConfigurationsTable;

/**
 * Dashboard\Model\Table\DashboardConfigurationsTable Test Case
 */
class DashboardConfigurationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Dashboard\Model\Table\DashboardConfigurationsTable
     */
    public $DashboardConfigurations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Dashboard.DashboardConfigurations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('DashboardConfigurations') ? [] : ['className' => DashboardConfigurationsTable::class];
        $this->DashboardConfigurations = TableRegistry::getTableLocator()->get('DashboardConfigurations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DashboardConfigurations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $dashboardConfigurations = $this->DashboardConfigurations->find();
        $this->assertInstanceOf("Cake\Orm\Query", $dashboardConfigurations);
        $result = $dashboardConfigurations->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $dashboardConfigurations = $this->DashboardConfigurations->newEntity([
            'id' => 2,
            'cell_name' => 'Customers',
            'cell_configuration' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'created' => '2021-01-05 23:26:36',
            'modified' => '2021-01-05 23:26:36'
        ]);
        $result = $this->DashboardConfigurations->save($dashboardConfigurations);
        $this->assertInstanceOf('Dashboard\Model\Entity\DashboardConfiguration', $result);

    }
}
