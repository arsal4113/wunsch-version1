<?php
use Migrations\AbstractMigration;

class UpdateEbayOrderShipments extends AbstractMigration
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
        $this->table('ebay_order_shipments')
            ->removeIndex(['core_order_shipment_item_id'])
            ->addColumn('core_order_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->renameColumn('core_order_shipment_item_id', 'core_order_shipment_id')
            ->addIndex(['core_order_id'])
            ->addIndex(['core_order_shipment_id'])
            ->update();

        $this->table('ebay_order_shipment_items')
            ->addColumn('ebay_order_shipment_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_shipment_item_id', 'integer', ['limit' => 10])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['ebay_order_shipment_id'])
            ->addIndex(['core_order_shipment_item_id'])
            ->create();
    }
}
