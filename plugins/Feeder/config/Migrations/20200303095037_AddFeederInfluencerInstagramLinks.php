<?php
use Migrations\AbstractMigration;

class AddFeederInfluencerInstagramLinks extends AbstractMigration
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
        $table = $this->table('feeder_influencers');
        $table->addColumn('area_8_ig_link', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_8_ig_name'])
            ->addColumn('area_9_ig_link', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_9_ig_name']);
        $table->update();
    }
}
