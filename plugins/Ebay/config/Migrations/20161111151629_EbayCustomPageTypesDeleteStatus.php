<?php
use Migrations\AbstractMigration;

class EbayCustomPageTypesDeleteStatus extends AbstractMigration
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
            $table->removeColumn('status')
                  ->save();
        }
    }
}
