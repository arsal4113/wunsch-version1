<?php

namespace EbayCheckout\View\Cell;

use App\Application;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\View\Cell;
use EbayCheckout\Model\Entity\EbayCheckoutSession;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;
use Feeder\Model\Entity\FeederHomepage;

/**
 * MiniCart cell
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 */
class CartCell extends Cell
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
     *  Default display method.
     *
     * @param null $authUser
     */
    public function display($authUser = null)
    {
        $ebayCheckoutSession = null;
        $miniCartEmptyLink = null;
        $cartEnabled = Configure::read('ebayCheckout.cart', false);
        if ($cartEnabled && $this->request->getSession()->read('EbayCheckout.session_token')) {
            $ebayCheckoutSession = $this->getEbayCheckoutSession();

            $this->loadModel('EbayCheckout.EbayCheckoutSessions'); // checking for "deleted" items to show..

            $this->EbayCheckoutSessions->EbayCheckoutSessionItems->removeBehavior('SoftDelete');

            $query = $this->EbayCheckoutSessions->EbayCheckoutSessionItems
                ->find()
                ->cache(Application::USER_CACHE_KEY_CART_USER_DELETED_ITEMS . $this->request->getSession()->id())
                ->where([
                    'is_deleted' => 1,
                    'ebay_checkout_session_id' => $ebayCheckoutSession->id
                ]);

            $this->set('deletedItems', $query->toArray());

            //$this->EbayCheckoutSessions->EbayCheckoutSessionItems->addBehavior('SoftDelete');
        }

        $this->set('ajax', $this->request->is('ajax'));
        $this->set('ebayCheckoutSession', $ebayCheckoutSession);

        $uuid = Configure::read('dealsguru.uuid');
        if (self::$ebayCheckoutSession) {
            $cartUrl = Router::url([
                'controller' => 'EbayCheckoutSessions',
                'action' => 'cart',
                'plugin' => 'EbayCheckout',
                'uuid' => $uuid
            ]);
            $this->set('cartUrl', $cartUrl);
        }

        $this->set('maxItems', Configure::read('ebayCheckout.max_items', 10)); // there's a setting for this? NOW there is!
        $this->set('maxItemQuantity', Configure::read('ebayCheckout.max_item_quantity', 10));

        $itemsNumber = 0;
        if (!empty(self::$ebayCheckoutSession->ebay_checkout_session_items)) {
            foreach (self::$ebayCheckoutSession->ebay_checkout_session_items as $item) {
                $itemsNumber += $item->quantity;
            }
        }
        $this->set('itemsNumber', $itemsNumber);
        $this->set('authUser', $authUser);

        $checkoutUrl = Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'view',
            'plugin' => 'EbayCheckout',
            'uuid' => $uuid
        ]);

        $this->set('checkoutUrl', $checkoutUrl);
    }

    public function getEbayCheckoutSession()
    {
        if (self::$ebayCheckoutSession === null) {
            $this->loadModel('EbayCheckout.EbayCheckoutSessions');
            /**
             * @var EbayCheckoutSession $ebayCheckoutSession
             */
            self::$ebayCheckoutSession = $this->EbayCheckoutSessions
                ->find()
                ->contain(
                    [
                        'CoreSellers',
                        'EbayCheckoutSessionItems',
                        'EbayCheckoutSessionItems.EbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionTotals',
                    ]
                )
                ->cache(Application::USER_CACHE_KEY_CART_USER_ITEMS . $this->request->getSession()->id())
                ->where(['EbayCheckoutSessions.session_token' => $this->request->getSession()->read('EbayCheckout.session_token')])
                ->first();
        }

        return self::$ebayCheckoutSession;
    }
}
