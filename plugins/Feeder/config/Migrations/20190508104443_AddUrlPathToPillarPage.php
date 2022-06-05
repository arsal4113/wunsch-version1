<?php

use Cake\Event\Event;
use Cake\Event\EventManager;
use Migrations\AbstractMigration;

class AddUrlPathToPillarPage extends AbstractMigration
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
        $table = $this->table('feeder_pillar_pages');
        if(!$table->hasColumn('url_path')) {
            $table->addColumn('url_path', 'string', ['limit' => 1024, 'after' => 'title_tag'])->update();

            $event = new Event('Model.FeederPillarPages.afterSave', $this);
            EventManager::instance()->dispatch($event);

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            EventManager::instance()->dispatch($event);
        }
    }
}
