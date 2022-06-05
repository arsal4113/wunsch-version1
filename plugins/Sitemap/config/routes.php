<?php

namespace Sitemap\Controller;

use Cake\Routing\Router;

Router::plugin(
    'Sitemap',
    ['path' => '/'],
    function ($routes) {
        $routes->extensions(['xml']);
        $routes->connect('/sitemap', ['controller' => 'Sitemaps', 'action' => 'view', 'Plugin' => 'Sitemap']);
    }
);
