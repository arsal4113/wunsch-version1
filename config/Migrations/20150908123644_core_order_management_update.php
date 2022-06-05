<?php
use Migrations\AbstractMigration;

class CoreOrderManagementUpdate extends AbstractMigration
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
            ->addColumn('external_customer_identifier', 'string', ['limit' => 200, 'after' => 'external_order_identifier'])
            ->update();

        $this->table('core_order_products')
            ->addColumn('external_identifier', 'string', ['limit' => 250, 'after' => 'quantity'])
            ->addColumn('tax_percent', 'decimal', ['precision' => 4, 'scale' => 2, 'after' => 'tax'])
            ->update();
    }
}
