<?php
use Migrations\AbstractMigration;

class EbayCustomPageTypeId extends AbstractMigration
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
            if($table->hasColumn('custom_page_type') && !$table->hasColumn('custom_page_type_id')){
                $table->dropForeignKey('custom_page_type')
                      ->renameColumn('custom_page_type', 'custom_page_type_id')
                      ->addForeignKey('custom_page_type_id', 'ebay_custom_page_types', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                      ->save();
            }
        }
    }
}
