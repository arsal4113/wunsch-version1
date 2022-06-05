<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class NewStatus extends AbstractMigration
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
        $coreOrderStatesTable = TableRegistry::get('CoreOrderStates');
        $coreOrderStatusesTable = TableRegistry::get('CoreOrderStatuses');

        $state = $coreOrderStatesTable->find()
            ->where(['code' => 'canceled'])
            ->first();
        if(!empty($state)) {
            $status = $coreOrderStatusesTable->find()
                ->where([
                    'code' => 'canceled',
                    'core_order_state_id' => $state->id
                ])
                ->first();
            if (empty($status)) {
                $newStatus = $coreOrderStatusesTable->newEntity();
                $newStatus->core_order_state_id = $state->id;
                $newStatus->code = 'canceled';
                $newStatus->name = 'Storniert';
                $coreOrderStatusesTable->save($newStatus);
            }
        }
    }
}
