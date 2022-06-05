<?php
use Migrations\AbstractMigration;

class CoreOrderProductExternalSku extends AbstractMigration
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
        $this->table('core_order_products')
            ->addColumn('marketplace_product_identifier', 'string', ['limit' => 250, 'null' => true, 'after' => 'external_identifier'])
            ->save();
    }
}
