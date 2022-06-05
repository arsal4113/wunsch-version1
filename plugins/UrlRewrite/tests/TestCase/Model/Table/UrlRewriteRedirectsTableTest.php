<?php
namespace UrlRewrite\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;

/**
 * UrlRewrite\Model\Table\UrlRewriteRedirectsTable Test Case
 */
class UrlRewriteRedirectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UrlRewrite\Model\Table\UrlRewriteRedirectsTable
     */
    public $UrlRewriteRedirects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.url_rewrite.url_rewrite_redirects',
        'plugin.url_rewrite.url_rewrite_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UrlRewriteRedirects') ? [] : ['className' => UrlRewriteRedirectsTable::class];
        $this->UrlRewriteRedirects = TableRegistry::get('UrlRewriteRedirects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UrlRewriteRedirects);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
