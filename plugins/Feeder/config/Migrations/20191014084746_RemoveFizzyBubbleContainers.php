<?php

use Migrations\AbstractMigration;

/**
 * Class RemoveFizzyBubbleContainers
 */
class RemoveFizzyBubbleContainers extends AbstractMigration
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
        if($table->hasForeignKey('feeder_fizzy_bubble_container_id')){
            $table->dropForeignKey('feeder_fizzy_bubble_container_id');
            $table->removeColumn('feeder_fizzy_bubble_container_id');
        }

        $table = $this->table('feeder_fizzy_bubbles_feeder_fizzy_bubble_containers');
        if($table->exists()){
            $table->dropForeignKey('feeder_fizzy_bubble_id');
            $table->dropForeignKey('feeder_fizzy_bubble_container_id');
            $this->dropTable('feeder_fizzy_bubbles_feeder_fizzy_bubble_containers');
        }

        $table = $this->table('feeder_fizzy_bubble_containers');
        if($table->exists()){
            $this->dropTable('feeder_fizzy_bubble_containers');
        }
    }
}
