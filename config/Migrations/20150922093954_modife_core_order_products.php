<?php
use Migrations\AbstractMigration;

class ModifeCoreOrderProducts extends AbstractMigration
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
            ->addColumn('is_price_incl_tax', 'boolean', ['after' => 'total_price'])
            ->update();
    }
}
