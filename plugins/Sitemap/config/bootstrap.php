<?php

use Cake\Event\EventManager;
use Sitemap\Event\AppEvents;

EventManager::instance()->on(new AppEvents());
