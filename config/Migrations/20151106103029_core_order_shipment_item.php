<?php
use Migrations\AbstractMigration;

class CoreOrderShipmentItem extends AbstractMigration
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
        $this->table('core_order_shipment_items')
            ->addColumn('is_processed', 'boolean', ['after' => 'quantity', 'default' => 0])->update();
    }
}
