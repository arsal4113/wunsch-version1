<?php

use Migrations\AbstractMigration;

class AlterEbayCheckoutSessionItemShippings extends AbstractMigration
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
        $table = $this->table('ebay_checkout_session_item_shippings');
        $table->addColumn('additional_unit_cost_value', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 12,
            'scale' => 4,
            'after' => 'base_delivery_cost_value'
        ]);
        $table->addColumn('additional_unit_cost_currency', 'string', [
            'default' => null,
            'limit' => 45,
            'null' => true,
            'after' => 'additional_unit_cost_value'
        ]);
        $table->update();
    }
}
