<?php
use Migrations\AbstractMigration;

class AddWishlistsFields extends AbstractMigration
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

        if (!$table->hasColumn('eek')) {
            $table->addColumn('eek', 'string', ['limit' => 100, 'default' => null, 'null' => true, 'after' => 'image']);
        }

        if (!$table->hasColumn('delivery_duration_de')) {
            $table->addColumn('delivery_duration_de', 'integer', ['limit' => 10, 'default' => null, 'null' => true, 'after' => 'image']);
        }

        if (!$table->hasColumn('delivery_cost_de')) {
            $table->addColumn('delivery_cost_de', 'decimal', ['precision' => 12, 'scale' => 4, 'default' => null, 'null' => true, 'after' => 'image']);
        }

        if (!$table->hasColumn('original_price')) {
            $table->addColumn('original_price', 'decimal', ['precision' => 12, 'scale' => 4, 'default' => null, 'null' => true, 'after' => 'price']);
        }

        if (!$table->hasColumn('quantity')) {
            $table->addColumn('quantity', 'integer', ['limit' => 10, 'default' => null, 'null' => true, 'after' => 'image']);
        }

        $table->update();
    }
}
