<?php
use Migrations\AbstractMigration;

class AddRandomizerFeederCategories extends AbstractMigration
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

        $table->addColumn('randomize', 'integer', ['limit' => 10, 'null' => true, 'after' => 'background', 'default' => null]);

        $table->update();
    }
}
