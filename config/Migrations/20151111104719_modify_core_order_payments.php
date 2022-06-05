<?php
use Migrations\AbstractMigration;

class ModifyCoreOrderPayments extends AbstractMigration
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
        $this->table('core_order_payments')
            ->changeColumn('comment', 'string', ['limit' => 250, 'null' => true])
            ->update();
    }
}
