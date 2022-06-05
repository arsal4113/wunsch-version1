<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'ItoolCustomer',
    ['path' => '/customer'],
    function (RouteBuilder $routes) {
        $routes->connect('/login', ['controller' => 'Login', 'action' => 'login']);
        $routes->connect('/login/:redirect', ['controller' => 'Login', 'action' => 'login'], ['pass' => ['redirect']]);
        $routes->connect('/navigation', ['controller' => 'Login', 'action' => 'navigation']);
        $routes->connect('/logout', ['controller' => 'Login', 'action' => 'logout']);
        $routes->connect('/login/success', ['controller' => 'Login', 'action' => 'success']);
        $routes->connect('/reset-password', ['controller' => 'Login', 'action' => 'resetPassword']);
        $routes->connect('/reset-password/submitted', ['controller' => 'Login', 'action' => 'resetPasswordSubmitted']);
        $routes->connect('/reset-password/change/:token', ['controller' => 'Login', 'action' => 'resetPasswordChange'], ['pass' => ['token']]);
        $routes->connect('/change-password', ['controller' => 'Login', 'action' => 'changePassword']);
        $routes->connect('/registration', ['controller' => 'Registration', 'action' => 'create']);
        $routes->connect('/registration/resend', ['controller' => 'Registration', 'action' => 'resend']);
        $routes->connect('/registration/activate/:token', ['controller' => 'Registration', 'action' => 'activate'], ['pass' => ['token']]);
        $routes->connect('/account/orders', ['controller' => 'Account', 'action' => 'orders']);
        $routes->connect('/account/order-view', ['controller' => 'Account', 'action' => 'orderView']);
        $routes->connect('/account/order-view/:id', ['controller' => 'Account', 'action' => 'orderView'], ['pass' => ['id']]);
        $routes->connect('/account/wishlist', ['controller' => 'Account', 'action' => 'wishlist']);
        $routes->connect('/account/wishlist/add', ['controller' => 'Account', 'action' => 'wishlistAdd']);
        $routes->connect('/account/wishlist/add/:ebayItemId', ['controller' => 'Account', 'action' => 'wishlistAdd'], ['pass' => ['ebayItemId']]);
        $routes->connect('/account/wishlist/remove', ['controller' => 'Account', 'action' => 'wishlistRemove']);
        $routes->connect('/account/wishlist/remove/:ebayItemId', ['controller' => 'Account', 'action' => 'wishlistRemove'], ['pass' => ['ebayItemId']]);
        $routes->connect('/account/edit', ['controller' => 'Account', 'action' => 'edit']);
        $routes->connect('/account/interests', ['controller' => 'Account', 'action' => 'interests']);
        $routes->connect('/account/interests/:new', ['controller' => 'Account', 'action' => 'interests'], ['pass' => ['new']]);
        $routes->connect('/account/saveinterests', ['controller' => 'Account', 'action' => 'saveInterests']);
        $routes->connect('/account/my-interests', ['controller' => 'Account', 'action' => 'interestsView']);
        $routes->connect('/newsletter/subscribe', ['controller' => 'Newsletter', 'action' => 'subscribe']);
        $routes->connect('/newsletter/optin-confirmed', ['controller' => 'Newsletter', 'action' => 'optInConfirmed']);
        $routes->connect('/newsletter/sign-up-successful', ['controller' => 'Newsletter', 'action' => 'signUpSuccessful']);
        $routes->connect('/newsletter/unsubscribe/:email', ['controller' => 'Newsletter', 'action' => 'unsubscribe'], ['pass' => ['email']]);
        $routes->connect('/newsletter/change-subscription', ['controller' => 'Newsletter', 'action' => 'changeSubscription']);
        $routes->connect('/newsletter/export', ['controller' => 'NewsletterBackend', 'action' => 'export']);
        $routes->connect('/newsletter/test-template/:filename', ['controller' => 'Newsletter', 'action' => 'testTemplate'], ['pass' => ['filename']]);
        $routes->connect('/account/delete', ['controller' => 'Account', 'action' => 'delete']);
        $routes->connect('/customers', ['controller' => 'Customers', 'action' => 'index']);
        $routes->connect('/customers/view/:id', ['controller' => 'Customers', 'action' => 'view'], ['pass' => ['id']]);
        $routes->connect('/customers/delete/:id', ['controller' => 'Customers', 'action' => 'delete'], ['pass' => ['id']]);
        $routes->connect('/wishlist-settings/index', ['controller' => 'CustomerWishlistConfiguration', 'action' => 'index']);
        $routes->connect('/wishlist-settings', ['controller' => 'CustomerWishlistConfiguration', 'action' => 'configure']);
        $routes->connect('/customers/download', ['controller' => 'Customers', 'action' => 'download']);
        $routes->connect('/exclude-customers', ['controller' => 'ExcludeCustomers', 'action' => 'uploadCustomersFile']);
    }
);
