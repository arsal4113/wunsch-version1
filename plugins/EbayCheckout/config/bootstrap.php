<?php

use Cake\Event\EventManager;

EventManager::instance()->on(new \EbayCheckout\Event\AppEvents());
EventManager::instance()->on(new \EbayCheckout\Event\CheckoutSuccessListener());
