<?php
use Migrations\AbstractMigration;

class EbayCustomPageTypesPageIdToEbayCustomPages extends AbstractMigration
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
        $customPages = $this->table('ebay_custom_pages');
        $customPageTypes = $this->table('ebay_custom_page_types');
        if($customPages && $customPageTypes){
            if(!$customPages->hasColumn('page_id')){
                $customPages->addColumn('page_id', 'integer', ['default' => null, 'null' => true, 'limit' => 10, 'after' => 'core_seller_id'])
                            ->addIndex(['page_id'])
                            ->update();
            }
            if($customPageTypes->hasColumn('page_id')){
                $customPageTypes->removeColumn('page_id')
                                ->save();
            }
        }
    }
}
