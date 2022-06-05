<?php
use Migrations\AbstractMigration;

class CoreOrderCancellationAdjustmentAmount extends AbstractMigration
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
            ->addColumn('adjustment_amount', 'decimal', ['after' => 'quantity', 'default' => 0, 'precision' => 14, 'scale' => 4])
            ->changeColumn('quantity', 'integer', ['limit' => 10])
            ->update();
    }
}
