<?php
use Migrations\AbstractMigration;

class FizzyBubbleContainers extends AbstractMigration
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
        $table = $this->table('feeder_fizzy_bubble_containers');
        if (!$table->exists()) {
            $table
                ->addColumn('name', 'string')
                ->save();
        }

        $table = $this->table('feeder_fizzy_bubbles_feeder_fizzy_bubble_containers');
        if (!$table->exists()) {
            $table
                ->addColumn('feeder_fizzy_bubble_id', 'integer')
                ->addColumn('feeder_fizzy_bubble_container_id', 'integer')
                ->save();

            $table
                ->addForeignKey('feeder_fizzy_bubble_id', 'feeder_fizzy_bubbles', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('feeder_fizzy_bubble_container_id', 'feeder_fizzy_bubble_containers', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->save();
        }
    }
}
