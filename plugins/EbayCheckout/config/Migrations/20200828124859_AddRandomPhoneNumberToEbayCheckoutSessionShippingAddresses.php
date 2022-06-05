<?php
use Migrations\AbstractMigration;

class AddRandomPhoneNumberToEbayCheckoutSessionShippingAddresses extends AbstractMigration
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
        $table = $this->table('ebay_checkout_session_shipping_addresses');
        $table->addColumn('random_phone_number', 'boolean', ['default' => false, 'after' => 'phone_number']);
        $table->update();
    }
}
