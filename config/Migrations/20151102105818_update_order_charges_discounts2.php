<?php
use Migrations\AbstractMigration;

class UpdateOrderChargesDiscounts2 extends AbstractMigration
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
        $this->table('core_order_charges')
            ->addColumn('sort_order', 'integer', ['after' => 'tax_percent', 'limit' => 10])
            ->update();

        $this->table('core_order_discounts')
            ->addColumn('sort_order', 'integer', ['after' => 'tax_percent', 'limit' => 10])
            ->update();
    }
}
