<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \Feeder\Event\AppEvents());
EventManager::instance()->on(new \Feeder\Event\FeederCategoryListener());
EventManager::instance()->on(new \Feeder\Event\FeederPillarPageListener());
EventManager::instance()->on(new \Feeder\Event\FeederGuideListener());
EventManager::instance()->on(new \Feeder\Event\FeederQuizListener());
EventManager::instance()->on(new \Feeder\Event\FeederInfluencerListener());
