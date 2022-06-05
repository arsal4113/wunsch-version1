<?php

use Migrations\AbstractMigration;

class EbayCheckoutSessionItemsSync extends AbstractMigration
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
        if ($table->hasColumn('ebay_category_path')) {
            $table->changeColumn('ebay_category_path', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
                'after' => 'ebay_item_id'
            ])
                ->update();
        }
    }
}
