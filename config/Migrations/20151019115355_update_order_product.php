<?php
use Migrations\AbstractMigration;

class UpdateOrderProduct extends AbstractMigration
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
        $this->table('core_order_products')
            ->addColumn('external_fee_amount', 'decimal', ['precision' => 14, 'scale' => 4, 'after' => 'external_identifier', 'null' => true, 'default' => null])
        ->update();
    }
}
