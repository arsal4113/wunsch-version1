<?php
use Phinx\Migration\AbstractMigration;

class EbayAttributeMapping extends AbstractMigration
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
        $table = $this->table('ebay_attribute_mappings');
        $table
            ->addColumn('core_seller_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_category_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_category_specific_id', 'integer', [
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(['core_seller_id'])
            ->addIndex(['ebay_site_id'])
            ->addIndex(['ebay_category_id'])
            ->addIndex(['ebay_category_specific_id'])
            ->addIndex(['core_product_eav_attribute_id'])
            ->create();
    }
}
