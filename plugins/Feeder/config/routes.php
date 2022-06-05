<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Feeder',
    ['path' => '/feeder'],
    function (RouteBuilder $routes) {
        $routes->connect('/browse', ['controller' => 'Browse', 'action' => 'view']);
        $routes->connect('/product-description/:itemId', ['controller' => 'Products', 'action' => 'description'], ['pass' => ['itemId']]);
        $routes->connect('/suggest', ['controller' => 'Browse', 'action' => 'suggest']);
        $routes->connect('/search', ['controller' => 'Browse', 'action' => 'search']);
        $routes->connect('/pillar-page', ['controller' => 'PillarPage', 'action' => 'index']);
        $routes->connect('/quiz', ['controller' => 'Quiz', 'action' => 'index']);
        $routes->connect('/interests', ['controller' => 'Interests', 'action' => 'view']);
        $routes->connect('/fizzy-bubble', ['controller' => 'FizzyBubbles', 'action' => 'index']);
        $routes->connect('/guides', ['controller' => 'Guide', 'action' => 'index']);
        $routes->fallbacks(DashedRoute::class);
    }
);

Router::scope('/', function ($routes) {
    $routes->connect('/itm/:itemId', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['itemId']]);
    $routes->connect('/itm/:itemId/:slug', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['itemId', 'slug']]);

    $routes->connect('/gtin/:gtin', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['gtin']])
        ->setPatterns(['gtin' => '[0-9]{8,}']);
    $routes->connect('/gtin/:gtin/:slug', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['gtin', 'slug']])
        ->setPatterns(['gtin' => '[0-9]{8,}']);

    $routes->connect('/epid/:epid', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['epid']])
        ->setPatterns(['epid' => '[0-9]{8,}']);
    $routes->connect('/epid/:epid/:slug', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['pass' => ['epid', 'slug']])
        ->setPatterns(['epid' => '[0-9]{8,}']);

    $routes->redirect('/feeder/product/:itemId', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['persist' => true, 'pass' => ['itemId'], 'status' => 'HTTP/1.1 302 Found (Moved Temporarily)']);
    $routes->redirect('/feeder/product/:itemId/:slug', ['plugin' => 'Feeder', 'controller' => 'Products', 'action' => 'view'], ['persist' => true, 'pass' => ['itemId', 'slug'], 'status' => 'HTTP/1.1 302 Found (Moved Temporarily)']);

    $routes->connect('/trends', ['plugin' => 'Feeder', 'controller' => 'Worlds', 'action' => 'view']);
});
