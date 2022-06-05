<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoreSellerTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoreSellerTypesTable Test Case
 */
class CoreSellerTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoreSellerTypesTable
     */
    public $CoreSellerTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CoreSellerTypes') ? [] : ['className' => 'App\Model\Table\CoreSellerTypesTable'];
        $this->CoreSellerTypes = TableRegistry::get('CoreSellerTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreSellerTypes);

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
