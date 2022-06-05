<?php

namespace EbayCheckout\View\Cell;

use App\Application;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\View\Cell;
use EbayCheckout\Model\Entity\EbayCheckoutSession;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;
use Feeder\Model\Entity\FeederHomepage;
use Feeder\Model\Table\FeederHomepagesTable;

/**
 * MiniCart cell
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 * @property FeederHomepagesTable $FeederHomepages
 */
class MiniCartCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    protected static $ebayCheckoutSession = null;

    /**
     * Default display method.
     *
     * @param null $authUser
     * @param FeederHomepage|null $feederHomepage
     */
    public function display($authUser = null, FeederHomepage $feederHomepage = null)
    {
        $ebayCheckoutSession = null;
        $miniCartEmptyLink = null;
        $cartEnabled = Configure::read('ebayCheckout.cart', false);
        if ($cartEnabled && $this->request->getSession()->read('EbayCheckout.session_token')) {
            $ebayCheckoutSession = $this->getEbayCheckoutSession();

            $this->loadModel('EbayCheckout.EbayCheckoutSessions'); // checking for "deleted" items to show..

            if ($this->EbayCheckoutSessions->EbayCheckoutSessionItems->hasBehavior('SoftDelete')) {
                $this->EbayCheckoutSessions->EbayCheckoutSessionItems->removeBehavior('SoftDelete');
            }

            $query = $this->EbayCheckoutSessions->EbayCheckoutSessionItems
                ->find()
                ->cache(Application::USER_CACHE_KEY_CART_USER_DELETED_ITEMS . $this->request->getSession()->id())
                ->where([
                    'is_deleted' => 1,
                    'ebay_checkout_session_id' => $ebayCheckoutSession->id
                ]);

            $this->set('deletedItems', $query->toArray());
        }

        if ($cartEnabled && empty($ebayCheckoutSession->ebay_checkout_session_items)) {
            $miniCartEmptyLink = $this->getMiniCartEmptyLink($feederHomepage);
        }
        $this->set('ajax', $this->request->is('ajax'));
        $this->set('miniCartEmptyLink', $miniCartEmptyLink);
        $this->set('ebayCheckoutSession', $ebayCheckoutSession);
        $this->set('qwertz', 'hallo welt!');

        $cartUrl = Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'cart',
            'plugin' => 'EbayCheckout',
            'uuid' => Configure::read('dealsguru.uuid')
        ]);

        $this->set('cartUrl', $cartUrl);

        $this->set('authUser', $authUser);
        $wishlistItems = [];
        if ($authUser) {
            $this->loadModel('ItoolCustomer.CustomerWishlistItems');
            $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($authUser);
        }
        $this->set('wishlistItems', $wishlistItems);
    }

    /**
     * icon
     */
    public function icon()
    {
        $ebayCheckoutSession = $this->getEbayCheckoutSession();
        $itemCount = null;
        if ($ebayCheckoutSession) {
            $itemCount = count($ebayCheckoutSession->ebay_checkout_session_items ?? []);
            if ($itemCount) {
                $this->set('items', $ebayCheckoutSession->ebay_checkout_session_items);
            }
        }

        $this->set('itemCount', $itemCount);

        $uuid = Configure::read('dealsguru.uuid');

        $cartUrl = Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'cart',
            'plugin' => 'EbayCheckout',
            'uuid' => $uuid
        ]);
        $this->set('cartUrl', $cartUrl);

        if ($this->request->getSession()->read('EbayCheckout.checkout_visited')) {
            $checkoutUrl = Router::url([
                'controller' => 'EbayCheckoutSessions',
                'action' => 'view',
                'plugin' => 'EbayCheckout',
                'uuid' => $uuid
            ]);
            $this->set('checkoutUrl', $checkoutUrl);
        }
    }

    /**
     * @param FeederHomepage $feederHomepage
     * @return string|null
     */
    public function getMiniCartEmptyLink(FeederHomepage $feederHomepage = null)
    {
        if ($feederHomepage && $feederHomepage->mini_cart_feeder_category_id) {
            return Router::url([
                'controller' => 'Browse',
                'action' => 'view',
                'plugin' => 'Feeder',
                $feederHomepage->mini_cart_feeder_category_id
            ]);
        }
        return null;
    }

    /**
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    public function getEbayCheckoutSession()
    {
        if (self::$ebayCheckoutSession === null && $this->request->getSession()->read('EbayCheckout.session_token')) {
            $this->loadModel('EbayCheckout.EbayCheckoutSessions');
            /**
             * @var EbayCheckoutSession $ebayCheckoutSession
             */
            $sessionToken = $this->request->getSession()->read('EbayCheckout.session_token');

            self::$ebayCheckoutSession = $this->EbayCheckoutSessions
                ->find()
                ->contain([
                        'CoreSellers',
                        'EbayCheckoutSessionItems',
                        'EbayCheckoutSessionItems.EbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionTotals',
                    ]
                )
                ->where([
                    'EbayCheckoutSessions.session_token' => $sessionToken
                ])
                ->cache(Application::USER_CACHE_KEY_CART_USER_ITEMS . $this->request->getSession()->id())
                ->first();
        }
        return self::$ebayCheckoutSession;
    }
}
