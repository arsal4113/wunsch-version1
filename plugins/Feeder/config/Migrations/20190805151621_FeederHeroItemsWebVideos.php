<?php
use Migrations\AbstractMigration;

class FeederHeroItemsWebVideos extends AbstractMigration
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
        $table = $this->table('feeder_hero_items');

        if (!$table->hasColumn('webm')) {
            $table->addColumn('webm', 'string', [
                'null' => true,
                'after' => 'type',
                'limit' => 1024,
                'default' => null
            ]);
        }

        if (!$table->hasColumn('mp4')) {
            $table->addColumn('mp4', 'string', [
                'null' => true,
                'after' => 'webm',
                'limit' => 1024,
                'default' => null
            ]);
        }

        $table->update();
    }
}
