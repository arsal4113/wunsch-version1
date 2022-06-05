<?php
use Migrations\AbstractMigration;

class UpdateCoreOrderStatusHistory extends AbstractMigration
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
        $this->table('core_order_status_histories')
            ->addColumn('state_name', 'string', ['limit' => 250,'after' => 'state_code'])
            ->addColumn('status_name', 'string', ['limit' => 250,'after' => 'status_code'])
            ->removeColumn('comment')
            ->update();

        $this->table('core_order_status_histories')
            ->addColumn('comment', 'string', ['limit' => 500, 'null' => true, 'after' => 'status_name'])
            ->update();

    }
}
