<?php
use Migrations\AbstractMigration;

class EbayAccountUpdateForeignKey extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('ebay_accounts')
            ->dropForeignKey('core_seller_id')
            ->update();

        $this->table('ebay_accounts')
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->table('ebay_listings')
            ->dropForeignKey('ebay_account_id')
            ->update();

        $this->table('ebay_listings')
            ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();
    }
}
