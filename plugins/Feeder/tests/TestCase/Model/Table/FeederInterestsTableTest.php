<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederInterestsTable;

/**
 * Feeder\Model\Table\FeederInterestsTable Test Case
 */
class FeederInterestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederInterestsTable
     */
    public $FeederInterests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Feeder.FeederInterests',
        'plugin.Feeder.CustomerGenders',
        'plugin.Feeder.FeederInterestSubcategories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederInterests') ? [] : ['className' => FeederInterestsTable::class];
        $this->FeederInterests = TableRegistry::getTableLocator()->get('FeederInterests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederInterests);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testFindAll()
    {
        $feederInterests = $this->FeederInterests->find();
        $this->assertInstanceOf("Cake\Orm\Query", $feederInterests);
        $result = $feederInterests->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $feederInterests = $this->FeederInterests->newEntity([
            'id' => 2,
            'name' => 'Lorem ipsum dolor sit amet',
            'image' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'sale_only' => 1,
            'gender_id' => 1
        ]);
        $result = $this->FeederInterests->save($feederInterests);
        $this->assertInstanceOf('Feeder\Model\Entity\FeederInterest', $result);

    }
}
