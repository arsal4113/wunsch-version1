<?php
use Cake\Event\Event;
use Cake\Event\EventManager;
use Migrations\AbstractMigration;

class AddFeederGuidesTable extends AbstractMigration
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
        $this->table('feeder_guides')
            ->addColumn('url', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('meta_tag', 'integer', [
                'default' => 100,
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('use_in_navigation', 'integer', [
                'null' => false,
                'default' => 0
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'limit' => 11,
            ])
            ->create();

        $event = new Event('Model.FeederGuides.afterSave', $this);
        EventManager::instance()->dispatch($event);

        $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
        EventManager::instance()->dispatch($event);
    }
}
