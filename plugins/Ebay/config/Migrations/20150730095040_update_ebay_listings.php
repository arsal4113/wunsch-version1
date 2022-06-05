<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayListings extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_listings` CHANGE `ebay_lister_type_id` `ebay_lister_type_id` INT(11) NOT NULL AFTER `id`;");
        $this->execute("ALTER TABLE `ebay_listings` CHANGE `core_seller_id` `core_seller_id` INT(10) NOT NULL AFTER `ebay_site_id`;");
        $this->execute("ALTER TABLE `ebay_listings` ADD `core_marketplace_id` INT(11) NOT NULL AFTER `core_seller_id`;");
        $this->execute("ALTER TABLE `ebay_listings` CHANGE `auction_type` `ebay_auction_type_id` INT(11) NOT NULL AFTER `ebay_site_id`;");
        
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ebay_lister_type_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ebay_account_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ebay_site_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ebay_auction_type_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ebay_category_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`core_seller_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`core_marketplace_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`core_language_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`core_product_id`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`scheduled`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`active`);");
        $this->execute("ALTER TABLE `ebay_listings` ADD INDEX(`ended`);");
        
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`ebay_lister_type_id`) REFERENCES `ebay_lister_types`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`ebay_account_id`) REFERENCES `ebay_accounts`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`ebay_site_id`) REFERENCES `ebay_sites`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`ebay_auction_type_id`) REFERENCES `ebay_auction_types`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`ebay_category_id`) REFERENCES `ebay_categories`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`core_seller_id`) REFERENCES `core_sellers`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`core_marketplace_id`) REFERENCES `core_marketplaces`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`core_language_id`) REFERENCES `core_languages`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_listings` ADD FOREIGN KEY (`core_product_id`) REFERENCES `core_products`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");        
    }
}
