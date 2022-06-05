<?php
use Migrations\AbstractMigration;

class AddFeederInfluencerImageField extends AbstractMigration
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
        $table->addColumn('area_6_image_3', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_6_image_2'])
            ->update();
    }
}
