<?php

use Phinx\Migration\AbstractMigration;

class StandardAttributeGroups extends AbstractMigration
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
        $this->execute("DELETE FROM `core_product_eav_attribute_groups`");
        $this->execute("ALTER TABLE `core_product_eav_attribute_groups` auto_increment = 1;");
        $this->execute("
            INSERT INTO `core_product_eav_attribute_groups` (`id`, `code`, `name`, `sort_order`, `created`, `modified`) VALUES
            (NULL, 'general', 'General', 1, NOW(), NOW()),
            (NULL, 'prices', 'Prices', 2, NOW(), NOW()),
            (NULL, 'pictures', 'Pictures', 3, NOW(), NOW()),
            (NULL, 'ebay', 'eBay', 4, NOW(), NOW()),
            (NULL, 'ebay_attributes', 'eBay Attributes', 5, NOW(), NOW()),
            (NULL, 'amazon', 'Amazon', 6, NOW(), NOW());            
        ");
    }
}
