<?php
use Migrations\AbstractMigration;

class UpdateEbayListingUpdateLock extends AbstractMigration
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
            ->addColumn('comment', 'string', ['limit' => 512, 'null' => true, 'after' => 'lock_until'])
            ->save();
    }
}
