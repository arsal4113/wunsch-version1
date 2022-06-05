<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoreErrorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoreErrorsTable Test Case
 */
class CoreErrorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoreErrorsTable
     */
    public $CoreErrors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CoreErrors',
        //'app.Core/CoreSellers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CoreErrors') ? [] : ['className' => 'App\Model\Table\CoreErrorsTable'];
        $this->CoreErrors = TableRegistry::get('CoreErrors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreErrors);

        parent::tearDown();
    }

    public function testFindAll()
    {
        $auctionSeller = $this->CoreErrors->find();
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
        $auctionSeller = $this->CoreErrors->newEntity([
            'id' => 2,
            'core_seller_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'foreign_key' => 'Lorem ipsum dolor sit amet',
            'foreign_model' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-03 15:03:13',
            'modified' => '2016-02-03 15:03:13'
        ]);
        $result = $this->CoreErrors->save($auctionSeller);
        $this->assertInstanceOf('App\Model\Entity\CoreError', $result);

    }
    public function testLogError()
    {
        $auctionSeller = $this->CoreErrors->logError(1,
            "400",
            "404",
            "Testing",
            '',
            '',
            'Error',
            null,
            null);
        $this->assertInstanceOf('App\Model\Entity\CoreError', $auctionSeller);

    }

}
