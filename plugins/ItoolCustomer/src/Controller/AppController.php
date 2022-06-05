<?php

namespace ItoolCustomer\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function initialize()
    {
        if(!isset($this->isFrontend)) {
            $this->isFrontend = true;
        }
        parent::initialize();
//        $this->loadComponent('Csrf'); For login task 1183
    }

    /**
     * @param Event $event
     * @return null
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'Feeder';
        $this->viewBuilder()->setTheme($theme);
        if ($this->request->is('ajax')) {
            $this->set('isAjax', true);
        } else {
            $this->set('isAjax', false);
        }
    }
}
