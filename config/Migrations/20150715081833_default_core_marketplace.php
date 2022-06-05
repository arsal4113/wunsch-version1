<?php

use Phinx\Migration\AbstractMigration;

class DefaultCoreMarketplace extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('core_marketplaces');
        if(!$table->hasColumn('is_default')) {
            $table->addColumn('is_default', 'boolean', ['default' => null, 'limit' => null, 'null' => false, 'after' => 'name'])
                ->addIndex(['is_default'])
                ->update();
        }
        
        $this->execute("DELETE FROM core_marketplaces");
        $this->execute("ALTER TABLE `core_marketplaces` auto_increment = 1;");
        $this->execute("INSERT INTO `core_marketplaces` (`id`, `code`, `name`, `is_default`, `is_active`, `created`, `modified`) VALUES
            (NULL, 'default', 'Default', 1, 1, NOW(), NOW()),
            (NULL, 'ebay-de', 'eBay Germany', 0, 1, NOW(), NOW()),
            (NULL, 'ebay-us', 'eBay US', 0, 1, NOW(), NOW()),
            (NULL, 'amazon-de', 'Amazon Germany', 0, 1, NOW(), NOW()),
            (NULL, 'amazon-us', 'Amazon US', 0, 1, NOW(), NOW());
        ");
    }
}
