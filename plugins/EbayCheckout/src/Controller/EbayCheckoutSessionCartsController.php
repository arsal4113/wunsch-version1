<?php

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 12.07.18
 * Time: 10:05
 */

namespace EbayCheckout\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * Class EbayCheckoutSessionCartsController
 * @package EbayCheckout\Controller
 */
class EbayCheckoutSessionCartsController extends AppController
{
    /**
     * initialize
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'mini',
            'full',
            'items'
        ]);
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     * @return null|void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $theme = Configure::read('ebayCheckout.theme', null) ?? 'EbayCheckout';
        $this->viewBuilder()->setTheme($theme);
    }

    /**
     * mini
     */
    public function mini()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * full
     */
    public function full()
    {
        $this->viewBuilder()->setLayout('ajax');
    }
}
