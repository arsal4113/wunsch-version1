<?php
use Migrations\AbstractMigration;

class FeederHomepageAddMetaRobotsTag extends AbstractMigration
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
        if(!$table->hasColumn('meta_robots_tag')) {
            $table
                ->addColumn('meta_robots_tag', 'string', ['limit' => 200, 'default' => null, 'null' => true, 'after' => 'title_tag'])
                ->update();
        }
    }
}
