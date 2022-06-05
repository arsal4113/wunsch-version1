<?php
use Migrations\AbstractMigration;

class EbayCustomPageTypes extends AbstractMigration
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
        if(!$this->hasTable('ebay_custom_page_types')){
            $table = $this->table('ebay_custom_page_types');
            $table->addColumn('name', 'string', ['default' => null, 'null' => true, 'limit' => 255])
                  ->addColumn('order', 'integer', ['default' => null, 'null' => true, 'limit' => 255])
                  ->addColumn('left_navbar', 'boolean', ['default' => null, 'null' => true])
                  ->addColumn('page_id', 'biginteger', ['default' => null, 'null' => true])
                  ->addColumn('preview_enabled', 'boolean', ['default' => null, 'null' => true])
                  ->addColumn('status', 'enum', ['values' => ['active', 'inactive', 'delete', 'custom_code']])
                  ->addColumn('url_path', 'string', ['default' => null, 'null' => true, 'limit' => 255])
                  ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                  ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                  ->save();
        }
    }
}