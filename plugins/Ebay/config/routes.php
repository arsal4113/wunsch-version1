<?php

use Cake\Routing\Router;
use Cake\Routing\RouteBuilder;

Router::plugin(
    'Ebay',
    ['path' => '/ebay'],
    function (RouteBuilder $routes) {
        $routes->connect(
            '/accepted/*',
            [
                'controller' => 'EbayAuthLandingPages',
                'action' => 'accepted',
                'plugin' => 'Ebay'
            ]
        );
        $routes->connect(
            '/declined',
            [
                'controller' => 'EbayAuthLandingPages',
                'action' => 'declined',
                'plugin' => 'Ebay'
            ]
        );
        $routes->connect(
            '/login',
            [
                'controller' => 'EbayAuthLandingPages',
                'action' => 'login',
                'plugin' => 'Ebay'
            ]
        );
        $routes->fallbacks('InflectedRoute');
    }
);
