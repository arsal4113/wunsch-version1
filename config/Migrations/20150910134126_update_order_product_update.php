<?php
use Migrations\AbstractMigration;

class UpdateOrderProductUpdate extends AbstractMigration
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
            ->renameColumn('price_excl_tax', 'single_price')
            ->removeColumn('tax')
            ->update();

        $this->table('core_order_products')
            ->addColumn('total_price', 'decimal', ['precision' => 14, 'scale' => 4, 'after' => 'single_price'])
            ->update();
    }
}
