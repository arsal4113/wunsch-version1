<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 09.08.18
 * Time: 15:57
 */

use Cake\Event\EventManager;

EventManager::instance()->on(new \UrlRewrite\Event\AppEvents());
EventManager::instance()->on(new \UrlRewrite\Event\UrlRewriteChangeListener());