<?php
use Migrations\AbstractMigration;

class UpdateOrderChargesDiscounts extends AbstractMigration
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
            ->addColumn('is_amount_incl_tax', 'boolean', ['after' => 'amount'])
            ->update();

        $this->table('core_order_discounts')
            ->addColumn('is_amount_incl_tax', 'boolean', ['after' => 'amount'])
            ->update();
    }
}
