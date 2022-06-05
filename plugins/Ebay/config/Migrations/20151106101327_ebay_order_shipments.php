<?php
use Migrations\AbstractMigration;

class EbayOrderShipments extends AbstractMigration
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
            ->addColumn('core_order_shipment_item_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_identifier', 'string', ['limit' => 100])
            ->addColumn('message', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_order_shipment_item_id'])
            ->create();
    }
}
