<?php
use Migrations\AbstractMigration;

class UpdateCoreOrders extends AbstractMigration
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
            ->addColumn('state_name', 'string', ['limit' => 250,'after' => 'state_code'])
            ->addColumn('status_name', 'string', ['limit' => 250,'after' => 'status_code'])
            ->update();
    }
}
