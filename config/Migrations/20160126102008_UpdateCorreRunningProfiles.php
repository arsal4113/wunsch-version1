<?php
use Migrations\AbstractMigration;

class UpdateCorreRunningProfiles extends AbstractMigration
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
            ->changeColumn('running_type', 'string', ['limit' => 100])
            ->addColumn('is_active', 'boolean', ['after' => 'is_running'])
            ->update();
    }
}
