<?php
use Migrations\AbstractMigration;

class AddConfigurableHomepageLogo extends AbstractMigration
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
        $table = $this->table('feeder_homepages');

        if(!$table->hasColumn('main_logo')) {
            $table
                ->addColumn('main_logo', 'string', ['limit' => 1024, 'default' => 'CatchTheme.catch-logo-yellow.svg', 'after' => 'id'])
                ->update();
        }
        if(!$table->hasColumn('time_logo')) {
            $table
                ->addColumn('time_logo','string', ['limit' => 1024, 'default' => 'CatchTheme.catch-logo-yellow.svg', 'after' => 'main_logo'])
                ->update();
        }
        if(!$table->hasColumn('logo_start_time')) {
            $table
                ->addColumn('logo_start_time', 'datetime', ['default' => null, 'null' => true, 'after' => 'time_logo'])
                ->update();
        }
        if(!$table->hasColumn('logo_end_time')) {
            $table
                ->addColumn('logo_end_time', 'datetime', ['default' => null, 'null' => true, 'after' => 'logo_start_time'])
                ->update();
        }
    }
}
