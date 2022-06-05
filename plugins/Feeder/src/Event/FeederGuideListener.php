<?php


namespace Feeder\Event;

use Cake\Core\Plugin;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Feeder\Model\Table\FeederGuidesTable;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class FeederGuideListener
 * @package Feeder\Event
 * @property FeederGuidesTable $FeederGuides
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 */
class FeederGuideListener implements EventListenerInterface
{
    private $creator = 'feeder_guide_listener';
    private $FeederGuides;
    private $UrlRewriteRoutes;
    private $UrlRewriteRedirects;
    private $redirectCode = 302;

    public function implementedEvents()
    {
        return [
            'Model.FeederGuides.afterSave' => 'refreshRouting',
            'Model.FeederGuides.afterDelete' => 'refreshRouting'
        ];
    }

    public function refreshRouting(Event $event)
    {
        if (Plugin::loaded('UrlRewrite')) {
            $this->FeederGuides = TableRegistry::getTableLocator()->get('Feeder.FeederGuides');

            # avoid loop after saving default url paths for categories
            EventManager::instance()->off($this);

            $urlRewriteRoutes = $this->refreshRoutes();
            $this->refreshRedirects($urlRewriteRoutes);

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            EventManager::instance()->dispatch($event);
        }
    }

    protected function refreshRoutes()
    {
        $startTimestamp = time();
        $this->UrlRewriteRoutes = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRoutes');

        $routes = $this->UrlRewriteRoutes->find()
            ->where([
                'creator' => $this->creator
            ]);

        $guides = $this->FeederGuides->find('all');

        $urlRewriteRoutes = [];

        foreach ($guides as $guide) {
            if (empty($guide->url_path)) {
                $guide->url_path = Text::slug(Inflector::dasherize($guide->title));
                $this->FeederGuides->save($guide);
            }
            $urlRewriteRoutes[] = $this->getUrlRewriteRouteEntity($guide->url, $guide->id, $routes);
        }

        if ($this->UrlRewriteRoutes->saveMany($urlRewriteRoutes)) {
            $this->UrlRewriteRoutes->deleteAll(['creator' => $this->creator, 'timestamp <' => $startTimestamp]);
        }
        return $urlRewriteRoutes;
    }

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

    protected function getUrlRewriteRouteEntity($urlPath, $guideId, $routes)
    {
        $entity = null;
        foreach ($routes as $route) {
            if ($route->args == $guideId) {
                $entity = $this->UrlRewriteRoutes->patchEntity($route, [
                    'target_url' => '/' . $urlPath . '/*',
                    'plugin' => 'Feeder',
                    'controller' => 'Guide',
                    'action' => 'index',
                    'timestamp' => time(),
                ]);
                break;
            }
        }
        if (empty($entity)) {
            $entity = $this->UrlRewriteRoutes->newEntity([
                'target_url' => '/' . $urlPath . '/*',
                'plugin' => 'Feeder',
                'controller' => 'Guide',
                'action' => 'index',
                'creator' => $this->creator,
                'timestamp' => time(),
                'args' => $guideId
            ]);
        }
        return $entity;
    }

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
                        'source_url' =>  '/feeder/guide/' . $urlRewriteRoute->args,
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
                    'source_url' =>  '/feeder/guide/' . $urlRewriteRoute->args,
                    'target_url' => $targetUrl,
                    'timestamp' => time(),
                    'creator' => $this->creator
                ]);
            }
        }
        return $entity;
    }
}
