<?php
use Migrations\AbstractMigration;

class AddHomepageBannerTimeRange extends AbstractMigration
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
        $table = $this->table('feeder_homepage_banners');
        if(!$table->hasColumn('start_time')) {
            $table
                ->addColumn('start_time', 'datetime', ['default' => null, 'null' => true, 'after' => 'sort_order'])
                ->addIndex(['start_time'])
                ->update();
        }
        if(!$table->hasColumn('end_time')) {
            $table
                ->addColumn('end_time', 'datetime', ['default' => null, 'null' => true, 'after' => 'start_time'])
                ->addIndex(['end_time'])
                ->update();
        }
    }
}
