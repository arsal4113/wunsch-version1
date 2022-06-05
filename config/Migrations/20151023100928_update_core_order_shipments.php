<?php
use Migrations\AbstractMigration;

class UpdateCoreOrderShipments extends AbstractMigration
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
            ->addColumn('is_processed', 'boolean', ['after' => 'tracking_link', 'default' => 0])
            ->addColumn('processing_date', 'datetime', ['after' => 'is_processed', 'default' => null, 'limit' => null,	'null' => false])
            ->addIndex(['is_processed'])
            ->update();
    }
}
