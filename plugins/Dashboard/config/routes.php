<?php
use Cake\Routing\Router;

Router::plugin(
    'Dashboard',
    ['path' => '/dashboard'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
