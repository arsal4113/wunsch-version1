<?php
use Migrations\AbstractMigration;

class EbayCustomPagesNew extends AbstractMigration
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
        $table = $this->table('ebay_custom_pages');
        if($table){
            if($table->hasColumn('payment') && !$table->hasColumn('content')){
                $table->renameColumn('payment', 'content');
            }
            if($table->hasColumn('shipping')){
                $table->removeColumn('shipping');
            }
            if($table->hasColumn('terms_and_conditions')){
                $table->removeColumn('terms_and_conditions');
            }
            if($table->hasColumn('contacts')){
                $table->removeColumn('contacts');
            }
            if(!$table->hasColumn('custom_page_type')){
                $table->addColumn('custom_page_type', 'integer', ['limit' => 11, 'default' => null, 'null' => true, 'after' => 'content']);
            }
            $table->save();
        }
    }
}
