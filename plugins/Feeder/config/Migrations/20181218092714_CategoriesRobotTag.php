<?php
use Migrations\AbstractMigration;

class CategoriesRobotTag extends AbstractMigration
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
        $table = $this->table('feeder_categories');
        if(!$table->hasColumn('robot_tag')) {
            $table
                ->addColumn('robot_tag', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'title_tag'])
                ->update();
        }
    }
}
