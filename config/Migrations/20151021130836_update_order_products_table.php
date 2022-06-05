<?php
use Migrations\AbstractMigration;

class UpdateOrderProductsTable extends AbstractMigration
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
        $this->table('core_order_products')
            ->removeColumn('sku')
            ->addColumn('sku', 'string', ['limit' => 250, 'after' => 'core_product_id', 'null' => true])
            ->removeColumn('external_identifier')
            ->addColumn('external_identifier', 'string', ['limit' => 250, 'after' => 'quantity', 'null' => true])
            ->update();
    }
}
