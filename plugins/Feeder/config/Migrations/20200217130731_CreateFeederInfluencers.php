<?php
use Migrations\AbstractMigration;

class CreateFeederInfluencers extends AbstractMigration
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
        $table->addColumn('name', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('url_path', 'string', ['limit' => 1024, 'null' => true])
            ->addColumn('title_tag', 'string', ['limit' => 256, 'default' => null, 'null' => true])
            ->addColumn('robot_tag', 'string', ['limit' => 256, 'default' => null, 'null' => true])
            ->addColumn('area_1_headline', 'string', ['limit' => 256, 'default' => null, 'null' => true])
            ->addColumn('area_1_text', 'string', ['limit' => 256, 'default' => null, 'null' => true])
            ->addColumn('area_2_text', 'string', ['limit' => 1024, 'default' => null, 'null' => true])
            ->addColumn('area_3_image', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_1', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_2', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_3', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_4', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_5', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_5_image_6', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_6_image_1', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_6_image_2', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_7_text', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_8_headline_1', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_8_headline_2', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_8_subline', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_8_button_link', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_8_world_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('area_8_ig_name', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_9_headline_1', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_9_headline_2', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_9_subline', 'string', ['limit' => 128, 'default' => null, 'null' => true])
            ->addColumn('area_9_button_link', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('area_9_world_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('area_9_ig_name', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addIndex('area_8_world_id')
            ->addIndex('area_9_world_id');
        $table->save();

        $table = $this->table('feeder_influencer_mini_categories');
        $table->addColumn('name', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('url', 'string', ['limit' => 1024, 'null' => true])
            ->addColumn('image', 'string', ['limit' => 512, 'default' => null, 'null' => true])
            ->addColumn('feeder_influencer_id', 'integer')
            ->addIndex('feeder_influencer_id');
        $table->save();
    }
}
