<?php
use Migrations\AbstractMigration;

class DropBrokenForeignKey extends AbstractMigration
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
        $table = $this->table('ebay_checkout_session_items');
        if ($table->hasForeignKey('selected_ebay_checkout_session_item_shipping_id')) {
            $table->dropForeignKey('selected_ebay_checkout_session_item_shipping_id');
            $table->save();
        }

    }
}
