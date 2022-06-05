<?php
use Migrations\AbstractMigration;

class AddFeederCategoriesFeederFizzyBubbleContainer extends AbstractMigration
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

        if (!$table->hasColumn('feeder_fizzy_bubble_container_id')) {
            $table
                ->addColumn('feeder_fizzy_bubble_container_id', 'integer', ['default' => null, 'null' => true, 'after' => 'robot_tag'])
                ->save();

            $table
                ->addForeignKey('feeder_fizzy_bubble_container_id', 'feeder_fizzy_bubble_containers', 'id',
                    ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
                ->save();

        }
    }
}
