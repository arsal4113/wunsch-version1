<?php

use Migrations\AbstractMigration;

class AddWishlistitemsCategoryId extends AbstractMigration
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
                ->addColumn('category_id', 'integer', ['default' => null, 'null' => true, 'after' => 'price'])
                ->update();
        }
    }
}
