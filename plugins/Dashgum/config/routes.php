<?php
use Cake\Routing\Router;

Router::plugin('Dashgum', function ($routes) {
    $routes->fallbacks();
});
