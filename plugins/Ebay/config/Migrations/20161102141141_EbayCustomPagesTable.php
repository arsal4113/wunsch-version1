<?php
use Migrations\AbstractMigration;

class EbayCustomPagesTable extends AbstractMigration
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
        if(!$this->hasTable('ebay_custom_pages')){
            $this->table('ebay_custom_pages')
                 ->addColumn('ebay_account_id', 'integer')
                 ->addColumn('payment', 'string')
                 ->addColumn('shipping_and_price', 'string')
                 ->addColumn('terms_and_conditions', 'string')
                 ->addColumn('contacts', 'string')
                 ->addColumn('created', 'datetime')
                 ->addColumn('modified', 'datetime')
                 ->addIndex(['ebay_account_id'])
                 ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
                 ->save();
        }
    }
}
