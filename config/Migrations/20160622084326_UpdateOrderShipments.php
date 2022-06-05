<?php
use Migrations\AbstractMigration;

class UpdateOrderShipments extends AbstractMigration
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
            ->changeColumn('tracking_code', 'string', ['limit' => 250, 'null' => true])
            ->changeColumn('tracking_link', 'string', ['limit' => 250, 'null' => true])
            ->changeColumn('shipping_label', 'text', ['null' => true])
            ->save();
    }
}
