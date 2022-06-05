<?php
namespace ZipData\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ZipData\Model\Table\ZipDataZipsTable;

/**
 * ZipData\Model\Table\ZipDataZipsTable Test Case
 */
class ZipDataZipsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ZipData\Model\Table\ZipDataZipsTable
     */
    public $ZipDataZips;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.zip_data.zip_data_zips'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ZipDataZips') ? [] : ['className' => ZipDataZipsTable::class];
        $this->ZipDataZips = TableRegistry::get('ZipDataZips', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ZipDataZips);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
