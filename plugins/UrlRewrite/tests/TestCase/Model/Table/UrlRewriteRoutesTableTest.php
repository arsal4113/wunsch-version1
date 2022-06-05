<?php
namespace UrlRewrite\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * UrlRewrite\Model\Table\UrlRewriteRoutesTable Test Case
 */
class UrlRewriteRoutesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UrlRewrite\Model\Table\UrlRewriteRoutesTable
     */
    public $UrlRewriteRoutes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.url_rewrite.url_rewrite_routes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UrlRewriteRoutes') ? [] : ['className' => UrlRewriteRoutesTable::class];
        $this->UrlRewriteRoutes = TableRegistry::get('UrlRewriteRoutes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UrlRewriteRoutes);

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
