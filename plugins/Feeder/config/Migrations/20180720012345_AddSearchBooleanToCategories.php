<?php

use Migrations\AbstractMigration;

class AddSearchBooleanToCategories extends AbstractMigration
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

        if (!$table->hasColumn('use_in_search')) {
            $table->addColumn('use_in_search', 'integer', [
                     'null' => false,
                     'default' => 0,
                     'after' => 'sort_order'
                 ])
                 ->update();
        }
    }
}
