<?php

use Migrations\AbstractMigration;

class AddPaymentInitiatedEbayCheckoutSession extends AbstractMigration
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

        $table->addColumn('payment_initiated', 'boolean', ['default' => 0, 'after' => 'ebay_global_id']);
        $table->update();


        $this->table('ebay_checkout_session_payments')->renameColumn('payment_method_tyoe',
            'payment_method_type')->update();
    }
}
