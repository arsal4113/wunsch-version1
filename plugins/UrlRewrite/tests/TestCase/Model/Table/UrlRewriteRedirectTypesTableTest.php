<?php
namespace UrlRewrite\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UrlRewrite\Model\Table\UrlRewriteRedirectTypesTable;

/**
 * UrlRewrite\Model\Table\UrlRewriteRedirectTypesTable Test Case
 */
class UrlRewriteRedirectTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UrlRewrite\Model\Table\UrlRewriteRedirectTypesTable
     */
    public $UrlRewriteRedirectTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.url_rewrite.url_rewrite_redirect_types',
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
        $config = TableRegistry::exists('UrlRewriteRedirectTypes') ? [] : ['className' => UrlRewriteRedirectTypesTable::class];
        $this->UrlRewriteRedirectTypes = TableRegistry::get('UrlRewriteRedirectTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UrlRewriteRedirectTypes);

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
