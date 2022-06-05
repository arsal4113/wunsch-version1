<?php
use Migrations\AbstractMigration;

class AddFeederInfluencerLinkFields extends AbstractMigration
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
        $table->addColumn('area_2_link', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_2_text'])
            ->addColumn('area_5_text', 'string', ['limit' => 512, 'default' => null, 'null' => true, 'after' => 'area_3_image']);
        $table->save();
    }
}
