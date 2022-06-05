<?php

use App\Application;

return [
    /**
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */

    'maintenance' => [
        'status' => false,
        'controller' => 'maintenances',
        'action' => 'index',
        'plugin' => false
    ],
    'debug' => (getenv('DEBUG') !== false) ? getenv('DEBUG') : false,
    'defaultLanguageCode' => (getenv('DEFAULT_LANGUAGE_CODE') !== false) ? getenv('DEFAULT_LANGUAGE_CODE') : 'en',
    'useRegisterCaptcha' => false,
    'eBayItemDescriptionBackup' => true,
    'eBayFashionCheckout' => false,
    'showFeatureInfoBox' => false,
    'forceSSL' => (getenv('FORCE_SSL') !== false) ? getenv('FORCE_SSL') : false,
    /**
     * Configure basic information about the application.
     *
     * - namespace - The namespace to find app classes under.
     * - encoding - The encoding used for HTML + database connections.
     * - base - The base directory the app resides in. If false this
     *   will be auto detected.
     * - dir - Name of app directory.
     * - webroot - The webroot directory.
     * - wwwRoot - The file path to webroot.
     * - baseUrl - To configure CakePHP to *not* use mod_rewrite and to
     *   use CakePHP pretty URLs, remove these .htaccess
     *   files:
     *      /.htaccess
     *      /webroot/.htaccess
     *   And uncomment the baseUrl key below.
     * - fullBaseUrl - A base URL to use for absolute links.
     * - imageBaseUrl - Web path to the public images directory under webroot.
     * - cssBaseUrl - Web path to the public css directory under webroot.
     * - jsBaseUrl - Web path to the public js directory under webroot.
     * - paths - Configure paths for non class based resources. Supports the
     *   `plugins`, `templates`, `locales` subkeys, which allow the definition of
     *   paths for plugins, view templates and locale files respectively.
     */
    'App' => [
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        // 'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],
    /**
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => (getenv('SALT') !== false) ? getenv('SALT') : '__SALT__',
    ],
    /**
     * Apply timestamps with the last modified time to static assets (js, css, images).
     * Will append a querystring parameter containing the time the file was modified.
     * This is useful for busting browser caches.
     *
     * Set to true to apply timestamps when debug is true. Set to 'force' to always
     * enable timestamping regardless of debug value.
     */
    'Asset' => [
        // 'timestamp' => true,
    ],
    /**
     * Configure the cache adapters.
     */
    'Cache' => [
        'default' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'path' => CACHE,
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
            'prefix' => getenv('GAE_VERSION')
        ],
        /**
         * Configure the cache used for general framework caching. Path information,
         * object listings, and translation cache files are stored with this
         * configuration.
         */
        '_cake_core_' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            #'className' => 'File',
            'prefix' => getenv('GAE_VERSION') . '_core_',
            'path' => CACHE . 'persistent/',
            'serialize' => true,
            'duration' => '+1 day',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
        ],
        /**
         * Configure the cache for model and datasource caches. This cache
         * configuration is used to store schema descriptions, and table listings
         * in connections.
         */
        '_cake_model_' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => getenv('GAE_VERSION') . '_model_',
            'path' => CACHE . 'models/',
            'serialize' => true,
            'duration' => '+1 day',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
        ],
        '_cake_routes_' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
           # 'className' => 'File',
            'prefix' => getenv('GAE_VERSION') . '_routes_',
            'path' => CACHE,
            'serialize' => true,
            'duration' => '+1 years',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
        ],
        'acl_permissions' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => 'acl_permissions_',
            'path' => CACHE . 'persistent/',
            'duration' => (getenv('CACHE_ACL_PERMISSIONS_CACHE_DURATION') !== false) ? getenv('CACHE_ACL_PERMISSIONS_CACHE_DURATION') : '+1 month',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
        ],
        Application::SHORT_TERM_CACHE => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => getenv('GAE_VERSION') . 'short_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_SHORT_TERM_CACHE_DURATION') !== false) ? getenv('CACHE_SHORT_TERM_CACHE_DURATION') : '+1 hour',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
            'groups' => [Application::DB_QUERY_CACHE_GROUP]
        ],
        Application::MEDIUM_TERM_CACHE => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => getenv('GAE_VERSION') . 'medium_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_MEDIUM_TERM_CACHE_DURATION') !== false) ? getenv('CACHE_MEDIUM_TERM_CACHE_DURATION') : '+1 day',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
            'groups' => [Application::DB_QUERY_CACHE_GROUP]
        ],
        Application::LONG_TERM_CACHE => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => getenv('GAE_VERSION') . 'long_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_LONG_TERM_CACHE_DURATION') !== false) ? getenv('CACHE_LONG_TERM_CACHE_DURATION') : '+1 month',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
            'groups' => [Application::DB_QUERY_CACHE_GROUP]
        ],
        'feeder_product_cache' => [
            'className' => (getenv('PRODUCT_CACHE_CLASS_NAME') !== false) ? getenv('PRODUCT_CACHE_CLASS_NAME') : 'File',
            'prefix' => 'feeder_product_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_FEEDER_PRODUCT_CACHE_DURATION') !== false) ? getenv('CACHE_FEEDER_PRODUCT_CACHE_DURATION') : '+2 hours',
            'server' => (getenv('PRODUCT_CACHE_HOST') !== false) ? getenv('PRODUCT_CACHE_HOST') : null,
            'groups' => ['feeder_product_cache']
        ],
        'feeder_browse_cache' => [
            'className' => (getenv('CACHE_CLASS_NAME') !== false) ? getenv('CACHE_CLASS_NAME') : 'File',
            'prefix' => 'feeder_browse_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_FEEDER_BROWSE_CACHE_DURATION') !== false) ? getenv('CACHE_FEEDER_BROWSE_CACHE_DURATION') : '+1 hour',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null,
            'groups' => ['feeder_browse_cache']
        ],
        'url_rewrite_cache' => [
            'className' => 'File',
            'prefix' => getenv('GAE_VERSION') . 'url_rewrite_cache_',
            'path' => CACHE . 'persistent' . DS,
            'duration' => (getenv('CACHE_CATEGORY_ROUTING_CACHE_DURATION') !== false) ? getenv('CACHE_CATEGORY_ROUTING_CACHE_DURATION') : '+4 hours',
            'server' => (getenv('CACHE_HOST') !== false) ? getenv('CACHE_HOST') : null
        ],
        'session_cache' => [
            'className' => (getenv('SESSION_CACHE_CLASS') !== false) ? getenv('SESSION_CACHE_CLASS') : 'File',
            'prefix' => 'session_',
            'duration' => '+30 days',
            'server' => (getenv('SESSION_CACHE_HOST') !== false) ? getenv('SESSION_CACHE_HOST') : null
        ]
    ],
    /**
     * Configure the Error and Exception handlers used by your application.
     *
     * By default errors are displayed using Debugger, when debug is true and logged
     * by Cake\Log\Log when debug is false.
     *
     * In CLI environments exceptions will be printed to stderr with a backtrace.
     * In web environments an HTML page will be displayed for the exception.
     * With debug true, framework errors like Missing Controller will be displayed.
     * When debug is false, framework errors will be coerced into generic HTTP errors.
     *
     * Options:
     *
     * - `errorLevel` - int - The level of errors you are interested in capturing.
     * - `trace` - boolean - Whether or not backtraces should be included in
     *   logged errors/exceptions.
     * - `log` - boolean - Whether or not you want exceptions logged.
     * - `exceptionRenderer` - string - The class responsible for rendering
     *   uncaught exceptions.  If you choose a custom class you should place
     *   the file for that class in src/Error. This class needs to implement a
     *   render method.
     * - `skipLog` - array - List of exceptions to skip for logging. Exceptions that
     *   extend one of the listed exceptions will also be skipped for logging.
     *   E.g.:
     *   `'skipLog' => ['Cake\Network\Exception\NotFoundException', 'Cake\Network\Exception\UnauthorizedException']`
     */
    'Error' => [
        'errorLevel' => E_ALL & ~E_USER_DEPRECATED,
        'exceptionRenderer' => 'CatchTheme\Error\AppExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,
    ],
    /**
     * Email configuration.
     *
     * You can configure email transports and email delivery profiles here.
     *
     * By defining transports separately from delivery profiles you can easily
     * re-use transport configuration across multiple profiles.
     *
     * You can specify multiple configurations for production, development and
     * testing.
     *
     * ### Configuring transports
     *
     * Each transport needs a `className`. Valid options are as follows:
     *
     *  Mail   - Send using PHP mail function
     *  Smtp   - Send using SMTP
     *  Debug  - Do not send the email, just return the result
     *
     * You can add custom transports (or override existing transports) by adding the
     * appropriate file to src/Network/Email.  Transports should be named
     * 'YourTransport.php', where 'Your' is the name of the transport.
     *
     * ### Configuring delivery profiles
     *
     * Delivery profiles allow you to predefine various properties about email
     * messages from your application and give the settings a name. This saves
     * duplication across your application and makes maintenance and development
     * easier. Each profile accepts a number of keys. See `Cake\Network\Email\Email`
     * for more information.
     */
    'EmailTransport' => [
        'default' => [
            'className' => 'Smtp',
            // The following keys are used in SMTP transports
            'host' => (getenv('SMTP_HOST') !== false) ? getenv('SMTP_HOST') : 'smtp.strato.de',
            'port' => (getenv('SMTP_PORT') !== false) ? getenv('SMTP_PORT') : 587,
            'timeout' => (getenv('SMTP_TIMEOUT') !== false) ? getenv('SMTP_TIMEOUT') : 30,
            'username' => (getenv('SMTP_USERNAME') !== false) ? getenv('SMTP_USERNAME') : 'itooladmin@i-ways.de',
            'password' => (getenv('SMTP_PASSWORD') !== false) ? getenv('SMTP_PASSWORD') : 'QU/Vm7FVgrBH',
        ],
    ],
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => ['no-reply@mail.catch.app' => 'Catch by eBay'],
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],
    /**
     * Connection information used by the ORM to connect
     * to your application's datastores.
     * Drivers include Mysql Postgres Sqlite Sqlserver
     * See vendor\cakephp\cakephp\src\Database\Driver for complete list
     */
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => (getenv('DB_HOST') !== false) ? getenv('DB_HOST') : null,
            /**
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            'port' => (getenv('DB_PORT') !== false) ? getenv('DB_PORT') : null,
            'username' => (getenv('DB_USERNAME') !== false) ? getenv('DB_USERNAME') : null,
            'password' => (getenv('DB_PASSWORD') !== false) ? getenv('DB_PASSWORD') : null,
            'database' => (getenv('DB_NAME') !== false) ? getenv('DB_NAME') : null,
            'unix_socket' => (getenv('DB_SOCKET') !== false) ? getenv('DB_SOCKET') : null,
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            /**
             * Set identifier quoting to true if you are using reserved words or
             * special characters in your table or column names. Enabling this
             * setting will result in queries built using the Query Builder having
             * identifiers quoted when creating SQL. It should be noted that this
             * decreases performance because each query needs to be traversed and
             * manipulated before being executed.
             */
            'quoteIdentifiers' => false,
            /**
             * During development, if using MySQL < 5.6, uncommenting the
             * following line could boost the speed at which schema metadata is
             * fetched from the database. It can also be set directly with the
             * mysql configuration directive 'innodb_stats_on_metadata = 0'
             * which is the recommended value in production environments
             */
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
        /**
         * The test connection is used during the test suite.
         */
        'test' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            //'port' => 'nonstandard_port_number',
            'username' => 'my_app',
            'password' => 'secret',
            'database' => 'test_myapp',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
    ],
    /**
     * Configures logging options
     */
    'Log' => [
        'debug' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
        'ebay_api' => [
            'className' => 'Cake\Log\Engine\FileLog',
            'path' => LOGS,
            'file' => 'ebay_api.log',
            'levels' => [],
            'scopes' => ['ebay_api']
        ]
    ],
    /**
     *
     * Session configuration.
     *
     * Contains an array of settings to use for session configuration. The
     * `defaults` key is used to define a default preset to use for sessions, any
     * settings declared here will override the settings of the default config.
     *
     * ## Options
     *
     * - `cookie` - The name of the cookie to use. Defaults to 'CAKEPHP'.
     * - `cookiePath` - The url path for which session cookie is set. Maps to the
     *   `session.cookie_path` php.ini config. Defaults to base path of app.
     * - `timeout` - The time in minutes the session should be valid for.
     *    Pass 0 to disable checking timeout.
     * - `defaults` - The default configuration set to use as a basis for your session.
     *    There are four built-in options: php, cake, cache, database.
     * - `handler` - Can be used to enable a custom session handler. Expects an
     *    array with at least the `engine` key, being the name of the Session engine
     *    class to use for managing the session. CakePHP bundles the `CacheSession`
     *    and `DatabaseSession` engines.
     * - `ini` - An associative array of additional ini values to set.
     *
     * The built-in `defaults` options are:
     *
     * - 'php' - Uses settings defined in your php.ini.
     * - 'cake' - Saves session files in CakePHP's /tmp directory.
     * - 'database' - Uses CakePHP's database sessions.
     * - 'cache' - Use the Cache class to save sessions.
     *
     * To define a custom session handler, save it at src/Network/Session/<name>.php.
     * Make sure the class implements PHP's `SessionHandlerInterface` and set
     * Session.handler to <name>
     *
     * To use database sessions, load the SQL file located at config/Schema/sessions.sql
     */
    'Session' => [
        #'defaults' => (getenv('SESSION_HANDLER') !== false) ? getenv('SESSION_HANDLER') : 'php',
        #'timeout' => (getenv('SESSION_TIMEOUT') !== false) ? getenv('SESSION_TIMEOUT') : 1440,
        'ini' => [
            'session.use_trans_sid' => 0,
            'session.use_cookies' => 1,
            'session.save_handler' => 'user',
        ],
        'handler' => [
            'engine' => (getenv('SESSION_HANDLER') !== false) ? getenv('SESSION_HANDLER') : 'CacheSession',
            'config' => 'session_cache'
        ]
    ],
    'google_cloud' => [
        'cloud_storage' => [
            'is_active' => (getenv('GOOGLE_CLOUD_STORAGE_ENABLED') !== false) ? getenv('GOOGLE_CLOUD_STORAGE_ENABLED') : 0,
            'bucket_name' => (getenv('GOOGLE_BUCKET_NAME') !== false) ? getenv('GOOGLE_BUCKET_NAME') : '',
            'cdn_domain' => (getenv('GOOGLE_CDN_DOMAIN') !== false) ? getenv('GOOGLE_CDN_DOMAIN') : '',
        ]
    ],
    'google_recatpcha_settings' => [
        'site_key' => (getenv('RECEPTCHA_SITE_KEY') !== false) ? getenv('RECEPTCHA_SITE_KEY') : '',
        'secret_key' => (getenv('RECEPTCHA_SECRET_KEY') !== false) ? getenv('RECEPTCHA_SECRET_KEY') : '',
    ],
    'googleMapsApi' => [
        'apiKey' => (getenv('GOOGLE_MAPS_API_KEY') !== false) ? getenv('GOOGLE_MAPS_API_KEY') : '',
    ],
    'dealsguru' => [
        'mode' => (getenv('DEALSGURU_MODE') !== false) ? getenv('DEALSGURU_MODE') : 'live',
        'ebay' => [
            'live_account_id' => (getenv('DEALSGURU_LIVE_ACCOUNT_ID') !== false) ? getenv('DEALSGURU_LIVE_ACCOUNT_ID') : null,
            'sandbox_account_id' => (getenv('DEALSGURU_SANDBOX_ACCOUNT_ID') !== false) ? getenv('DEALSGURU_SANDBOX_ACCOUNT_ID') : null,
        ],
        'uuid' => (getenv('DEALSGURU_UUID') !== false) ? getenv('DEALSGURU_UUID') : null,
        'cache' => [
            'product' => 'feeder_product_cache',
            'browse' => 'feeder_browse_cache',
        ],
        'static' => [
            'min' => (getenv('DEALSGURU_STATIC_MIN') !== false) ? getenv('DEALSGURU_STATIC_MIN') : true
        ],
        'roverPixel' => [
            'ebayLoginEpnAccountId' => (getenv('EBAY_LOGIN_ROVER_PIXEL_EPN_ACCOUNT_ID') !== false) ? getenv('EBAY_LOGIN_ROVER_PIXEL_EPN_ACCOUNT_ID') : null,
            'ebayLoginEpnCampaignId' => (getenv('EBAY_LOGIN_ROVER_PIXEL_EPN_CAMPAIGN_ID') !== false) ? getenv('EBAY_LOGIN_ROVER_PIXEL_EPN_CAMPAIGN_ID') : null
        ]
    ],
    'disco' => [
        /* SellerUuid*/
        (getenv('DEALSGURU_UUID') !== false) ? getenv('DEALSGURU_UUID') : null => [
            'mode' => (getenv('DEALSGURU_MODE') !== false) ? getenv('DEALSGURU_MODE') : 'live',
            'ebay' => [
                'live_account_id' => (getenv('DEALSGURU_LIVE_ACCOUNT_ID') !== false) ? getenv('DEALSGURU_LIVE_ACCOUNT_ID') : null,
                'sandbox_account_id' => (getenv('DEALSGURU_SANDBOX_ACCOUNT_ID') !== false) ? getenv('DEALSGURU_SANDBOX_ACCOUNT_ID') : null
            ]
        ]
    ],
    'ebayCheckout' => [
        'theme' => (getenv('EBAY_CHECKOUT_THEME') !== false) ? getenv('EBAY_CHECKOUT_THEME') : 'EbayCheckout',
        'cart' => (getenv('EBAY_CHECKOUT_CART') !== false) ? getenv('EBAY_CHECKOUT_CART') : false,
        'enable_checkout' => (getenv('EBAY_CHECKOUT_ENABLE_CHECKOUT') !== false) ? getenv('EBAY_CHECKOUT_ENABLE_CHECKOUT') : false,
        'max_items' => (getenv('EBAY_CHECKOUT_MAX_ITEMS') !== false) ? getenv('EBAY_CHECKOUT_MAX_ITEMS') : 4,
        'max_item_quantity' => (getenv('EBAY_CHECKOUT_MAX_ITEM_QUANTITY') !== false) ? getenv('EBAY_CHECKOUT_MAX_ITEM_QUANTITY') : 10
    ],
    'eis' => [
        'token' => (getenv('EIS_TOKEN') !== false) ? getenv('EIS_TOKEN') : null,
    ],
    'ebayEPN' => [
        'enable_rover' => (getenv('EBAY_EPN_ENABLE_ROVER') !== false) ? getenv('EBAY_EPN_ENABLE_ROVER') : true//,
        //'publisher_id' => (getenv('EBAY_EPN_PUBLISHER_ID') !== false) ? getenv('EBAY_EPN_PUBLISHER_ID') : 5575398383,
        //'campaign_id' => (getenv('EBAY_EPN_CAMPAIGN_ID') !== false) ? getenv('EBAY_EPN_CAMPAIGN_ID') : 5338319675
    ],
    'Catch' => [
        'search_page' => [
            'result_items_count' => (getenv('SEARCH_RESULT_ITEMS_COUNT') !== false) ? getenv('SEARCH_RESULT_ITEMS_COUNT') : 30]
    ],
    'CheckoutSessions' => [
        'fileName' => 'ebay_checkout_session_export.csv',
    ],
    'EisFeedApi' => [
        'token' => getenv('EIS_API_FEED_TOKEN'),
        'endpoint' => getenv('EIS_API_FEED_ENDPOINT'),
        'feeds' => [
            'productVisit' => [
                'feedCode' => getenv('EIS_API_PRODUCT_VISIT_FEED_CODE'),
                'fileName' => getenv('EIS_API_PRODUCT_VISIT_EXPORT_FILE_NAME'),
            ],
            'topSoldItems' => [
                'feedCode' => getenv('EIS_API_TOP_SOLD_ITEMS_CODE'),
                'fileName' => getenv('EIS_API_TOP_SOLD_ITEMS_EXPORT_FILE_NAME'),
            ],
            'checkoutSession' => [
                'feedCode' => getenv('EIS_API_CHECKOUT_SESSION_FEED_CODE'),
                'fileName' => getenv('EIS_API_CHECKOUT_SESSION_EXPORT_FILE_NAME'),
            ],
            'catchCustomerSales' => [
                'feedCode' => getenv('EIS_API_CATCH_CUSTOMER_SALES_FEED_CODE'),
                'fileName' => getenv('EIS_API_CATCH_CUSTOMER_SALES_EXPORT_FILE_NAME'),
            ],
            'registeredCustomersToEbay' => [
                'feedCode' => getenv('EIS_API_REGISTERED_CUSTOMERS'),
                'fileName' => getenv('EIS_API_REGISTERED_CUSTOMERS_EXPORT_FILE_NAME')
            ],
            'subscribedCustomersToEbay' => [
                'feedCode' => getenv('EIS_API_SUBSCRIBED_CUSTOMERS'),
                'fileName' => getenv('EIS_API_SUBSCRIBED_CUSTOMERS_EXPORT_FILE_NAME')
            ]
        ]
    ],
    'Sendgrid' => [
        'apiKey' => getenv('SENDGRID_API_KEY') ?: '',
        'emailValidation' => [
            'apiKey' => ''
        ]
    ]
];
