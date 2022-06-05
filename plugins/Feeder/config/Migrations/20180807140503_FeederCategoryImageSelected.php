<?php

use Migrations\AbstractMigration;

class FeederCategoryImageSelected extends AbstractMigration
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

        if (!$table->hasColumn('image_selected')) {
             $table->addColumn('image_selected', 'string', [
                 'null' => true,
                 'limit' => 510,
                 'after' => 'image'
             ])
             ->update();
        }
    }
}
