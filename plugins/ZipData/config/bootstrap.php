<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \ZipData\Event\AppEvents());
