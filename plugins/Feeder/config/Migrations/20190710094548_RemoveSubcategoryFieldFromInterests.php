<?php
use Migrations\AbstractMigration;

class RemoveSubcategoryFieldFromInterests extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('feeder_interests_table');
        $table->removeColumn('sub_categories');
        $table->rename('feeder_interests')
            ->save();
    }
}
