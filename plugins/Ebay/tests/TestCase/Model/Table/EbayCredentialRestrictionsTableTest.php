<?php
namespace Ebay\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Ebay\Model\Table\EbayCredentialRestrictionsTable;

/**
 * Ebay\Model\Table\EbayCredentialRestrictionsTable Test Case
 */
class EbayCredentialRestrictionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Ebay\Model\Table\EbayCredentialRestrictionsTable
     */
    public $EbayCredentialRestrictions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.ebay.ebay_credential_restrictions',
        'plugin.ebay.ebay_account_types',
        'plugin.ebay.ebay_accounts',
        'plugin.ebay.ebay_credentials',
        'plugin.ebay.ebay_account_credential_restrictions',
        'plugin.ebay.core_sellers',
        'plugin.ebay.core_languages',
        'plugin.ebay.core_countries',
        'plugin.ebay.core_configurations',
        'plugin.ebay.core_customer_addresses',
        'plugin.ebay.core_customers',
        'plugin.ebay.core_users',
        'plugin.ebay.aros',
        'plugin.ebay.acos',
        'plugin.ebay.permissions',
        'plugin.ebay.core_user_roles',
        'plugin.ebay.core_user_roles_core_users',
        'plugin.ebay.default_shipping_addresses',
        'plugin.ebay.default_billing_addresses',
        'plugin.ebay.core_seller_types',
        'plugin.ebay.core_seller_addresses',
        'plugin.ebay.ebay_sites',
        'plugin.ebay.ebay_categories',
        'plugin.ebay.ebay_category_mappings',
        'plugin.ebay.ebay_accounts_ebay_sites',
        'plugin.ebay.core_currencies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EbayCredentialRestrictions') ? [] : ['className' => 'Ebay\Model\Table\EbayCredentialRestrictionsTable'];
        $this->EbayCredentialRestrictions = TableRegistry::get('EbayCredentialRestrictions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EbayCredentialRestrictions);

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
