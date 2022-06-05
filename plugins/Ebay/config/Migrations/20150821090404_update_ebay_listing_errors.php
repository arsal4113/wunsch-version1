<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayListingErrors extends AbstractMigration
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
        $table = $this->table('ebay_listing_errors');
        $table
            ->addIndex(['ebay_listing_id'])
            ->addIndex(['action'])
            ->addIndex(['type'])
            ->addIndex(['code'])
            ->addForeignKey('ebay_listing_id', 'ebay_listings', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
