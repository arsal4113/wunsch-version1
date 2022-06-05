<?php

use Migrations\AbstractMigration;

class AddItemIdsToFeederCategory extends AbstractMigration
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
        if (!$table->hasColumn('item_id')) {
            $table
                ->addColumn('item_id', 'text', ['default' => null, 'null' => true, 'after' => 'name'])
                ->update();
        }

        if (!$table->hasIndex(['lft', 'rght'])) {
            $table
                ->addIndex(['lft', 'rght'])
                ->update();
        }
    }
}
