<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 05.07.18
 * Time: 15:11
 */


if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../bin/cake migrations migrate');
    echo "<br>";
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p UrlRewrite');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p Ebay');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p AclManager');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p Dashboard');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p EbayCheckout');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p Feeder');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p ItoolCustomer');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p ZipData');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p ADmad/SocialAuth');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p HelpDesk');
    echo "<br>";
    echo exec('../bin/cake migrations migrate -p VisitManager');
    echo "<br>";
    echo exec('../bin/cake acl_extras aco_sync');
    echo "<br>";
    if (!empty($_GET['cache']) && $_GET['cache'] == 'clear') {
        /**
         * Don't run cache clear_all to avoid of truncate user sessions stored in Redis cache (session_cache)
         */
        echo exec('../bin/cake cache clear default');
        echo exec('../bin/cake cache clear _cake_core_');
        echo exec('../bin/cake cache clear _cake_model_');
        echo exec('../bin/cake cache clear _cake_routes_');
        echo exec('../bin/cake cache clear acl_permissions');
        echo exec('../bin/cake cache clear short_term_cache');
        echo exec('../bin/cake cache clear medium_term_cache');
        echo exec('../bin/cake cache clear long_term_cache');
        echo exec('../bin/cake cache clear feeder_product_cache');
        echo exec('../bin/cake cache clear feeder_browse_cache');
        echo exec('../bin/cake cache clear url_rewrite_cache');
    }
}
