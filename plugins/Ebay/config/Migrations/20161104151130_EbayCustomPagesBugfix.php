<?php
use Migrations\AbstractMigration;

class EbayCustomPagesBugfix extends AbstractMigration
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
        if($this->hasTable('ebay_custom_pages')){
            $table = $this->table('ebay_custom_pages');
            if($table->hasColumn('shippung_and_price')){
                $table->renameColumn('shippung_and_price', 'shipping_and_price');
            }
        }
    }
}
