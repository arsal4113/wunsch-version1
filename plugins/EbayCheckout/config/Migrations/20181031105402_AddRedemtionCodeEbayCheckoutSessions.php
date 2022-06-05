<?php
use Migrations\AbstractMigration;

class AddRedemtionCodeEbayCheckoutSessions extends AbstractMigration
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
        if (!$table->hasColumn('redemption_code')) {
            $table->addColumn('redemption_code', 'string',
                ['default' => null, 'null' => true, 'after' => 'type', 'limit' => 220])->update();
        }
    }
}
