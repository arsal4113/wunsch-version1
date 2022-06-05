<?php

use Phinx\Migration\AbstractMigration;

class EbayLaunchProfileIndexes extends AbstractMigration
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
        $table = $this->table('ebay_launch_profiles');
        $table
            ->addIndex(['ebay_lister_type_id'])
            ->addForeignKey('ebay_lister_type_id', 'ebay_lister_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_account_id'])
            ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_site_id'])
            ->addForeignKey('ebay_site_id', 'ebay_sites', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['ebay_auction_type_id'])
            ->addForeignKey('ebay_auction_type_id', 'ebay_auction_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['core_seller_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addIndex(['core_language_id'])
            ->addForeignKey('core_language_id', 'core_languages', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])            
            ->update();
    }
}
