<?php
use Migrations\AbstractMigration;

class CustomPagesTableFix extends AbstractMigration
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
            if($table->hasColumn('payment')){
                $table->changeColumn('payment', 'text');
            }
            if($table->hasColumn('shipping')){
                $table->changeColumn('shipping', 'text');
            }
            if($table->hasColumn('terms_and_conditions')){
                $table->changeColumn('terms_and_conditions', 'text');
            }
            if($table->hasColumn('contacts')){
                $table->changeColumn('contacts', 'text');
            }
            $table->save();
        }
    }
}
