<?php

use Phinx\Migration\AbstractMigration;

class DropEbayListingsCoreMarketPlaceId extends AbstractMigration
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
        $table = $this->table('ebay_listings');
        $table
            ->dropForeignKey('core_marketplace_id')
            ->removeIndex(array('core_marketplace_id'))
            ->removeColumn('core_marketplace_id');
    }
}
