<?php
use Migrations\AbstractMigration;

class Ebaylistingupdateblock extends AbstractMigration
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
        $this->table('ebay_listing_update_locks')
            ->addColumn('ebay_listing_id', 'integer', ['limit' => 10])
            ->addColumn('lock_until', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex(['ebay_listing_id'])
            ->addIndex(['lock_until'])
            ->create();
    }
}
