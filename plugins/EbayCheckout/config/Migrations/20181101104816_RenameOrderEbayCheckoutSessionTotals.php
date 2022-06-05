<?php
use Migrations\AbstractMigration;

class RenameOrderEbayCheckoutSessionTotals extends AbstractMigration
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
        $table = $this->table('ebay_checkout_session_totals');
        if ($table->hasColumn('order')) {
            $table->renameColumn('order', 'sort_order')->update();
        }
    }
}
