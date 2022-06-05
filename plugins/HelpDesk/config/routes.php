<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'HelpDesk',
    ['path' => '/help-desk'],
    function (RouteBuilder $routes) {
        $routes->connect('/help', ['controller' => 'Helps', 'action' => 'view']);
        $routes->fallbacks(DashedRoute::class);
    }
);
