<?php

use Migrations\AbstractMigration;

class UpdateCustomerAddressTable extends AbstractMigration
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
        $this->table('customer_addresses')
            ->changeColumn('street_line_2', 'string', [
                'limit' => 250,
                'after' => 'street_line_1',
                'default' => null,
                'null' => true
            ])
            ->update();
    }
}
