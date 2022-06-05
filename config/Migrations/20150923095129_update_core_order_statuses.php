<?php
use Migrations\AbstractMigration;

class UpdateCoreOrderStatuses extends AbstractMigration
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
        $this->table('core_order_statuses')
            ->addColumn('core_order_state_id', 'integer', ['limit' => 10,'after' => 'id'])
            ->update();
    }
}
