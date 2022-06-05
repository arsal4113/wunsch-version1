<?php
use Migrations\AbstractMigration;

class Init extends AbstractMigration
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
        $table = $this->table('customers');
        if (!$table->exists()) {
            $table
                ->addColumn('core_language_id', 'integer', ['limit' => 10])
                ->addColumn('first_name', 'string', ['limit' => 200])
                ->addColumn('last_name', 'string', ['limit' => 200])
                ->addColumn('email', 'string', ['limit' => 200])
                ->addColumn('password', 'string', ['limit' => 200])
                ->addColumn('is_active', 'boolean', ['default' => false])
                ->addColumn('is_deleted', 'boolean', ['default' => false])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->addForeignKey('core_language_id', 'core_languages', 'id')
                ->addIndex(['email'])
                ->addIndex(['is_active'])
                ->addIndex(['is_deleted'])
                ->create();
        }
        $table = $this->table('customer_address_types');
        if (!$table->exists()) {
            $table
                ->addColumn('code', 'string', ['limit' => 200])
                ->addColumn('name', 'string', ['limit' => 200])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->create();
            $data = [
                [
                    'code' => 'invoice',
                    'name' => 'Invoice Address',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'code' => 'shipping',
                    'name' => 'Shipping Address',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];
            $this->insert('customer_address_types', $data);
        }
        $table = $this->table('customer_addresses');
        if (!$table->exists()) {
            $table
                ->addColumn('customer_id', 'integer', ['limit' => 10])
                ->addColumn('core_country_id', 'integer', ['limit' => 10])
                ->addColumn('first_name', 'string', ['limit' => 250])
                ->addColumn('last_name', 'string', ['limit' => 250])
                ->addColumn('street_line_1', 'string', ['limit' => 250])
                ->addColumn('street_line_2', 'string', ['limit' => 250])
                ->addColumn('city', 'string', ['limit' => 200])
                ->addColumn('postal_code', 'string', ['limit' => 50])
                ->addColumn('phone_number', 'string', ['limit' => 50, 'null' => true, 'default' => null])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'CASCADE'])
                ->addForeignKey('core_country_id', 'core_countries', 'id')
                ->create();
        }
        $table = $this->table('customer_addresses_customer_address_types');
        if (!$table->exists()) {
            $table
                ->addColumn('customer_address_id', 'integer', ['limit' => 10])
                ->addColumn('customer_address_type_id', 'integer', ['limit' => 10])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->create();
        }
    }
}
