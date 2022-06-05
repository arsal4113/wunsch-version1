<?php
use Migrations\AbstractMigration;

class CoreMarketplaceRunningProfileModification extends AbstractMigration
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
        if (!$this->table('core_marketplace_running_profiles')->hasColumn('source')) {
            $this->table('core_marketplace_running_profiles')
                ->addColumn('source', 'string', ['limit' => 200, 'after' => 'running_type', 'null' => true, 'default' => null])
                ->update();
        }
        $indexes = [
            'core_marketplace_id',
            'account_id',
            'running_type',
            'run_interval',
            'source'
        ];

        foreach ($indexes as $index) {
            if (!$this->table('core_marketplace_running_profiles')->hasIndex([$index])) {
                $this->table('core_marketplace_running_profiles')
                    ->addIndex([$index])
                    ->update();
            }
        }
    }
}
