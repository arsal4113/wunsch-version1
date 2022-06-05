<?php
use Migrations\AbstractMigration;

class AddNavigationNameToFeederGuides extends AbstractMigration
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
        $table = $this->table('feeder_guides');

        $table->addColumn('navigation_name', 'string', ['null' => true, 'default' => null, 'limit' => 256, 'after' => 'use_in_navigation']);

        $table->update();
    }
}
