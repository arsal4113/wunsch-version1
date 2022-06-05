<?php
use Migrations\AbstractMigration;

class ErrorHandling extends AbstractMigration
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
        $this->table('core_errors')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('type', 'string', ['limit' => 100])
            ->addColumn('sub_type', 'string', ['limit' => 100])
            ->addColumn('message', 'text')
            ->addColumn('foreign_key', 'string', ['limit' => 100])
            ->addColumn('foreign_model', 'string', ['limit' => 100])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['foreign_key'])
            ->addIndex(['foreign_model'])
            ->create();

        $this->table('core_error_notification_profiles')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('type', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('sub_type', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('email_to', 'string', ['limit' => 250])
            ->addColumn('email_cc', 'string', ['limit' => 250])
            ->addColumn('email_bcc', 'string', ['limit' => 250])
            ->addColumn('email_subject', 'string', ['limit' => 250])
            ->addColumn('is_active', 'boolean')
            ->addColumn('is_running', 'boolean')
            ->addColumn('last_run', 'datetime', ['null' => true])
            ->addColumn('run_interval', 'integer', ['limit' => 10])
            ->addColumn('next_run', 'datetime')
            ->addColumn('max_execution_time', 'integer', ['limit' => 10])
            ->addColumn('last_alive', 'datetime', ['default' => null])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['is_active'])
            ->addIndex(['is_running'])
            ->addIndex(['next_run'])
            ->create();
    }
}