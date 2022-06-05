<?php
use Migrations\AbstractMigration;

class ModifyCoreUsersTable extends AbstractMigration
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
            ->addColumn('redirect_url', 'string', ['limit' => 250, 'after' => 'is_super_user', 'null' => true, 'default' => null])
            ->save();
    }
}
