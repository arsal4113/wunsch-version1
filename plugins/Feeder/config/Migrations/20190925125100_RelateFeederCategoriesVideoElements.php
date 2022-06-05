<?php
use Migrations\AbstractMigration;

class RelateFeederCategoriesVideoElements extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('feeder_categories');

        if (!$table->hasColumn('feeder_categories_video_element_id')) {
            $table
                ->addColumn('feeder_categories_video_element_id', 'integer', ['default' => null, 'null' => true, 'after' => 'robot_tag'])
                ->addForeignKey('feeder_categories_video_element_id', 'feeder_categories_video_elements', 'id',
                    ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
                ->save();
        }
    }

    public function down()
    {
    }
}
