<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \Ebay\Event\AppEvents());
