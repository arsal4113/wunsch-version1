<?php
use Migrations\AbstractMigration;

class FeederCategoriesVideoElements extends AbstractMigration
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
        $table = $this->table('feeder_categories_video_elements');

        if (!$table->exists()) {
            $table
                ->addColumn('is_active', 'boolean', ['default' => true])
                ->addColumn('video_mp4', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('video_webm', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('background_color', 'string', ['default' => null, 'limit' => 128, 'null' => true,])
                ->addColumn('headline', 'string', ['default' => null, 'limit' => 1024, 'null' => true,])
                ->addColumn('headline_color', 'string', ['default' => null, 'limit' => 128, 'null' => true,])
                ->save();
        }
    }
}
