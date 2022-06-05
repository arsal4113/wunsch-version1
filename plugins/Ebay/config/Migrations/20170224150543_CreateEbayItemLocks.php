<?php
use Migrations\AbstractMigration;

class CreateEbayItemLocks extends AbstractMigration
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
        $this->table('ebay_item_locks')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_item', 'string', ['limit' => 20])
            ->addColumn('ebay_account_id', 'integer', ['limit' => 10])
            ->addColumn('lock_until', 'datetime')
            ->addIndex(['core_seller_id'])
            ->addIndex(['ebay_item'])
            ->addIndex(['ebay_account_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
            ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
            ->create();
    }
}
