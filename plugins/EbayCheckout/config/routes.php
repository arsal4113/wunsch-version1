<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'EbayCheckout',
    ['path' => '/checkout'],
    function (RouteBuilder $routes) {
        $routes->connect(
            '/:uuid/session',
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/session/:action',
            [
                'controller' => 'EbayCheckoutSessions',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/session/deleteItem/:itemId',
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'deleteItem',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/session/undeleteItem/:itemId',
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'undeleteItem',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/session/removeItem/:itemId',
            [
                'controller' => 'EbayCheckoutSessions',
                'action' => 'removeItem',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/view/:itemId',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/view/:itemId/:countryCode',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/view/:itemId/:countryCode/:ebayGlobalId',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/view/:itemId/:countryCode/:ebayGlobalId/:widgetType',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/view/:itemId/:countryCode/:ebayGlobalId/:widgetType/:wrapperLayout',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'view',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/description/:itemId',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'description',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/description/:itemId/:countryCode',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'description',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect(
            '/:uuid/product/description/:itemId/:countryCode/:ebayGlobalId',
            [
                'controller' => 'EbayCheckoutItems',
                'action' => 'description',
                'plugin' => 'EbayCheckout'
            ]
        );

        $routes->connect('/:uuid/cart', [
            'controller' => 'EbayCheckoutSessions',
            'action' => 'cart',
            'plugin' => 'EbayCheckout'
        ]);

        $routes->fallbacks(DashedRoute::class);
    }
);
