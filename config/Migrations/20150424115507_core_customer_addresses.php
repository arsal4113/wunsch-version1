<?php

use Phinx\Migration\AbstractMigration;

class CoreCustomerAddresses extends AbstractMigration
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
        $this->table('core_customer_addresses')->removeColumn('email')->update();
    }

}