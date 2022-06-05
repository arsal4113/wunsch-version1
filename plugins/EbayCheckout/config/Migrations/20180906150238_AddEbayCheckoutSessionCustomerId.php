<?php
use Migrations\AbstractMigration;

class AddEbayCheckoutSessionCustomerId extends AbstractMigration
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
        $table = $this->table('ebay_checkout_sessions');
        $table->addColumn('customer_id', 'integer', ['default' => null, 'null' => true, 'after' => 'ebay_checkout_id']);
        $table->update();
    }
}
