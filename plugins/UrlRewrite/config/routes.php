<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Cache\Cache;
use Cake\Event\Event;
use Cake\Event\EventManager;

Router::plugin(
    'UrlRewrite',
    ['path' => '/url-rewrite'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::scope('/', function ($routes) {

    $cacheKey = 'url_rewrite_cache';
    $cacheConfig = 'url_rewrite_cache';

    $myRoutes = Cache::read($cacheKey, $cacheConfig);

    if (empty($myRoutes)) {
        $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange');
        EventManager::instance()->dispatch($event);
        $myRoutes = Cache::read($cacheKey, $cacheConfig);
    }

    if (!empty($myRoutes)) {
        foreach ($myRoutes as $type => $rewrites) {
            switch ($type) {
                case 'routes':
                    foreach ($rewrites as $rewrite) {
                        $routes->connect($rewrite['target_url'], [
                            'plugin' => $rewrite['plugin'],
                            'controller' => $rewrite['controller'],
                            'action' => $rewrite['action'], $rewrite['args']
                        ]);
                    }
                    break;
                case 'redirects' :
                    $currentDomain = $_SERVER['HTTP_HOST'] ?? null;
                    foreach ($rewrites as $rewrite) {
                        if (!empty($currentDomain) && $currentDomain == $rewrite['source_url']) {
                            header($rewrite['header']);
                            header("Location: " . $rewrite['target_url'] . $_SERVER['REQUEST_URI']);
                            exit();
                        } else {
                            $routes->redirect($rewrite['source_url'], $rewrite['target_url'], ['status' => $rewrite['status']]);
                        }
                    }
                    break;
            }
        }
    }
});
