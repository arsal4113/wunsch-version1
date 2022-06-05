<?php
use Migrations\AbstractMigration;

class CoreUsersSuperUser extends AbstractMigration
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
        $this->table('core_users')->addColumn(
            'is_super_user',
            'integer',
            ['limit' => 2, 'null' => true, 'default' => null, 'after' => 'password']
        )->update();
    }
}
