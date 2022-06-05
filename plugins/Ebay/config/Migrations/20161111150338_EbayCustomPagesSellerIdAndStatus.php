<?php
use Migrations\AbstractMigration;

class EbayCustomPagesSellerIdAndStatus extends AbstractMigration
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
            if(!$table->hasColumn('core_seller_id')){
                $table->addColumn('core_seller_id', 'integer', ['default' => null, 'null' => true, 'limit' => 11, 'after' => 'ebay_account_id'])
                      ->addIndex(['core_seller_id'])
                      ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
            }
            if(!$table->hasColumn('status')){
                $table->addColumn('status', 'enum', ['values' => ['active', 'inactive', 'delete'], 'after' => 'content']);
            }
            $table->save();
        }
    }
}
