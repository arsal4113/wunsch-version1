<?php
use Migrations\AbstractMigration;

class AddSortByInputSequenceToFeederCategories extends AbstractMigration
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
        $table->addColumn('sort_by_input_sequence', 'boolean', ['default' => false, 'after' => 'randomize']);
        $table->update();
    }
}
