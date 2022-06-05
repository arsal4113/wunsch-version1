<?php

use Migrations\AbstractMigration;

class AddResetTokenCustomers extends AbstractMigration
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
        if (!$table->hasColumn('reset_token')) {
            $table->addColumn('reset_token', 'string', ['default' => null, 'null' => true, 'after' => 'password', 'limit' => 1000]);

        }

        if (!$table->hasColumn('reset_timeout')) {
            $table->addColumn('reset_timeout', 'timestamp', ['default' => null, 'null' => true, 'after' => 'reset_token']);

        }

        $table->update();
    }
}
