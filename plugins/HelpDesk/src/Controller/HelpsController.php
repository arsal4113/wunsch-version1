<?php
namespace HelpDesk\Controller;

use App\Model\Table\CoreConfigurationsTable;
use App\Model\Table\CoreSellersTable;
use Cake\Core\Configure;
use Cake\Event\Event;
use HelpDesk\Model\Entity\HelpDeskCategory;
use HelpDesk\Model\Table\HelpDeskCategoriesTable;
use HelpDesk\Model\Entity\HelpDeskFaq;
use HelpDesk\Model\Table\HelpDeskFaqsTable;


/**
 * HelpDeskFaqs Controller
 *
 * @property \HelpDesk\Model\Table\HelpDeskFaqsTable $HelpDeskFaqs
 * @property CoreConfigurationsTable $CoreConfigurations
 * @property CoreSellersTable $CoreSellers
 * @property HelpDeskCategoriesTable $HelpDeskCategories
 * @property HelpDeskFaqsTable $HelpDeskFaq
 *
 * @method \HelpDesk\Model\Entity\HelpDeskFaq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HelpsController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    protected $images = [
        'image' => 'help_desk_faqs' . DS . 'image' . DS
    ];

    const CONFIG_GROUP = 'HelpDeskFaqs';
    const HEADER_IMAGE_CONFIG_PATH = 'header/image';

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
    }

    /**
     * View method
     *
     */
    public function view()
    {
        $this->loadModel('CoreConfigurations');
        $this->loadModel('HelpDesk.HelpDeskFaqs');
        $this->loadModel('HelpDesk.HelpDeskCategories');
        $uuid = Configure::read('dealsguru.uuid', false);
        $headerImage = null;
        if ($uuid) {
            $this->loadModel('CoreSellers');
            $coreSeller = $this->CoreSellers->find('all')->where(['uuid' => $uuid])->first();
            $headerImage = $this->CoreConfigurations->loadSellerConfiguration($coreSeller->id, self::CONFIG_GROUP . '/' . self::HEADER_IMAGE_CONFIG_PATH, null);
        }
        /** @var HelpDeskFaq $helpDeskFaq */
        $helpDeskFaqs = $this->HelpDeskFaqs->find('all')->orderAsc('sort_order');

        /** @var HelpDeskCategory $helpDeskCategory */
        $helpDeskCategories = $this->HelpDeskCategories->find('all')->orderAsc('sort_order');

        $this->set('headerImage', $headerImage);
        $this->set('helpDeskFaqs', $helpDeskFaqs);
        $this->set('_serialize', ['helpDeskFaqs']);
        $this->set('helpDeskCategories', $helpDeskCategories);
        $this->set('_serialize', ['helpDeskCategories']);
        $this->set('feederHomepage', $this->loadModel('Feeder.FeederHomepages')->get(1));
    }
}
