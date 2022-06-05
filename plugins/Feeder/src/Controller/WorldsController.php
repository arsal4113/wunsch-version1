<?php

namespace Feeder\Controller;

use App\Model\Table\CoreConfigurationsTable;
use App\Model\Table\CoreSellersTable;
use Cake\Core\Configure;
use Cake\Event\Event;

/**
 * FeederWorlds Controller
 *
 * @property \Feeder\Model\Table\FeederWorldsTable $FeederWorlds
 * @property CoreConfigurationsTable $CoreConfigurations
 * @property CoreSellersTable $CoreSellers
 *
 * @method \Feeder\Model\Entity\FeederWorld[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorldsController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    protected $images = [
        'image' => 'feeder_worlds' . DS . 'image' . DS
    ];

    const CONFIG_GROUP = 'FeederWorlds';
    const HEADER_IMAGE_CONFIG_PATH = 'header/image';
    const HEADLINE_CONFIG_PATH = 'worlds/headline';
    const META_TITLE_CONFIG_PATH = 'worlds/metaTitle';
    const META_DESCRIPTION_CONFIG_PATH = 'worlds/metaDescription';

    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     *
     *
     * @param Event $event
     * @return \App\Controller\empty|void
     */
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
        $this->Auth->allow(['view']);
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
        $this->set('feederHomepage', $this->FeederHomepages->get(1));
    }

    /**
     * Index method
     *
     * @return void
     */
    public function view()
    {
        $this->loadModel('CoreConfigurations');
        $this->loadModel('Feeder.FeederWorlds');
        $uuid = Configure::read('dealsguru.uuid', false);
        $headerImage = null;
        $headline = null;
        $metaTitle = null;
        $metaDescription = null;
        if ($uuid) {
            $this->loadModel('CoreSellers');
            $coreSeller = $this->CoreSellers->find('all')->where(['uuid' => $uuid])->first();
            $headerImage = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::HEADER_IMAGE_CONFIG_PATH, null);
            $headline = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::HEADLINE_CONFIG_PATH, null);
            $metaTitle = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::META_TITLE_CONFIG_PATH, null);
            $metaDescription = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::META_DESCRIPTION_CONFIG_PATH, null);
        }
        $feederWorlds = $this->FeederWorlds->find('all')->orderAsc('sort_order');
        $feederWorldFirst = [];
        $feederWorldSecond = [];
        $feederWorldThird = [];
        if ($feederWorlds) {
            foreach($feederWorlds as $key => $feederWorld) {
                $offset = $key % 3;
                if ($offset == 0) {
                    $feederWorldFirst[] = $feederWorld;
                }
                if ($offset == 1) {
                    $feederWorldSecond[] = $feederWorld;
                }
                if ($offset == 2) {
                    $feederWorldThird[] = $feederWorld;
                }
            }
        }

        $this->set('headerImage', $headerImage);
        $this->set('headline', $headline);
        $this->set('metaTitle', $metaTitle);
        $this->set('metaDescription', $metaDescription);
        $this->set('feederWorldFirst', $feederWorldFirst);
        $this->set('feederWorldSecond', $feederWorldSecond);
        $this->set('feederWorldThird', $feederWorldThird);
        $this->set('_serialize', ['feederWorlds']);
    }
}
