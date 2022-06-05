<?php
use Migrations\AbstractMigration;

class AddFlagOnlyWithSalesPrices extends AbstractMigration
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
        $table = $this->table('feeder_categories');
        if(!$table->hasColumn('only_with_sales_prices')) {
            $table->addColumn('only_with_sales_prices', 'boolean', ['default' => false, 'after' => 'price_to'])
                ->update();
        }
    }
}
