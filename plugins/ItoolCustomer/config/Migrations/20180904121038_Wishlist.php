<?php
use Migrations\AbstractMigration;

class Wishlist extends AbstractMigration
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
        if (!$table->exists()) {
            $table
                ->addColumn('customer_id', 'integer', ['limit' => 10])
                ->addColumn('name', 'string', ['limit' => 500])
                ->addColumn('image', 'string', ['limit' => 500])
                ->addColumn('seller', 'string', ['limit' => 500])
                ->addColumn('ebay_item_id', 'string', ['limit' => 500])
                ->addColumn('price', 'decimal', ['precision' => 12, 'scale' => 4])
                ->addColumn('currency', 'string', ['limit' => 200])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'CASCADE'])
                ->create();
        }
    }
}
