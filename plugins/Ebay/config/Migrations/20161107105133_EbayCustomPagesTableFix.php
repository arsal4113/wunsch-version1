<?php
use Migrations\AbstractMigration;

class EbayCustomPagesTableFix extends AbstractMigration
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
            if($table->hasColumn('shipping_and_price')){
                $table->renameColumn('shipping_and_price', 'shipping');
            }
        }
    }
}