<?php
use Cake\Event\Event;
use Cake\Event\EventManager;
use Migrations\AbstractMigration;

class CreateFeederQuizzesTable extends AbstractMigration
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
        $this->table('feeder_quizzes')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('url_path', 'string', [
                'limit' => 1024,
                'null' => true
            ])
            ->addColumn('meta_description', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('title_tag', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('robot_tag', 'string', [
                'limit' => 200,
                'default' => null,
                'null' => true
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('question_config', 'text', [
                'null' => true,
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_MEDIUM,
                'default' => null
            ])
            ->create();

        $event = new Event('Model.FeederQuizzes.afterSave', $this);
        EventManager::instance()->dispatch($event);

        $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
        EventManager::instance()->dispatch($event);
    }
}
