<?php
use Migrations\AbstractMigration;

class CoreProductForeignKeys extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $this->table('core_products')
            ->dropForeignKey(['core_seller_id', 'core_product_type_id', 'parent_id'])->update();

        $this->table('core_products')
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('core_product_type_id', 'core_product_types', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->update();
    }
    public function dowm()
    {
        $this->table('core_products')
            ->dropForeignKey(['core_seller_id', 'core_product_type_id'])->update();

        $this->table('core_products')
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addForeignKey('core_product_type_id', 'core_product_types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addForeignKey('parent_id', 'core_products', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
