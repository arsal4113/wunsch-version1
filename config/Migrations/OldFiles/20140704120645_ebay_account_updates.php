<?php

use Phinx\Migration\AbstractMigration;

class EbayAccountUpdates extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    public function change() {
    	if($this->hasTable('ebay_accounts')) {
    		$this->execute("ALTER TABLE `ebay_sites` ADD `ebay_global_id` VARCHAR(20) NOT NULL AFTER `ebay_site_id`;");
    	}    	
    }
}