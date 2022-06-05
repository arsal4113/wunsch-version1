<?php
use Migrations\AbstractMigration;

class EbayCustomPagesConnectToPageTypes extends AbstractMigration
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
            if($table->hasColumn('custom_page_type')){
                $table->addIndex(['custom_page_type'])
                      ->addForeignKey('custom_page_type', 'ebay_custom_page_types', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
                      ->save();
            }                        
        }
    }
}
