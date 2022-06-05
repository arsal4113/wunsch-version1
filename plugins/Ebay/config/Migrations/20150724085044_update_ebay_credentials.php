<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayCredentials extends AbstractMigration
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
        $this->execute("ALTER TABLE `ebay_credentials` ADD INDEX(`ebay_account_type_id`);");
        $this->execute("ALTER TABLE `ebay_credentials` ADD FOREIGN KEY (`ebay_account_type_id`) REFERENCES `ebay_account_types`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
    }
}
