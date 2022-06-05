<?php

namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Router;

/**
 * Class Application
 * @package App
 */
class Application extends BaseApplication
{
    const SHORT_TERM_CACHE = 'short_term_cache';
    const MEDIUM_TERM_CACHE = 'medium_term_cache';
    const LONG_TERM_CACHE = 'long_term_cache';
    const DB_QUERY_CACHE_GROUP = 'db_query_cache';
    const USER_CACHE_KEY_INIT_CHECKOUT_SESSION = 'init_checkout_session';
    const USER_CACHE_KEY_CART_USER_DELETED_ITEMS = 'cart_user_deleted_items';
    const USER_CACHE_KEY_CART_USER_ITEMS = 'cart_user_items';
    const USER_CACHE_KEY_CUSTOMER_ADDRESS = 'customer_address';

    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        $this->addPlugin('Inspiria', ['bootstrap' => false, 'routes' => true]);
        $this->addPlugin('Acl', ['bootstrap' => true]);
        $this->addPlugin('AclManager', ['bootstrap' => false, 'routes' => true]);
        $this->addPlugin('Ebay', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('Ajax', ['bootstrap' => true]);
        $this->addPlugin('Dashboard', ['bootstrap' => false, 'routes' => true]);
        $this->addPlugin('Dashgum', ['bootstrap' => false, 'routes' => true]);
        $this->addPlugin('EbayCheckout', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('Feeder', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('Assets', ['bootstrap' => true, 'routes' => false]);
        $this->addPlugin('Sitemap', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('UrlRewrite', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('ItoolCustomer', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('ADmad/SocialAuth', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('ZipData', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('HelpDesk', ['bootstrap' => true, 'routes' => true]);
        $this->addPlugin('VisitManager', ['bootstrap' => false, 'routes' => true]);
        $this->addPlugin('CatchTheme');
        $this->addPlugin('Migrations');

        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        } else {
            $this->addPlugin('CakeCaptcha', ['routes' => true]);
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin(\DebugKit\Plugin::class);
        }
        // Load more plugins here
    }

    /**
     * @return void
     */
    protected function bootstrapCli()
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }
        try {
            $this->addPlugin('Migrations');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }
        try {
            $this->addPlugin('Inspiria', ['bootstrap' => false, 'routes' => true]);
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }
        // Load more plugins here
    }

    /**
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(ErrorHandlerMiddleware::class)

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(AssetMiddleware::class)

            // Add routing middleware.
            // Routes collection cache enabled by default, to disable route caching
            // pass null as cacheConfig, example: `new RoutingMiddleware($this)`
            // you might want to disable this cache in case your routing is extremely simple
            ->add(new RoutingMiddleware($this, '_cake_routes_'));

        // Be sure to add SocialAuthMiddleware after RoutingMiddleware
        $middlewareQueue->add(new \ADmad\SocialAuth\Middleware\SocialAuthMiddleware([
            // Request method type use to initiate authentication.
            'requestMethod' => 'GET',
            // Login page URL. In case of auth failure user is redirected to login
            // page with "error" query string var.
            'loginUrl' => '/customer/login',
            // URL to redirect to after authentication (string or array).
            //'loginRedirect' => Router::Url(['controller' => 'Account', 'action' => 'edit', 'plugin' => 'ItoolCustomer']),
            // Boolean indicating whether user identity should be returned as entity.
            'userEntity' => true,
            // User model.
            'userModel' => 'ItoolCustomer.Customers',
            // Social profile model.
            'profileModel' => 'ItoolCustomer.SocialProfiles',
            // Finder type.
            'finder' => 'all',
            // Fields.
            'fields' => [
                'password' => 'password',
            ],
            // Session key to which to write identity record to.
            'sessionKey' => 'Auth.Customer',
            // The method in user model which should be called in case of new user.
            // It should return a User entity.
            'getUserCallback' => 'getUser',
            // SocialConnect Auth service's providers config. https://github.com/SocialConnect/auth/blob/master/README.md
            'serviceConfig' => [
                'provider' => [
                    'facebook' => [
                        'applicationId' => '333046720764660',
                        'applicationSecret' => 'f16db3550f01c599de1397b452fe0cea',
                        'scope' => [
                            'email',
                        ],
                        'fields' => [
                            'email', 'first_name', 'last_name'
                            // To get a full list of all possible values, refer to
                            // https://developers.facebook.com/docs/graph-api/reference/user
                        ],
                    ],
                    'twitter' => [
                        'applicationId' => 'rnthiCdbv4ylv00qyHS3pzPr5',
                        'applicationSecret' => '1XHaQOi52mkPBEJ2HDJpLb8rdywzp7JYjI4m0IghRK1RNNWMzH',
                        'scope' => [
                            'email',
                        ],
                    ],
                    'google' => [
                        'applicationId' => '1027683702275-0fg0n5mtl58fk1fhcc8id2io1kompdf2.apps.googleusercontent.com',
                        'applicationSecret' => 'VByYKEIoUqPG2mYXEvubyNG1',
                        'scope' => [
                            'https://www.googleapis.com/auth/userinfo.email',
                            'https://www.googleapis.com/auth/userinfo.profile',
                        ],
                    ],
                    'instagram' => [
                        'applicationId' => '150d5b5af5954b74b44f96f26f60f2c8',
                        'applicationSecret' => '18c5cb1440c1472596d88cdb941622b5',
                        'scope' => [
                            'basic',
                        ],
                    ],
                    'slack' => [
                        'applicationId' => '449342919121.449773701700',
                        'applicationSecret' => '58b746f1ae2f904523408afccb921d14',
                        'scope' => [
                            'identity.basic', 'identity.email',
                        ],
                    ],
                    'twitch' => [
                        'applicationId' => '2kb80eqdds6y3aqa337qdqbescbcvm',
                        'applicationSecret' => '5sms19ly09diw43dgt8iyw97y3onip',
                        'scope' => [
                            'user_read',
                        ],
                    ],
                    'linkedin' => [
                        'applicationId' => '86yhhhekohp1yf',
                        'applicationSecret' => 'LL6C3NEDTHmqIIuU',
                    ],
                    'microsoft' => [
                        'applicationId' => '66d9acd5-326e-4838-9186-cc56c8e602bf',
                        'applicationSecret' => 'uuetzzBVKC29@_wKME830|!',
                        'scope' => [
                            #'https://graph.microsoft.com/.default',
                            'wl.basic', 'wl.emails'
                        ],
                    ],
                ],
            ],
            // If you want to use CURL instead of CakePHP's Http Client set this to
            // '\SocialConnect\Common\Http\Client\Curl' or another client instance that
            // SocialConnect/Auth's Service class accepts.
            'httpClient' => '\ADmad\SocialAuth\Http\Client',
            // Whether social connect errors should be logged. Default `true`.
            'logErrors' => true,
        ]));

        return $middlewareQueue;
    }
}
