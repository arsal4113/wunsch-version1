<?php

use Phinx\Migration\AbstractMigration;

class EbayAuctionTypes extends AbstractMigration
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
        $table = $this->table('ebay_auction_types');
        $table
            ->addColumn('code', 'string', [
                'limit' => 64,
                'null' => false
            ])
            ->addColumn('name', 'string', [
                'limit' => 64,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(['code'])
            ->create();
            
        $this->execute("
            INSERT INTO `ebay_auction_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
            (NULL, 'auction', 'Auction', NOW(), NOW()),
            (NULL, 'fixed_price', 'Fixed price', NOW(), NOW()),
            (NULL, 'classified_ads', 'Classified Ads', NOW(), NOW()),
            (NULL, 'motors_national', 'Motors National', NOW(), NOW()),
            (NULL, 'motor_local_market', 'Motors Local Market', NOW(), NOW());            
        ");            
    }
}
