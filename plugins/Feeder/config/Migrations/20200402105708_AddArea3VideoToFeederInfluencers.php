<?php
use Migrations\AbstractMigration;

class AddArea3VideoToFeederInfluencers extends AbstractMigration
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
        $table->addColumn('area_3_video', 'string', ['limit' => 512, 'null' => true, 'default' => null, 'after' => 'area_3_image']);
        $table->save();
    }
}
