<?php
use Cake\Routing\Router;

Router::plugin(
    'Inspiria',
    ['path' => '/inspiria'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
