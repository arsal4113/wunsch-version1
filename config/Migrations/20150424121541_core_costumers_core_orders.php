<?php

use Phinx\Migration\AbstractMigration;

class CoreCostumersCoreOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     */
    public function change()
    {
    	$this->table('core_orders')->removeColumn('core_customer_id');
        $this->table('core_orders')->addColumn('core_customer_id', 'integer', ['limit' => 10, 'after' => 'core_seller_id'])->update();
    }
}