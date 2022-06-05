<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 09.08.18
 * Time: 16:12
 */

namespace UrlRewrite\Event;

use Cake\Cache\Cache;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class UrlRewriteChangeListener
 * @package UrlRewrite\Event
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 *
 */
class UrlRewriteChangeListener implements EventListenerInterface
{

    private $cacheKey = 'url_rewrite_cache';
    private $cacheConfig = 'url_rewrite_cache';

    /**
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'UrlRewrite.UrlRewriteChanged.afterChange' => 'refreshCache'
        ];
    }

    /**
     * refreshCache
     */
    public function refreshCache()
    {
        $this->refreshRoutesCache();
        $this->refreshRedirectsCache();
        Cache::clear(false, '_cake_routes_');
    }

    /**
     * refreshRoutesCache
     */
    protected function refreshRoutesCache()
    {
        $this->UrlRewriteRoutes = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRoutes');

        $routes = $this->UrlRewriteRoutes->find();

        $newCachedRoutes = [];
        foreach ($routes as $route) {
            $newCachedRoutes[] = [
                'target_url' => $route->target_url,
                'plugin' => $route->plugin,
                'controller' => $route->controller,
                'action' => $route->action,
                'args' => $route->args
            ];
        }

        $cachedRewrites = Cache::read($this->cacheKey, $this->cacheConfig);
        $cachedRewrites['routes'] = $newCachedRoutes;

        Cache::write($this->cacheKey, $cachedRewrites, $this->cacheConfig);
    }
    /**
     * refreshRedirectsCache
     */
    protected function refreshRedirectsCache()
    {
        $this->UrlRewriteRedirects = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirects');

        $redirects = $this->UrlRewriteRedirects->find()->contain(['UrlRewriteRedirectTypes']);

        $newCachedRedirects = [];
        foreach ($redirects as $redirect) {
            $newCachedRedirects[] = [
                'source_url' => $redirect->source_url,
                'target_url' => $redirect->target_url,
                'status' => $redirect->url_rewrite_redirect_type->code,
                'header' => $redirect->url_rewrite_redirect_type->header
            ];
        }
        $cachedRewrites = Cache::read($this->cacheKey, $this->cacheConfig);
        $cachedRewrites['redirects'] = $newCachedRedirects;
        Cache::write($this->cacheKey, $cachedRewrites, $this->cacheConfig);
    }
}
