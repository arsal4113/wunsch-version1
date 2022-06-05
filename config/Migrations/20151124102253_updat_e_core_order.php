<?php
use Migrations\AbstractMigration;

class UpdatECoreOrder extends AbstractMigration
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
        $this->table('core_orders')
            ->addColumn('marketplace_group_code', 'string', ['limit' => 100, 'after' => 'purchase_date'])
            ->addColumn('marketplace_group_name', 'string', ['limit' => 250, 'after' => 'marketplace_group_code'])
            ->addIndex(['marketplace_group_code'])
            ->addIndex(['marketplace_code'])
            ->update();
    }
}
