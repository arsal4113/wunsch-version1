<?php
use Migrations\AbstractMigration;

class ModifyStateOfCustomersAddress extends AbstractMigration
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
            ->changeColumn('state', 'string', ['limit' => 200, 'after' => 'city', 'default' => null, 'null' => true])
            ->update();
    }
}
