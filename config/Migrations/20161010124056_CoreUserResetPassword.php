<?php
use Migrations\AbstractMigration;

class CoreUserResetPassword extends AbstractMigration
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
            ->addColumn('reset_password_token', 'string', ['limit' => 250, 'null' => true, 'after' => 'redirect_url'])
            ->addColumn('token_created_at', 'date', ['limit' => 250, 'null' => true, 'after' => 'reset_password_token'])
            ->update();
    }
}
