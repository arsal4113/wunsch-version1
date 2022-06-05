<?php
use Migrations\AbstractMigration;

class UpdateExcludeCustomers extends AbstractMigration
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
            ->addColumn('uploaded_user_identifier', 'integer', ['limit' => 11, 'null' => false, 'after' => 'is_deleted'])
            ->addColumn('status', 'string', ['limit' => 50, 'default' => 'pending', 'after' => 'uploaded_user_identifier'])
            ->addIndex('email')
            ->update();
    }
}
