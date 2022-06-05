<?php

use Phinx\Migration\AbstractMigration;

class CoreCustomers extends AbstractMigration
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
        $this->table('core_customers')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('firstname', 'string', ['limit' => 250])
            ->addColumn('lastname', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('default_shipping_address_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('default_billing_address_id', 'integer', ['limit' => 10, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id', 'email'])
            ->create();

        $this->table('core_customer_addresses')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('core_customer_id', 'integer', ['limit' => 10])
            ->addColumn('firstname', 'string', ['limit' => 250])
            ->addColumn('lastname', 'string', ['limit' => 250])
            ->addColumn('company', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('phone', 'string', ['limit' => 250])
            ->addColumn('street_1', 'string', ['limit' => 250])
            ->addColumn('street_2', 'string', ['limit' => 250])
            ->addColumn('postcode', 'string', ['limit' => 250])
            ->addColumn('city', 'string', ['limit' => 250])
            ->addColumn('country_code', 'string', ['limit' => 250])
            ->addColumn('country_name', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id', 'core_customer_id'])
            ->create();

        $this->table('core_orders')
            ->addColumn('core_customer_id', 'integer', ['limit' => 10])
            ->update();
    }
}