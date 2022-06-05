<?php
namespace UrlRewrite\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UrlRewrite\Model\Table\UrlRewriteTypesTable;

/**
 * UrlRewrite\Model\Table\UrlRewriteTypesTable Test Case
 */
class UrlRewriteTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UrlRewrite\Model\Table\UrlRewriteTypesTable
     */
    public $UrlRewriteTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.url_rewrite.url_rewrite_types',
        'plugin.url_rewrite.url_rewrite_redirects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UrlRewriteTypes') ? [] : ['className' => UrlRewriteTypesTable::class];
        $this->UrlRewriteTypes = TableRegistry::get('UrlRewriteTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UrlRewriteTypes);

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
