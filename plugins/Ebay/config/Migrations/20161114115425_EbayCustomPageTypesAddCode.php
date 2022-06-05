<?php
use Migrations\AbstractMigration;

class EbayCustomPageTypesAddCode extends AbstractMigration
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
        $table = $this->table('ebay_custom_page_types');
        if($table){
            if(!$table->hasColumn('code')){
                $table->addColumn('code', 'string', ['default' => null, 'null' => true, 'limit' => 255, 'after' => 'id'])
                      ->save();
            }
        }
    }
}
