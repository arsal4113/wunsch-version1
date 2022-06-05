<?php
use Migrations\AbstractMigration;

class AddFeederGuidesFeederCategories extends AbstractMigration
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
        $table = $this->table('feeder_guides_feeder_categories');

        $table->addColumn('feeder_guide_id', 'integer');
        $table->addColumn('feeder_category_id', 'integer');

        $table->addForeignKey('feeder_guide_id', 'feeder_guides', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION']);
        $table->addForeignKey('feeder_category_id', 'feeder_categories', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION']);

        $table->create();
    }
}
