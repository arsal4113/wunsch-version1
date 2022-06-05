<?php
use Migrations\AbstractMigration;

class EbayItemLocksUpdate extends AbstractMigration
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
            ->addColumn('core_marketplace_id', 'integer', ['limit' => 10, 'after' => 'ebay_account_id'])
            ->update();
    }
}
