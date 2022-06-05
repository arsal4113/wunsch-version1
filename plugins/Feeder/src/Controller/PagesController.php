<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 16.03.18
 * Time: 09:18
 */

namespace Feeder\Controller;


use Cake\Core\Configure;
use Cake\Event\Event;

class PagesController extends \App\Controller\PagesController
{

    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'Feeder';
        $this->viewBuilder()->setTheme($theme);
        $this->viewBuilder()->setHelpers(['Feeder.Feeder']);
        $this->set('feederPageDisplay', true);
        $this->set('feederHomepage', $this->FeederHomepages->get(1));
    }

}
