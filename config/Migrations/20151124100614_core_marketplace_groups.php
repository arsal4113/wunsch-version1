<?php
use Migrations\AbstractMigration;

class CoreMarketplaceGroups extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('core_marketplace_groups')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['code'])
            ->create();


        $this->execute("
	   		    INSERT INTO `core_marketplace_groups` (`id`, `code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'ebay', 'eBay', NOW(), NOW()),
	   		      (NULL, 'amazon', 'Amazon', NOW(), NOW()),
	   		      (NULL, 'magento', 'Magento', NOW(), NOW());
	   	        ");


        $this->table('core_marketplaces')
            ->addColumn('core_marketplace_group_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->addIndex(['core_marketplace_group_id'])
            ->update();

        $ebayGroup = $this->fetchRow('SELECT id FROM core_marketplace_groups WHERE code = "ebay"');
        $amazonGroup = $this->fetchRow('SELECT id FROM core_marketplace_groups WHERE code = "amazon"');
        $magentoGroup = $this->fetchRow('SELECT id FROM core_marketplace_groups WHERE code = "magento"');

        $this->execute('UPDATE core_marketplaces SET core_marketplace_group_id = ' . $ebayGroup['id'] . ' WHERE code LIKE "%ebay%"');
        $this->execute('UPDATE core_marketplaces SET core_marketplace_group_id = ' . $amazonGroup['id'] . ' WHERE code LIKE "%amazon%"');
        $this->execute('UPDATE core_marketplaces SET core_marketplace_group_id = ' . $magentoGroup['id'] . ' WHERE code LIKE "%magento%"');
    }
}
