<?php
use Migrations\AbstractMigration;

class MidifyCoreOrderShipments extends AbstractMigration
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
            ->addColumn('core_seller_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->addIndex(['core_seller_id'])
            ->update();
    }
}
