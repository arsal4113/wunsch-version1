<?php

namespace Sitemap\Controller;

use Cake\Event\Event;
use Feeder\Model\Table\FeederPillarPagesTable;

/**
 * Class SitemapsController
 * @package Sitemaps\Controller
 * @property FeederPillarPagesTable $FeederPillarPages
 */
class SitemapsController extends AppController
{
    /**
     * @param Event $event
     * @return \App\Controller\empty|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'view'
        ]);
    }

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * view
     */
    public function view()
    {
        $this->RequestHandler->respondAs('xml');

        $this->loadModel('Feeder.FeederCategories');
        $this->loadModel('Feeder.FeederPillarPages');

        $this->set('categories', $this->FeederCategories->find('all'));
        $this->set('pillarPages', $this->FeederPillarPages->find('all'));
    }
}
