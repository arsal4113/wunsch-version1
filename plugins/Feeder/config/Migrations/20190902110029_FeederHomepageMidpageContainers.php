<?php
use Migrations\AbstractMigration;

class FeederHomepageMidpageContainers extends AbstractMigration
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
        $table = $this->table('feeder_homepage_midpage_containers');

        if (!$table->exists()) {
            $table
                ->addColumn('homepage_id', 'integer', ['default' => null, 'null' => true])
                ->addForeignKey('homepage_id', 'feeder_homepages', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                ->addColumn('video_desktop', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('video_tablet', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('video_mobile', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('image_desktop', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('image_tablet', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('image_mobile', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('use_video', 'boolean', ['default' => 0])
                ->addColumn('click_url', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('button_text', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('button_color', 'string', ['default' => null, 'limit' => 128, 'null' => true,])
                ->addColumn('background_color', 'string', ['default' => null, 'limit' => 128, 'null' => true,])
                ->save();
        }
    }
}
