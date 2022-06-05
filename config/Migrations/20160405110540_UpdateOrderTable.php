<?php
use Migrations\AbstractMigration;

class UpdateOrderTable extends AbstractMigration
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
            ->addColumn('seller_order_identifier', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'external_customer_identifier'])
            ->addColumn('custom_field_1', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'seller_order_identifier'])
            ->addColumn('custom_field_2', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'custom_field_1'])
            ->addColumn('custom_field_3', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'custom_field_2'])
            ->addColumn('custom_field_4', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'custom_field_3'])
            ->addColumn('custom_field_5', 'string', ['null' => true, 'default' => null, 'limit' => 250, 'after' => 'custom_field_4'])
            ->save();
    }
}
