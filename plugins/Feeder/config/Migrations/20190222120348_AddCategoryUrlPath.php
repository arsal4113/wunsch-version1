<?php
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Event\EventManager;

class AddCategoryUrlPath extends AbstractMigration
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
        $table = $this->table('feeder_categories');

        if (!$table->hasColumn('url_path')) {
            $table->addColumn('url_path', 'string', ['limit' => 1024, 'after' => 'name'])->update();

            $event = new Event('Model.FeederCategories.afterSave', $this);
            EventManager::instance()->dispatch($event);

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            EventManager::instance()->dispatch($event);
        }

        if (!$table->hasColumn('headline')) {
            $table->addColumn('headline', 'string', ['limit' => 1024, 'after' => 'url_path'])->update();

            $feederCategories = TableRegistry::getTableLocator()->get('Feeder.FeederCategories');
            foreach ($feederCategories->find() as $category) {
                if (empty($category->headline)) {
                    $category->headline = $category->name;
                    $feederCategories->save($category);
                }
            }
        }
    }
}
