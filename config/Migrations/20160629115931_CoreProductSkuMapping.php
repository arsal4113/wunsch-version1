<?php
use Migrations\AbstractMigration;

class CoreProductSkuMapping extends AbstractMigration
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
        $this->table('core_product_sku_mappings')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('sku', 'string', ['limit' => 200])
            ->addColumn('mapping_sku', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex(['core_seller_id'])
            ->addIndex(['sku'])
            ->create();
    }
}
