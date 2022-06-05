<?php

namespace App\Traits;

use App\Application;
use Cake\Cache\Cache;
use Cake\Http\Session;

/**
 * Trait DbCacheTrait
 * @package App\Traits
 */
trait DbCacheTrait
{
    /**
     * @param $cacheGroup
     */
    public function clearCacheGroup($cacheGroup)
    {
        $configs = Cache::groupConfigs($cacheGroup);
        if (isset($configs[$cacheGroup]) && is_array($configs[$cacheGroup]) && !empty($configs[$cacheGroup])) {
            foreach ($configs[$cacheGroup] as $config) {
                Cache::clearGroup($cacheGroup, $config);
            }
        }
    }

    public function clearUserCache()
    {
        $sessionId = (new Session())->id();

        Cache::delete(Application::USER_CACHE_KEY_INIT_CHECKOUT_SESSION . $sessionId);
        Cache::delete(Application::USER_CACHE_KEY_CART_USER_ITEMS . $sessionId);
        Cache::delete(Application::USER_CACHE_KEY_CART_USER_DELETED_ITEMS . $sessionId);
        Cache::delete(Application::USER_CACHE_KEY_CUSTOMER_ADDRESS . $sessionId);
    }
}
