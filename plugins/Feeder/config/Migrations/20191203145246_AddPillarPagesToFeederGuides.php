<?php
use Migrations\AbstractMigration;

class AddPillarPagesToFeederGuides extends AbstractMigration
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
        $table = $this->table('feeder_guides_feeder_pillar_pages');

        $table->addColumn('feeder_guide_id', 'integer');
        $table->addColumn('feeder_pillar_page_id', 'integer');

        $table->addForeignKey('feeder_guide_id', 'feeder_guides', 'id', ['delete'=> 'CASCADE']);
        $table->addForeignKey('feeder_pillar_page_id', 'feeder_pillar_pages', 'id', ['delete'=> 'CASCADE']);

        $table->create();
    }
}
