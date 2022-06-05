<?php
use Migrations\AbstractMigration;

class AddHeadlineGuideToFeederCategories extends AbstractMigration
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

        $table->addColumn('headline_guide', 'text', ['null' => true, 'default' => null, 'after' => 'headline']);

        $table->update();
    }
}
