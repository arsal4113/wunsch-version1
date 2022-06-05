<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayCategories extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_categories` ADD INDEX(`ebay_site_id`);");
        $this->execute("ALTER TABLE `ebay_categories` ADD INDEX(`ebay_category_id`);");
        $this->execute("ALTER TABLE `ebay_categories` ADD INDEX(`parent_id`);");
        
        $this->execute("ALTER TABLE `ebay_categories` ADD FOREIGN KEY (`ebay_site_id`) REFERENCES `ebay_sites`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
    }
}
