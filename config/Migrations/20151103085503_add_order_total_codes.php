<?php
use Migrations\AbstractMigration;

class AddOrderTotalCodes extends AbstractMigration
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
        $this->table('core_order_total_codes')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('core_order_total_type_id', 'integer', ['limit' => 10])
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('sort_order', 'integer', ['limit' => 10])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->create();

        $this->table('core_order_total_types')
            ->removeColumn('sort_order')
            ->update();

    }
}
