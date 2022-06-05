<?php
use Migrations\AbstractMigration;

class AddFeederInfluencerMobileFields extends AbstractMigration
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
        $table->addColumn('area_7_text_mobile', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_7_text'])
            ->addColumn('area_8_image', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_7_text_mobile'])
            ->addColumn('area_9_image', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_8_ig_name']);
        $table->save();
    }
}
