<?php
use Phinx\Migration\AbstractMigration;

class CoreShippingMethods extends AbstractMigration
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
        $this->table('core_shipping_methods')
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('core_carrier_id', 'integer', ['limit' => 10])
            ->addColumn('is_active', 'boolean', ['default' => 1])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['code'])
            ->addIndex(['core_carrier_id'])
        ->create();

        $this->table('core_carriers')
            ->renameColumn('carrier_code', 'code')
            ->renameColumn('carrier_link', 'tracking_link')
            ->addColumn('name', 'string', ['limit' => 250, 'after' => 'id'])
            ->addIndex(['code'])
        ->update();

        $this->dropTable('core_carrier_names');

        $this->table('translation_core_carriers')
            ->addColumn('locale', 'string', ['limit' => 6])
            ->addColumn('model', 'string', ['limit' => 255])
            ->addColumn('foreign_key', 'integer', ['limit' => 10])
            ->addColumn('field', 'string', ['limit' => 255])
            ->addColumn('content', 'text')
            ->addIndex(['foreign_key'])
            ->addIndex(['locale'])
        ->create();

        $this->table('translation_core_shipping_methods')
            ->addColumn('locale', 'string', ['limit' => 6])
            ->addColumn('model', 'string', ['limit' => 255])
            ->addColumn('foreign_key', 'integer', ['limit' => 10])
            ->addColumn('field', 'string', ['limit' => 255])
            ->addColumn('content', 'text')
            ->addIndex(['foreign_key'])
            ->addIndex(['locale'])
        ->create();
    }
}

