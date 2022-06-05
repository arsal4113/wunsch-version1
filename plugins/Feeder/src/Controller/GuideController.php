<?php
/**
 * Created by PhpStorm.
 * User: gero
 * Date: 19.03.19
 * Time: 10:49
 */

namespace Feeder\Controller;

use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\I18n\Number;
use Cake\Routing\Router;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;

/**
 * FeederGuide Controller
 *
 * @property \Feeder\Model\Table\FeederGuidesTable $FeederGuides
 */
class GuideController extends AppController
{
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \App\Controller\empty|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'index',
        ]);
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
    }

    public function index($id = null)
    {
        $this->loadModel('Feeder.FeederGuides');
        try {
            if(isset($id)){
                $feederGuide = $this->FeederGuides->get($id, ['contain' => ['FeederCategories', 'FeederPillarPages']]);
            }else{
                $feederGuide = $this->FeederGuides->find("all")->orderAsc("id")->first();
            }
        } catch (RecordNotFoundException $e) {
            $feederGuide = $this->FeederGuides->newEntity();
        }
        $this->set('guide', $feederGuide);
    }
}
