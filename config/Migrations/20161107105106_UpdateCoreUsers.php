<?php
use Migrations\AbstractMigration;

class UpdateCoreUsers extends AbstractMigration
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
        $this->table('core_users')
            ->addColumn('first_name', 'string', ['limit' => 250, 'default' => null, 'null' => true,  'after' => 'is_active'])
            ->addColumn('last_name', 'string', ['limit' => 250, 'default' => null, 'null' => true,  'after' => 'first_name'])
            ->update();
    }
}
