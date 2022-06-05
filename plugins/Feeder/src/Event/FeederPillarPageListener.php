<?php


namespace Feeder\Event;

use Cake\Core\Plugin;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Feeder\Model\Table\FeederPillarPagesTable;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class FeederPillarPageListener
 * @package Feeder\Event
 * @property FeederPillarPagesTable $FeederPillarPages
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 */
class FeederPillarPageListener implements EventListenerInterface
{
    private $creator = 'feeder_pillar_page_listener';
    private $FeederPillarPages;
    private $UrlRewriteRoutes;
    private $UrlRewriteRedirects;
    private $redirectCode = 302;

    public function implementedEvents()
    {
        return [
            'Model.FeederPillarPages.afterSave' => 'refreshRouting',
            'Model.FeederPillarPages.afterDelete' => 'refreshRouting'
        ];
    }

    public function refreshRouting(Event $event)
    {
        if (Plugin::loaded('UrlRewrite')) {
            $this->FeederPillarPages = TableRegistry::getTableLocator()->get('Feeder.FeederPillarPages');

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

        $pillarPages = $this->FeederPillarPages->find('all');

        $urlRewriteRoutes = [];

        foreach ($pillarPages as $pillarPage) {
                if (empty($pillarPage->url_path)) {
                    $pillarPage->url_path = Text::slug(Inflector::dasherize($pillarPage->title_tag));
                    $this->FeederPillarPages->save($pillarPage);
                }
                $urlRewriteRoutes[] = $this->getUrlRewriteRouteEntity($pillarPage->url_path, $pillarPage->id, $routes);
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

    protected function getUrlRewriteRouteEntity($urlPath, $pillarPageId, $routes)
    {
        $entity = null;
        foreach ($routes as $route) {
            if ($route->args == $pillarPageId) {
                $entity = $this->UrlRewriteRoutes->patchEntity($route, [
                    'target_url' => '/' . $urlPath . '/*',
                    'plugin' => 'Feeder',
                    'controller' => 'PillarPage',
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
                'controller' => 'PillarPage',
                'action' => 'index',
                'creator' => $this->creator,
                'timestamp' => time(),
                'args' => $pillarPageId
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
                        'source_url' =>  '/feeder/pillar-page/' . $urlRewriteRoute->args,
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
                    'source_url' =>  '/feeder/pillar-page/' . $urlRewriteRoute->args,
                    'target_url' => $targetUrl,
                    'timestamp' => time(),
                    'creator' => $this->creator
                ]);
            }
        }
        return $entity;
    }
}