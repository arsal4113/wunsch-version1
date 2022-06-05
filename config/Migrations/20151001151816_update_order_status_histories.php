<?php
use Migrations\AbstractMigration;

class UpdateOrderStatusHistories extends AbstractMigration
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
            ->addColumn('email_notification_completed', 'boolean', ['after' => 'comment', 'default' => 0])
            ->addColumn('external_action_completed', 'boolean', ['after' => 'email_notification_completed', 'default' => 0])
        ->update();
    }
}
