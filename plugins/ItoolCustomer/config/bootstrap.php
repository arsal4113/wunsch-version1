<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \ItoolCustomer\Event\AppEvents());
