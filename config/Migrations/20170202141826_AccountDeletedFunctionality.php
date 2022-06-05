<?php
use Migrations\AbstractMigration;

class AccountDeletedFunctionality extends AbstractMigration
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
        $this->table('core_sellers')
            ->addColumn('is_deleted', 'boolean', ['default' => 0, 'null' => true, 'after' => 'is_active'])
            ->update();

        $this->table('core_users')
            ->addColumn('is_deleted', 'boolean', ['default' => 0, 'null' => true, 'after' => 'is_active'])
            ->update();
    }
}
