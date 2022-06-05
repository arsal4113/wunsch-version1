<?php
use Migrations\AbstractMigration;

class CoreOrderChargesDiscounts extends AbstractMigration
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
        $this->table('core_order_charges')
            ->addColumn('core_order_id', 'integer')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('amount', 'decimal', ['precision' => 14, 'scale' => 4])
            ->addColumn('tax_percent', 'decimal', ['precision' => 4, 'scale' => 2])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_order_id'])
            ->create();

        $this->table('core_order_discounts')
            ->addColumn('core_order_id', 'integer')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('amount', 'decimal', ['precision' => 14, 'scale' => 4])
            ->addColumn('tax_percent', 'decimal', ['precision' => 4, 'scale' => 2])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_order_id'])
            ->create();
    }
}
