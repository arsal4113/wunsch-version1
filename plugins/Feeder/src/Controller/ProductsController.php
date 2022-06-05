<?php

namespace Feeder\Controller;

use App\Application;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
use Ebay\Model\Entity\EbayAccount;
use Ebay\Model\Table\EbayRestApiAccessTokensTable;
use EbayCheckout\Controller\EbayCheckoutItemsController;
use Feeder\Model\Table\FeederCategoriesTable;

/**
 * FeederCategories Controller
 *
 * @property FeederCategoriesTable $FeederCategories
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 *
 * @method \Feeder\Model\Entity\FeederCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends EbayCheckoutItemsController
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
     * @var EbayAccount
     */
    protected $ebayAccount;

    /**
     * @var string
     */
    protected $productLayout = 'default';

    /**
     * @var string
     */
    protected $countryCodeShown = 'de';

    /**
     * @var string
     */
    protected $countryCode = 'de';

    /**
     * @var string
     */
    protected $ebayGlobalId = 'EBAY-DE';

    /**
     *  BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \App\Controller\empty|void
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow([
            'view',
            'description'
        ]);

        $this->loadModel('Ebay.EbayAccounts');
        $this->loadComponent('Ebay.EbayBuyApi');

        $mode = Configure::read('dealsguru.mode');
        $ebayAccountId = Configure::read('dealsguru.ebay.' . $mode . '_account_id');
        $this->ebayAccount = $this->EbayAccounts->find()
            ->where(['EbayAccounts.id' => $ebayAccountId])
            ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
            ->cache(EbayRestApiAccessTokensTable::CACHE_KEY_PREFIX . $ebayAccountId, Application::SHORT_TERM_CACHE)
            ->first();

        $uuid = Configure::read('dealsguru.uuid');
        if (!$uuid) {
            throw new NotFoundException(__('CoreSellerCode not found.'));
        }

        $this->loadModel('CoreSellers');

        $this->coreSeller = $this->CoreSellers->find()
            ->where(['CoreSellers.uuid' => $uuid])
            ->cache('CoreSellerUuid' . $uuid, Application::SHORT_TERM_CACHE)
            ->first();

        if (!$this->coreSeller) {
            throw new NotFoundException(__('CoreSeller not found.'));
        }
        parent::beforeFilter($event);
        $customer = $this->Auth->user();
        $wishlistItems = [];
        if ($customer) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
        }
        $this->set('wishlistItems', $wishlistItems);
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

        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));

        $this->set('maxItemQuantity', Configure::read('ebayCheckout.max_item_quantity', 10));
    }

    /**
     * @param null $id
     * @throws \Exception
     */
    public function description($id = null)
    {
        $this->viewBuilder()->setLayout('empty');
        $itemId = $this->request->getParam('itemId');
        if (!$itemId) {
            throw new BadRequestException(__('Item Id not found.'));
        }

        $this->EbayBuyApi->setAccount($this->ebayAccount);
        $this->EbayBuyApi->setLocationCountryCode('de');
        $this->EbayBuyApi->setEbayGlobalId('EBAY-DE');

        $item = $this->GetItem->get($itemId);

        $this->set('ebayItem', $item);
    }
}
