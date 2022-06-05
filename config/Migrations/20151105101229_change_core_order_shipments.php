<?php
use Migrations\AbstractMigration;

class ChangeCoreOrderShipments extends AbstractMigration
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
        $this->table('core_order_shipments')
            ->removeColumn('core_order_id')
            ->removeColumn('core_order_product_id')
            ->removeColumn('quantity')
            ->removeIndex(['core_order_id'])
            ->update();

        $this->table('core_orders_core_order_shipments')
            ->addColumn('core_order_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_shipment_id', 'integer', ['limit' => 10])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_order_id'])
            ->addIndex('core_order_shipment_id')
            ->create();

        $this->table('core_order_products_core_order_shipments')
            ->addColumn('core_order_product_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_shipment_id', 'integer', ['limit' => 10])
            ->addColumn('quantity', 'decimal', ['precision' => 14, 'scale' => 4])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_order_product_id'])
            ->addIndex(['core_order_shipment_id'])
            ->create();
    }
}