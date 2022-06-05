<?php
use Migrations\AbstractMigration;

class CoreOrderInvoices extends AbstractMigration
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
        $this->table('core_order_invoice_ranges')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('core_marketplace_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('invoice_incremental_value', 'integer', ['limit' => 10])
            ->addColumn('invoice_prefix', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('invoice_suffix', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('created', 'datetime', ['null' => false])
            ->addColumn('modified', 'datetime', ['null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['core_marketplace_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->save();

        $this->table('core_order_invoices')
            ->addColumn('core_order_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_invoice_range_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('invoice_number', 'string', ['limit' => 200])
            ->addColumn('invoice_date', 'datetime', ['null' => false])
            ->addColumn('created', 'datetime', ['null' => false])
            ->addColumn('modified', 'datetime', ['null' => false])
            ->addIndex(['core_order_id'])
            ->addForeignKey('core_order_id', 'core_orders', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('core_order_invoice_range_id', 'core_order_invoice_ranges', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->save();
    }
}
