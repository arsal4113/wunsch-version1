<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \HelpDesk\Event\AppEvents());