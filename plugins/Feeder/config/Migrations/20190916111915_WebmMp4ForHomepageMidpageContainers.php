<?php
use Migrations\AbstractMigration;

class WebmMp4ForHomepageMidpageContainers extends AbstractMigration
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

        if ($table->exists()) {
            $table
                ->renameColumn('video_desktop', 'video_desktop_mp4')
                ->renameColumn('video_tablet', 'video_tablet_mp4')
                ->renameColumn('video_mobile', 'video_mobile_mp4')
                ->save();

            $table
                ->addColumn('video_desktop_webm', 'string', ['default' => null, 'limit' => 1024, 'null' => true, 'after' => 'video_mobile_mp4'])
                ->addColumn('video_tablet_webm', 'string', ['default' => null, 'limit' => 1024, 'null' => true, 'after' => 'video_desktop_webm'])
                ->addColumn('video_mobile_webm', 'string', ['default' => null, 'limit' => 1024, 'null' => true, 'after' => 'video_tablet_webm'])
                ->save();
        }
    }
}
