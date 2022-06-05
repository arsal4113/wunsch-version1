<?php

use Phinx\Migration\AbstractMigration;

class StandardEbaySites extends AbstractMigration
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
        $this->dropTable('ebay_site_names');
        
        $this->execute("ALTER TABLE `ebay_sites` ADD INDEX(`ebay_site_id`);");
        $this->execute("ALTER TABLE `ebay_sites` ADD INDEX(`ebay_global_id`);");
        $this->execute("ALTER TABLE `ebay_sites` ADD INDEX(`is_active`);");
    }
}
