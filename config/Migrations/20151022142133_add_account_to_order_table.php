<?php
use Migrations\AbstractMigration;

class AddAccountToOrderTable extends AbstractMigration
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
            ->addColumn('account_code', 'string', ['limit' => 250, 'after' => 'marketplace_name', 'null' => true])
            ->addColumn('account_name', 'string', ['limit' => 250, 'after' => 'account_code', 'null' => true])
            ->addIndex(['account_code'])
            ->update();
    }
}
