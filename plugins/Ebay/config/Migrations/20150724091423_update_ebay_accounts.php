<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayAccounts extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_accounts` ADD INDEX(`ebay_account_type_id`);");
        $this->execute("ALTER TABLE `ebay_accounts` ADD INDEX(`ebay_credential_id`);");
        $this->execute("ALTER TABLE `ebay_accounts` ADD INDEX(`core_seller_id`);");
        $this->execute("ALTER TABLE `ebay_accounts` ADD INDEX(`is_active`);");
        
        $this->execute("ALTER TABLE `ebay_accounts` ADD FOREIGN KEY (`ebay_account_type_id`) REFERENCES `ebay_account_types`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_accounts` ADD FOREIGN KEY (`ebay_credential_id`) REFERENCES `ebay_credentials`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_accounts` ADD FOREIGN KEY (`core_seller_id`) REFERENCES `core_sellers`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        
        $this->execute("ALTER TABLE `ebay_accounts_ebay_sites` ADD INDEX(`ebay_account_id`);");
        $this->execute("ALTER TABLE `ebay_accounts_ebay_sites` ADD INDEX(`ebay_site_id`);");
        
        $this->execute("ALTER TABLE `ebay_accounts_ebay_sites` ADD FOREIGN KEY (`ebay_account_id`) REFERENCES `ebay_accounts`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `ebay_accounts_ebay_sites` ADD FOREIGN KEY (`ebay_site_id`) REFERENCES `ebay_sites`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
    }
}
