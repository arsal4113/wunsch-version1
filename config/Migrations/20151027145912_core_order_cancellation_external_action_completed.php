<?php
use Migrations\AbstractMigration;

class CoreOrderCancellationExternalActionCompleted extends AbstractMigration
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
        $this->table('core_order_cancellations')
            ->addColumn('external_action_completed', 'boolean', ['after' => 'comment', 'default' => 0])
            ->update();
    }
}
