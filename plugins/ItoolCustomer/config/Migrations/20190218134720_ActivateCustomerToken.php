<?php
use Migrations\AbstractMigration;

class ActivateCustomerToken extends AbstractMigration
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
        if (!$table->hasColumn('activate_token')) {
            $table->addColumn('activate_token', 'string', ['default' => null, 'null' => true, 'after' => 'password', 'limit' => 1000]);

        }

        $table->update();
    }
}
