<?php
use Migrations\AbstractMigration;

class AddWishlistitemsSoftDelete extends AbstractMigration
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
        $table = $this->table('customer_wishlist_items');
        if ($table->exists()) {
            $table
                ->addColumn('is_deleted', 'boolean', ['default' => false])
                ->update();
        }
    }
}
