<?php
use Migrations\AbstractMigration;

class UpdateOrderOrderProducts extends AbstractMigration
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
        $this->table('core_orders')
            ->removeColumn('core_marketplace_code')
            ->removeColumn('core_marketplace_name')
            ->addColumn('marketplace_code', 'string', ['limit' => 100, 'after' => 'purchase_date'])
            ->addColumn('marketplace_name', 'string', ['limit' => 250, 'after' => 'marketplace_code'])
            ->update();

        $this->table('core_order_products')
            ->removeColumn('total_price')
            ->update();

    }
}
