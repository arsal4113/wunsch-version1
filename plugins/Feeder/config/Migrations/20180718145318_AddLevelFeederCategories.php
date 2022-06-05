<?php
use Migrations\AbstractMigration;

class AddLevelFeederCategories extends AbstractMigration
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

         if(!$table->hasColumn('level')) {
             $table->addColumn('level', 'integer', ['null' => true, 'after' => 'rght'])->update();
         }
    }
}
