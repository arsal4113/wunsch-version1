<?php
use Migrations\AbstractMigration;

class CoreMarketplaceRunningProfiles extends AbstractMigration
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
        $this->table('core_marketplace_running_profiles')
            ->addColumn('core_marketplace_id', 'integer', ['limit' => 10])
            ->addColumn('account_id', 'integer', ['limit' => 10])
            ->addColumn('running_type', 'string', ['limit' => 10])
            ->addColumn('is_running', 'boolean')
            ->addColumn('last_start', 'datetime', ['null' => true])
            ->addColumn('next_start', 'datetime')
            ->addColumn('run_interval', 'integer', ['limit' => 10])
            ->addColumn('last_alive', 'datetime', ['null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_marketplace_id'])
            ->addIndex(['account_id'])
            ->addIndex(['running_type'])
            ->create();
    }
}
