<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 06.08.18
 * Time: 16:17
 */

namespace Feeder\Event;

use Cake\Core\Plugin;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Feeder\Model\Table\FeederCategoriesTable;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class FeederCategoryListener
 * @package Feeder\Event
 * @property FeederCategoriesTable $FeederCategories
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 */
class FeederCategoryListener implements EventListenerInterface
{
    private $creator = 'feeder_category_listener';
    private $FeederCategories;
    private $UrlRewriteRoutes;
    private $UrlRewriteRedirects;
    private $redirectCode = 302;

    /**
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Model.FeederCategories.afterSave' => 'refreshRouting',
            'Model.FeederCategories.afterDelete' => 'refreshRouting'
        ];
    }

    /**
     * @param Event $event
     * @throws \Exception
     */
    public function refreshRouting(Event $event)
    {
        if (Plugin::loaded('UrlRewrite')) {
            $this->FeederCategories = TableRegistry::getTableLocator()->get('Feeder.FeederCategories');

            # avoid loop after saving default url paths for categories
            EventManager::instance()->off($this);

            $urlRewriteRoutes = $this->refreshRoutes();
            $this->refreshRedirects($urlRewriteRoutes);

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            EventManager::instance()->dispatch($event);
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function refreshRoutes()
    {
        $startTimestamp = time();
        $this->UrlRewriteRoutes = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRoutes');

        $routes = $this->UrlRewriteRoutes->find()
            ->where([
                'creator' => $this->creator
            ]);

        $headCategories = $this->FeederCategories->find('list')->where(['level' => 0]);

        $urlRewriteRoutes = [];

        foreach ($headCategories as $headCategoryId => $headCategoryName) {
            $categories = $this->FeederCategories->find('children', ['for' => $headCategoryId]);
            foreach ($categories as $category) {

                if (empty($category->url_path)) {
                    $parentCategories = $this->FeederCategories->find('path', ['for' => $category->id]);
                    $categoryPath = [];

                    foreach ($parentCategories as $key => $parentCategory) {
                        // skip root category
                        if ($key > 0) {
                            $categoryPath[] = Text::slug($parentCategory->name);
                        }
                    }
                    $category->url_path = strtolower(implode('-', $categoryPath));
                    $this->FeederCategories->save($category);
                }
                $urlRewriteRoutes[] = $this->getUrlRewriteRouteEntity($category->url_path, $category->id, $routes);
            }
        }

        if ($this->UrlRewriteRoutes->saveMany($urlRewriteRoutes)) {
            $this->UrlRewriteRoutes->deleteAll(['creator' => $this->creator, 'timestamp <' => $startTimestamp]);
        }
        return $urlRewriteRoutes;
    }

    /**
     * @param $urlRewriteRoutes
     * @throws \Exception
     */
    protected function refreshRedirects($urlRewriteRoutes)
    {
        $startTimestamp = time();
        $this->UrlRewriteRedirects = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirects');

        $redirectType = $this->UrlRewriteRedirects->UrlRewriteRedirectTypes->find()
            ->where(['code' => $this->redirectCode])
            ->first();

        $urlRewriteRedirects = $this->UrlRewriteRedirects->find()
            ->where([
                'creator' => $this->creator
            ]);

        $newUrlRewriteRedirects = [];

        foreach ($urlRewriteRoutes as $urlRewriteRoute) {
            $newUrlRewriteRedirect = $this->getUrlRewriteRedirectEntity($redirectType, $urlRewriteRoute, $urlRewriteRedirects);
            if (!empty($newUrlRewriteRedirect)) {
                $newUrlRewriteRedirects[] = $newUrlRewriteRedirect;
            }
        }
        if (!empty($newUrlRewriteRedirects)) {
            if ($this->UrlRewriteRedirects->saveMany($newUrlRewriteRedirects)) {
                $this->UrlRewriteRedirects->deleteAll(['creator' => $this->creator, 'timestamp <' => $startTimestamp]);
            }
        }
    }

    /**
     * @param $urlPath
     * @param $categoryId
     * @param $routes
     * @return \Cake\Datasource\EntityInterface|null
     */
    protected function getUrlRewriteRouteEntity($urlPath, $categoryId, $routes)
    {
        $entity = null;
        foreach ($routes as $route) {
            if ($route->args == $categoryId) {
                $entity = $this->UrlRewriteRoutes->patchEntity($route, [
                    'target_url' => '/' . $urlPath . '/*',
                    'plugin' => 'Feeder',
                    'controller' => 'Browse',
                    'action' => 'view',
                    'timestamp' => time(),
                ]);
                break;
            }
        }
        if (empty($entity)) {
            $entity = $this->UrlRewriteRoutes->newEntity([
                'target_url' => '/' . $urlPath . '/*',
                'plugin' => 'Feeder',
                'controller' => 'Browse',
                'action' => 'view',
                'creator' => $this->creator,
                'timestamp' => time(),
                'args' => $categoryId
            ]);
        }
        return $entity;
    }

    /**
     * @param $redirectType
     * @param $urlRewriteRoute
     * @param $urlRewriteRedirects
     * @return \Cake\Datasource\EntityInterface|null
     */
    protected function getUrlRewriteRedirectEntity($redirectType, $urlRewriteRoute, $urlRewriteRedirects)
    {
        $entity = null;
        //remove last *
        $targetUrl = explode('*', $urlRewriteRoute->target_url);
        $targetUrl = $targetUrl[0] ?? null;
        if (!empty($targetUrl)) {
            foreach ($urlRewriteRedirects as $urlRewriteRedirect) {
                if ($urlRewriteRedirect->target_url == $targetUrl) {
                    $entity = $this->UrlRewriteRedirects->patchEntity($urlRewriteRedirect, [
                        'url_rewrite_redirect_type_id' => $redirectType->id,
                        //generate url based on template with the _name defined in the routes.php
                        'source_url' =>  '/feeder/browse/view/' . $urlRewriteRoute->args,
                        'target_url' => $targetUrl,
                        'timestamp' => time()
                    ]);
                    break;
                }
            }
            if (empty($entity)) {
                $entity = $this->UrlRewriteRedirects->newEntity([
                    'url_rewrite_redirect_type_id' => $redirectType->id,
                    //generate url based on template with the _name defined in the routes.php
                    'source_url' =>  '/feeder/browse/view/' . $urlRewriteRoute->args,
                    'target_url' => $targetUrl,
                    'timestamp' => time(),
                    'creator' => $this->creator
                ]);
            }
        }
        return $entity;
    }
}
