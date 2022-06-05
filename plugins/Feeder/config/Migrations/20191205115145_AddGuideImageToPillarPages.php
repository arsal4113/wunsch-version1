<?php
use Migrations\AbstractMigration;

class AddGuideImageToPillarPages extends AbstractMigration
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
        $table = $this->table('feeder_pillar_pages');

        $table->addColumn('guide_image', 'string', ['default' => null, 'null' => true, 'limit' => 512]);
        $table->addColumn('guide_headline', 'string', ['default' => null, 'null' => true, 'limit' => 256]);

        $table->update();
    }
}
