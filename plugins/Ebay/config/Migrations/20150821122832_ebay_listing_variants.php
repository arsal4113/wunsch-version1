<?php

use Phinx\Migration\AbstractMigration;

class EbayListingVariants extends AbstractMigration
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
        $table = $this->table('ebay_listing_variants');
        $table
            ->addColumn('ebay_listing_id', 'integer', array(
                'limit' => 11,
                'null' => false
            ))
            ->addColumn('sku', 'string', array(
                'limit' => 128,
                'null' => false
            ))
            ->addColumn('quantity', 'integer', array(
                'limit' => 11,
                'default' => 0,
                'null' => false
            ))
            ->addColumn('created', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addColumn('modified', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addIndex(['ebay_listing_id'])
            ->addIndex(['sku'])
            ->addForeignKey('ebay_listing_id', 'ebay_listings', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
