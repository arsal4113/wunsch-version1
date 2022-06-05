<?php
use Migrations\AbstractMigration;

class AddCheckoutSessionPaymentStatus extends AbstractMigration
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
        $this->table('ebay_checkout_sessions')
            ->addColumn('order_payment_status', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
                'after' => 'purchase_order_id'
            ])
            ->addIndex('order_payment_status')
            ->update();
    }
}
