<?php
use Migrations\AbstractMigration;

class AddExcludeCustomers extends AbstractMigration
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
        $this->table('exclude_customers')
            ->addColumn('email', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('is_deleted', 'boolean', ['default' => 0, 'limit' => 11])
            ->addColumn('created', 'datetime', ['null' => true])
            ->addColumn('modified', 'datetime', ['null' => true])
            ->create();
    }
}
