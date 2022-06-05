<?php

use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\Event\EventManager;

class FeederRedirects extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     *
     * @property \Feeder\Model\Table\FeederCategoriesTable $FeederCategories
     * @property \UrlRewrite\Model\Table\UrlRewriteRoutesTable $UrlRewriteRoutes
     *
     */
    public function change()
    {
        $redirectTypesTable = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirectTypes');
        $type = $redirectTypesTable->find()->where(['code' => 302])->first();

        if (!empty($type)) {
            $redirects = [
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => 'www.dealsguru.de',
                    'target_url' => 'https://catch.app',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => 'dealsguru.de',
                    'target_url' => 'https://catch.app',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => 'www.catch.shop',
                    'target_url' => 'https://catch.app',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => 'catch.shop',
                    'target_url' => 'https://catch.app',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => 'www.catch.app',
                    'target_url' => 'https://catch.app',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => '/feeder/pages/display/datenschutz/*',
                    'target_url' => '/datenschutz/',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'url_rewrite_redirect_type_id' => $type->id,
                    'source_url' => '/feeder/pages/display/impressum/*',
                    'target_url' => '/impressum/',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            $this->insert('url_rewrite_redirects', $redirects);


            $this->FeederCategories = TableRegistry::getTableLocator()->get('Feeder.FeederCategories');
            $this->UrlRewriteRedirects = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirects');
            $type = $this->UrlRewriteRedirects->UrlRewriteRedirectTypes->find()->where(['code' => 302])->first();

            $headCategories = $this->FeederCategories->find('list')->where(['level' => 0]);

            foreach ($headCategories as $headCategoryId => $headCategoryName) {
                $categories = $this->FeederCategories->find('children', ['for' => $headCategoryId]);

                $entity = $this->UrlRewriteRedirects->newEntity([
                    'source_url' => '/feeder/browse/' . $headCategoryId . '/' . $headCategoryName,
                    'target_url' => '/' . strtolower(Text::slug($headCategoryName)) . '/',
                    'url_rewrite_redirect_type_id' => $type->id,
                    'creator' => 'legacy_url_redirect',
                    'timestamp' => time()
                ]);

                $this->UrlRewriteRedirects->save($entity);

                foreach ($categories as $category) {
                    $parentCategories = $this->FeederCategories->find('path', ['for' => $category->id]);
                    $categoryPath = [];
                    foreach ($parentCategories as $parentCategory) {
                        $categoryPath[] = Text::slug($parentCategory->name);
                    }
                    $entity = $this->UrlRewriteRedirects->newEntity([
                        'source_url' => '/feeder/browse/' . $category->id . '/' . $category->name,
                        'target_url' => '/' . strtolower(implode('-', $categoryPath)) . '/',
                        'url_rewrite_redirect_type_id' => $type->id,
                        'creator' => 'legacy_url_redirect',
                        'timestamp' => time(),
                    ]);

                    $this->UrlRewriteRedirects->save($entity);
                }
            }

            $routes = [
                [
                    'target_url' => '/datenschutz/',
                    'plugin' => 'Feeder',
                    'controller' => 'Pages',
                    'action' => 'display',
                    'args' => 'datenschutz',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'target_url' => '/impressum/',
                    'plugin' => 'Feeder',
                    'controller' => 'Pages',
                    'action' => 'display',
                    'args' => 'impressum',
                    'creator' => 'migration_file',
                    'timestamp' => time(),
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            $this->insert('url_rewrite_routes', $routes);
        }

        $event = new Event('Model.FeederCategories.afterSave', $this);
        EventManager::instance()->dispatch($event);

        $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
        EventManager::instance()->dispatch($event);
    }
}
