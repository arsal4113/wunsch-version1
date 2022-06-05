<?php

namespace EbayCheckout\Controller;

use App\Application;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
use Cake\Utility\Inflector;
use Cake\View\Helper\UrlHelper;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Ebay\Lib\BuyApi\BrowseApi\Request\GetItemRequest;
use Ebay\Lib\BuyApi\OrderApi\Entity\MarketingTerm;
use Ebay\Lib\BuyApi\OrderApi\Entity\Wallet;
use Ebay\Lib\BuyApi\OrderApi\Request\ApplyGuestCoupon;
use Ebay\Lib\BuyApi\OrderApi\Request\InitiateGuestPaymentRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\PlaceGuestOrderRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\UpdateGuestPaymentInfoRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\UpdateGuestQuantityRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\UpdateGuestShippingAddressRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\UpdateGuestShippingOptionRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\GetGuestPurchaseOrderRequest;
use EbayCheckout\Controller\Component\BraintreeApiComponent;
use EbayCheckout\Model\Entity\EbayCheckoutSessionItem;
use EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress;
use EisSdk\Request\RefreshItemRequest;
use EisSdk\Security\Session;
use ItoolCustomer\Controller\Component\WishlistComponent;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Entity\CustomerAddress;
use ItoolCustomer\Model\Table\CustomerAddressesTable;

/**
 * EbayCheckoutSessions Controller
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable $EbayCheckoutSessions
 * @property BraintreeApiComponent $BraintreeApi
 * @property EbayBuyApiComponent $EbayBuyApi
 * @property CustomerAddressesTable $CustomerAddresses
 * @property \ItoolCustomer\Controller\Component\NewsletterHelperComponent $NewsletterHelper
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSession[] paginate($object = null, array $settings = [])
 *
 * @package ItoolCustomer\Controller
 * @property CustomersTable $Customers
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property WishlistComponent $Wishlist
 */
class EbayCheckoutSessionsController extends EbayCheckoutSessionsAppController
{
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
            'cart',
            'view',
            'getPayment',
            'savePayment',
            'getItems',
            'addItem',
            'removeItem',
            'deleteItem',
            'undeleteItem',
            'getTotals',
            'getShippingAddress',
            'saveShippingAddress',
            'saveQty',
            'saveShipping',
            'submit',
            'success',
            'applyCoupon',
            'getApplyCoupon'
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
        $this->viewBuilder()->setHelpers(['EbayCheckout.EbayCheckout', 'Feeder.Feeder']);
    }

    /**
     * View
     */
    public function view()
    {
        if (!isset($this->ebayCheckoutSession->ebay_checkout_session_items) || empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
            return $this->redirect($this->referer());
        }
        $shippingAddressProvided = false;
        $formKey = bin2hex(openssl_random_pseudo_bytes(15));

        $this->ebayCheckoutSession->form_key = $formKey;
        /** @var Customer $customer */
        $customer = $this->Auth->user();
        $this->ebayCheckoutSession->customer_id = $customer->id ?? null;

        if ($this->ebayCheckoutSession->customer_id) {
            $this->loadModel('ItoolCustomer.CustomerAddresses');
            /** @var CustomerAddress $customerAddress */
            $customerAddress = $this->CustomerAddresses->find()
                ->where([
                    'customer_id' => $this->ebayCheckoutSession->customer_id
                ])
                ->cache(Application::USER_CACHE_KEY_CUSTOMER_ADDRESS . $this->getRequest()->getSession()->id())
                ->first();

            if ($customerAddress) {
                /** @var EbayCheckoutSessionShippingAddress $shippingAddress */
                $this->ebayCheckoutSession->email = $customer->email;
                $this->ebayCheckoutSession->first_name = $customerAddress->first_name;
                $this->ebayCheckoutSession->last_name = $customerAddress->last_name;
                $shippingAddress = [];
                $shippingAddress['address_line_1'] = $customerAddress->street_line_1;
                $shippingAddress['address_line_2'] = $customerAddress->street_line_2;
                $shippingAddress['postal_code'] = $customerAddress->postal_code;
                $shippingAddress['city'] = $customerAddress->city;
                $shippingAddress['country'] = strtoupper($this->ebayCheckoutSession->country_code);
                $shippingAddress['state_or_province'] = $customerAddress->state;
                $shippingAddress['phone_number'] = $customerAddress->phone_number;
                $shippingAddress['recipient'] = $customerAddress->first_name .  ' ' . $customerAddress->last_name;
                $shippingAddress['email'] = $customer->email;
                $shippingAddress['email_confirm'] = $customer->email;
                $shippingAddress['first_name'] = $customerAddress->first_name;
                $shippingAddress['last_name'] = $customerAddress->last_name;
                $shippingAddressProvided = $this->saveShippingAddress($shippingAddress);
            }
        }

        if (!$this->EbayCheckoutSessions->save($this->ebayCheckoutSession)) {
            throw new BadRequestException("Huups");
        }

        /**build the src link for the tracking pixel depending on the country code*/
        $trackingPixelSrc = 'https://rover.ebay.com/roverimp/1/';
        if (strtolower($this->ebayCheckoutSession->country_code) === 'us') {
            $trackingPixelSrc .= '711-241098-21580-0/4?step=item_checkout';
        } else {
            if (strtolower($this->ebayCheckoutSession->country_code) === 'gb') {
                $trackingPixelSrc .= '710-236938-21580-0/4?step=item_checkout';
            } else {
                if (strtolower($this->ebayCheckoutSession->country_code) === 'uk') {
                    $trackingPixelSrc .= '710-236938-21580-0/4?step=item_checkout';
                }
            }
        }

        $trackingPixelSrc .= '&widget_type=' . $this->ebayCheckoutSession->widget_type;

        $trackingPixelSrc .= '&wrapper_layout=' . $this->ebayCheckoutSession->wrapper_layout;

        $this->set('ebayTrackingPixelSrc', $trackingPixelSrc);

        if (isset($this->ebayCheckoutSession->ebay_checkout_session_shipping_address) && $this->ebayCheckoutSession->ebay_checkout_session_shipping_address->random_phone_number) {
            $this->ebayCheckoutSession->ebay_checkout_session_shipping_address->phone_number = null;
        }

        $this->set('ebayCheckoutSession', $this->ebayCheckoutSession);
        $this->set('shippingAddressProvided', $shippingAddressProvided);

        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));

        $this->request->getSession()->write('EbayCheckout.checkout_visited', true); // because of WD-1192
    }

    /**
     * Submit
     */
    public function submit()
    {
        $successData = $this->request->getData();

        $requiredLegalMessages = [];
        $errors = [];

        foreach ($requiredLegalMessages as $requiredLegalMessage) {
            if (!isset($successData['legalMessage'][$requiredLegalMessage]) || $successData['legalMessage'][$requiredLegalMessage] !== "true") {
                $errors['error'] = true;
                $errors['message'] = 'Please accept all legal messages';
                return $this->response->withType("application/json")->withStringBody(json_encode($errors));

            }
        }

        if (!$this->ebayCheckoutSession->ebay_checkout_session_id) {
            $errors['error'] = true;
            $errors['message'] = 'Checkout Session not found';
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }
        $ebayCheckoutSessionId = $this->ebayCheckoutSession->ebay_checkout_session_id;

        if (isset($successData['marketingConsent']) && $successData['marketingConsent'] == "true") {
            $this->ebayCheckoutSession->marketing_consent = 1;
        } else {
            $this->ebayCheckoutSession->marketing_consent = 0;
        }

        if ($successData['catchMarketingConsent'] == "true") {
            $this->loadComponent('ItoolCustomer.NewsletterHelper');
            $this->NewsletterHelper->sendSignUpEmail($this->ebayCheckoutSession->email);
        }

        $placeOrderRequest = new PlaceGuestOrderRequest();
        $placeOrderRequest->setCheckoutSessionId($ebayCheckoutSessionId);
        $marketingTerm = new MarketingTerm();
        $marketingTerm->appendMarketingChannel(MarketingTerm::MARKETING_CHANNEL_EMAIL);
        $marketingTerm->setMarketingTypes(
            [
                MarketingTerm::MARKETING_TYPE_OFFER,
                MarketingTerm::MARKETING_TYPE_PROMOTION,
                MarketingTerm::MARKETING_TYPE_SURVEY
            ]
        );

        $marketingTerm->setMarketingTermsAccepted($this->ebayCheckoutSession->marketing_consent ?? false);
        $placeOrderRequest->appendMarketingTerm($marketingTerm);

        try {
            $response = $this->EbayBuyApi
                ->setAccount($this->ebayAccount)
                ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                ->callOrderApi($placeOrderRequest);

            if (isset($response->purchaseOrderId) && !empty($response->purchaseOrderId)) {
                $this->ebayCheckoutSession->purchase_order_id = $response->purchaseOrderId;
                $this->ebayCheckoutSession->purchase_order_timestamp = time();
                $this->ebayCheckoutSession->order_payment_status = $response->purchaseOrderPaymentStatus ?? '';
                $this->ebayCheckoutSession->ebay_app_id = $this->ebayAccount->ebay_credential->app_id ?? '';
                $this->ebayCheckoutSession->ebay_epn_reference_id = $this->EbayBuyApi->getAffiliateReferenceId();
                $this->ebayCheckoutSession->ebay_epn_campaign_id = $this->EbayBuyApi->getAffiliateCampaignId();
                if ($this->request->getSession()->read('utm_timestamp') > strtotime('-48 hours')) {
                    $this->ebayCheckoutSession->utm_campaign = $this->request->getSession()->read('utm_campaign');
                    $this->ebayCheckoutSession->utm_content = $this->request->getSession()->read('utm_content');
                    $this->ebayCheckoutSession->utm_medium = $this->request->getSession()->read('utm_medium');
                    $this->ebayCheckoutSession->utm_source = $this->request->getSession()->read('utm_source');
                }

                $this->saveEbayCheckoutSession();
            } else {
                if (isset($response->errors)) {
                    return $this->response->withType("application/json")->withStringBody(json_encode($this->handleEbayResponseErrors($response)));
                }
                return $this->response->withType("application/json")->withStringBody(json_encode(['error' => true, 'message' => 'Your order could not be created.']));
            }
        } catch (\Exception $e) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['error' => true, 'message' => 'Your order could not be created.']));
        }

        if (!$this->ebayCheckoutSession->purchase_order_id) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['error' => true, 'message' => 'Your order could not be created.']));
        }

        $redirect = Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'success',
            'plugin' => 'EbayCheckout',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid,
            '?' => [
                'token' => $this->ebayCheckoutSession->session_token,
                'key' => $this->ebayCheckoutSession->form_key
            ]
        ]);
        return $this->response->withType("application/json")->withStringBody(json_encode(['successUrl' => $redirect]));
    }

    /**
     * Success
     *
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function success()
    {
        $testMode = Configure::read('dealsguru.debug.success_page', false);
        $checkoutCompleted = $this->request->getSession()->read('EbayCheckout.checkout_completed') ?: false;

        if ($testMode) {
            $this->ebayCheckoutSession->purchase_order_id = 'TEST-ORDER-ID';
            $testMode = true;
        }

        if (!$this->ebayCheckoutSession->purchase_order_id) {
            return $this->redirect([
                'action' => 'view',
                'uuid' => $this->ebayCheckoutSession->core_seller->uuid
            ]);
        }

        if ($checkoutCompleted
            && $this->request->getParam('action') == 'success') {
            if ($this->Auth->user()) {
                return $this->redirect(['plugin' => 'ItoolCustomer', 'controller' => 'Account', 'action' => 'orders']);
            } else {
                return $this->redirect('/');
            }
        }

        $this->request->getSession()->write('EbayCheckout.checkout_completed', true);

        $ebayItemIds = [];

        $event = new Event('EbayCheckout.EbayCheckoutSessions.success', $this, [
            'ebayItemIds' => $ebayItemIds,
            'ebayGlobalId' => $this->ebayCheckoutSession->ebay_global_id
        ]);

        if (!$testMode) {
            $this->getEventManager()->dispatch($event);
        }

        /**build the src link for the tracking pixel depending on the country code*/
        $trackingPixelSrc = '';
        if (strtolower($this->ebayCheckoutSession->country_code) === 'us') {
            $trackingPixelSrc = 'https://rover.ebay.com/roverroi/1/711-518-180-16?BIN-FP=1&siteId=0&tranType=BIN-FP';
        } else {
            if (strtolower($this->ebayCheckoutSession->country_code) === 'gb') {
                $trackingPixelSrc = 'https://rover.ebay.com/roverroi/1/710-517-180-14?BIN-FP=1&siteId=3&tranType=BIN-FP ';
            } else {
                if (strtolower($this->ebayCheckoutSession->country_code) === 'uk') {
                    $trackingPixelSrc = 'https://rover.ebay.com/roverroi/1/710-517-180-14?BIN-FP=1&siteId=3&tranType=BIN-FP ';
                }
            }
        }

        $this->loadComponent('ItoolCustomer.NewsletterHelper');
        $emailInUse = false;
        if (isset($this->currentUser)) {
            $emailInUse = $this->NewsletterHelper->checkIfSubscribed($this->currentUser->email);
        }
        if (isset($this->ebayCheckoutSession->email) && !$emailInUse) {
            $emailInUse = $this->NewsletterHelper->checkIfSubscribed($this->ebayCheckoutSession->email);
        }

        $this->set('showNewsletter', !$emailInUse);
        $this->set('items', $this->ebayCheckoutSession->ebay_checkout_session_items);
        $this->set('ebayCheckoutSession', $this->ebayCheckoutSession);
        $this->set('session_token', $this->ebayCheckoutSession->session_token);

        $this->set('ebayTrackingPixelSrc', $trackingPixelSrc);

        $knotchSurveyId = (strtolower($this->ebayCheckoutSession->country_code) === 'us')
            ? '5a2971517a33aa173c4d86e6'
            : '5a2971df42456b051c3bb0ef'; // this for uk/gb (all others)

        $this->set('knotchSurveyId', $knotchSurveyId);

        $this->set('email', $this->ebayCheckoutSession->email);
        if (!$testMode) {
            $this->request->getSession()->write('EbayCheckout.session_token', null);
        }

        $purchaseOrderId = $this->ebayCheckoutSession->purchase_order_id;
        $getOrderResponse = new GetGuestPurchaseOrderRequest();
        $getOrderResponse->setGuestPurchaseOrderId($purchaseOrderId);
        $orderResponse = $this->EbayBuyApi
            ->setAccount($this->ebayAccount)
            ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
            ->callOrderApi($getOrderResponse);

        foreach ($orderResponse->lineItems ?? [] as $lineItem) {
            if (isset($lineItem->legacyReference->legacyOrderId)) {
                foreach ($this->ebayCheckoutSession->ebay_checkout_session_items ?? [] as &$sessionItem) {
                    if ($sessionItem->ebay_item_id == $lineItem->itemId) {
                        $sessionItem->legacy_order_id = $lineItem->legacyReference->legacyOrderId;
                        $this->ebayCheckoutSession->setDirty('ebay_checkout_session_items', true);
                    }
                }
            }
        }
        $this->saveEbayCheckoutSession();

        $orderPaymentStatus = $this->ebayCheckoutSession->order_payment_status;
        $partiallyPaidError = false;
        $cancelledItems = false;
        if ($orderPaymentStatus == 'PARTIALLY_PAID') {
            $partiallyPaidError = true;
            $cancelledItems = [];
            foreach ($orderResponse->lineItems ?? [] as $item) {
                if ($item->lineItemPaymentStatus == "FAILED") {
                    $cancelledItems[] = $item;
                }
            }
        }

        $this->set('cancelledItems', $cancelledItems);
        $this->set('partiallyPaidError', $partiallyPaidError);
        $this->set('searchUrl', Router::url([
            'controller' => 'Browse',
            'action' => 'search',
            'plugin' => 'Feeder'
        ]));
    }

    /**
     * Get Items
     */
    public function getItems()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * Add Items
     */
    public function addItems()
    {
        $itemsData = $this->request->getData();
        $itemCount = count($itemsData['item']);
        $isOneItem = false;
        foreach ($itemsData['item'] as $itemData) {
            if ($itemCount == 1) {
                $isOneItem = true;
            } else {
                $itemCount--;
            }
            $this->addItem($itemData, $isOneItem);
        }
    }

    /**
     * Add Item
     *
     * @param null $itemData
     * @param bool $isOneItem
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function addItem($itemData = null, $isOneItem = true)
    {
        $this->request->getSession()->write('EbayCheckout.checkout_completed', false);

        if ($itemData == null) {
            $itemData = $this->request->getData();
        }
        $shoppingCart = null;
        $customer = $this->Auth->user();
        if (
            !isset($itemData['itemId'])
            || empty($itemData['itemId'])
            || !isset($itemData['qty'])
            || empty($itemData['qty'])
        ) {
            $this->Flash->error(__('Item not found'));
            return $this->redirect($this->referer());
        }

        if (is_array($this->ebayCheckoutSession->ebay_checkout_session_items) && count($this->ebayCheckoutSession->ebay_checkout_session_items) >= Configure::read('ebayCheckout.max_items', 10)) {
            $itemExitsInSession = false;
            foreach ($this->ebayCheckoutSession->ebay_checkout_session_items as $ebayCheckoutSessionItem) {
                if ($ebayCheckoutSessionItem->ebay_item_id == $itemData['itemId']) {
                    $itemExitsInSession = true;
                }
            }
            if (!$itemExitsInSession) {
                /** @var Customer $customer */
                if ($customer && !empty($customer->id)) {
                    $this->loadComponent('ItoolCustomer.Wishlist');
                    $this->Wishlist->addItemToWishlist($customer, $itemData['itemId']);
                }
                $this->Flash->wishlistPopup(__('Max item'), ['key' => 'wishlist-popup']);
                return $this->redirect($this->referer());
            }
        }

        try {
            $this->EbayBuyApi->setAccount($this->ebayAccount);
            if (isset($itemData['ebayGlobalId']) && !empty($itemData['ebayGlobalId'])) {
                $this->EbayBuyApi->setEbayGlobalId($itemData['ebayGlobalId']);
                $this->ebayCheckoutSession->ebay_global_id = $itemData['ebayGlobalId'];
            }

            if (isset($itemData['countryCode']) && !empty($itemData['countryCode'])) {
                $this->EbayBuyApi->setLocationCountryCode($itemData['countryCode']);
                $this->ebayCheckoutSession->country_code = $itemData['countryCode'];
            }

            if (isset($itemData['widgetType']) && !empty($itemData['widgetType'])) {
                $this->ebayCheckoutSession->widget_type = $itemData['widgetType'];
            }

            if (isset($itemData['wrapperLayout']) && !empty($itemData['wrapperLayout'])) {
                $this->ebayCheckoutSession->wrapper_layout = $itemData['wrapperLayout'];
            }

            $response = $this->GetItem->get($itemData['itemId'], true);

            if (isset($response->items)) {
                foreach ($response->items as $ebayItem) {
                    if ($ebayItem->itemId == $itemData['itemId']) {
                        $response = $ebayItem;
                        break;
                    }
                }
            }

            if (isset($response->enabledForGuestCheckout) && !$response->enabledForGuestCheckout) {
                $this->Flash->error(__('<span class="alert"></span>Item not enabled for guest checkout. Buy it on <a href="{0}">eBay</a>', $response->itemWebUrl ?? 'https://www.ebay.de'));
                return $this->redirect($this->referer());
            }

            $itemEnded = false;
            if (isset($response->itemEndDate)) {
                $itemEndDate = strtotime($response->itemEndDate);
                $now = (Time::now('UTC'))->toUnixString();
                $itemEnded = $now > $itemEndDate;
            }

            if (
                ($response->estimatedAvailabilities[0]->estimatedAvailabilityStatus ?? false) != 'IN_STOCK'
                || isset($response->errors)
                || $itemEnded
            ) {

                try {
                    $refreshItemRequest = new RefreshItemRequest();
                    $refreshItemRequest->setItemId($itemData['itemId']);
                    $refreshItemRequest->setEbayGlobalId($itemData['ebayGlobalId']);

                    $session = new Session();
                    $session->setAccessToken(Configure::read('eis.token'));
                    $session->setRequest($refreshItemRequest);
                    $session->sendRequest();
                } catch (\Exception $exp) {
                    $this->log(__('Error while sending item refresh request. ErrorMessage "{0}", ItemId "{1}", eBayGlobalId "{2}", File "{3}", CodeLine "{4}"', [
                        $exp->getMessage(),
                        $itemData['itemId'],
                        $itemData['ebayGlobalId'],
                        $exp->getFile(),
                        $exp->getLine()
                    ]));
                }

                $this->Flash->error(__('Could not add product.'));

                try {
                    $refreshItemRequest = new RefreshItemRequest();
                    $refreshItemRequest->setItemId($itemData['itemId']);

                    $session = new Session();
                    $session
                        ->setAccessToken(Configure::read('eis.token'))
                        ->setRequest($refreshItemRequest);
                    $session->sendRequest();
                } catch (\Exception $exp) {
                    $this->log(__('Error while updating ES item with id "{0}". File: "{1}", Line: {2}, Message: "{3}"',
                        [
                            $itemData['itemId'],
                            $exp->getFile(),
                            $exp->getLine(),
                            $exp->getMessage()
                        ]));
                }
                return $this->redirect($this->referer());
            }

            $item = $this->syncItemAndShipping($response, $itemData['qty']);

            if (isset($itemData['attributes'])) {
                $item->attributes = serialize($itemData['attributes']);
            }
            $item->original_price_value = $itemData['originalPriceValue'] ?? null;

            if (isset($itemData['tags'])) {
                $item->tags = serialize($itemData['tags']);
            }

            if (!Configure::read('ebayCheckout.cart', false)) {
                $this->ebayCheckoutSession->ebay_checkout_session_items = [$item];
            } else {
                $items = $this->ebayCheckoutSession->ebay_checkout_session_items;
                $items[] = $item;
                $this->ebayCheckoutSession->ebay_checkout_session_items = $items;
            }

            if ($this->ebayCheckoutSession->ebay_checkout_session_id) {
                $this->ebayCheckoutSession->ebay_checkout_session_id = null;
            }
            $this->syncTotalsWithoutEbayCheckoutSession();

            $this->saveEbayCheckoutSession();

        } catch (\Exception $e) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['error' => true, 'message' => 'Item not found']));
        }
        return $this->response->withType("application/json")->withStringBody(json_encode(['error' => false]));
    }

    /**
     * Soft deletes item from checkout sessions
     * @return \Cake\Http\Response|void|null
     */
    public function deleteItem()
    {
        if (!$itemId = $this->request->getParam('itemId', false)) {
            $this->Flash->error(__('Item not found'));
            return $this->redirect($this->referer());
        }

        $items = $this->ebayCheckoutSession->ebay_checkout_session_items;

        foreach ($items as $key => $item) {
            if ($item->id == $itemId) {
                $items[$key]->is_deleted = 1;
                $this->EbayCheckoutSessions->EbayCheckoutSessionItems->save($items[$key]);
                //unset($items[$key]);
                $this->ebayCheckoutSession->ebay_checkout_session_items = $items;
                if (!$this->request->is('ajax') && !empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
                    $this->Flash->success(__('Item deleted'));
                }
                break;
            }
        }

        $this->syncTotalsWithoutEbayCheckoutSession();
        $this->saveEbayCheckoutSession();

        if ($this->request->is('ajax')) {
            $this->set('response', ['success' => true, 'message' => __('Item deleted')]);
            $this->set('_serialize', ['response']);
            $this->viewBuilder()->setClassName('Json');
            return;
        }

        if (empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
            $this->ebayCheckoutSession = null;
            $this->request->getSession()->write('EbayCheckout.session_token', null);
            return $this->redirect('/');
        }

        return $this->redirect([
            'action' => 'view',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid,
            'token' => $this->ebayCheckoutSession->session_token
        ]);
    }

    /**
     * Restores last deleted item from checkout session
     * @return \Cake\Http\Response|void|null
     */
    public function undeleteItem()
    {
        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->removeBehavior('SoftDelete');

        if (!$itemId = $this->request->getParam('itemId', false)) {
            $this->Flash->error(__('Item not found'));
            return $this->redirect($this->referer());
        }

        $items = $this->ebayCheckoutSession->ebay_checkout_session_items;

        $item = $this->EbayCheckoutSessions->EbayCheckoutSessionItems->get($itemId, ['contain' => 'EbayCheckoutSessionItemShippings']);

        $item->is_deleted = 0;
        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->save($item);
        $items[] = $item;
        $this->ebayCheckoutSession->ebay_checkout_session_items = $items;

        if (!$this->request->is('ajax')) {
            $this->Flash->success(__('Item undeleted'));
        }

        if ($this->ebayCheckoutSession->ebay_checkout_session_id) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = null;
        }

        $this->syncTotalsWithoutEbayCheckoutSession();
        $this->saveEbayCheckoutSession();

        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->addBehavior('SoftDelete');

        if ($this->request->is('ajax')) {
            $this->set('response', ['success' => true, 'message' => __('Item undeleted')]);
            $this->set('_serialize', ['response']);
            $this->viewBuilder()->setClassName('Json');
            return;
        }

        if (empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
            $this->ebayCheckoutSession = null;
            $this->request->getSession()->write('EbayCheckout.session_token', null);
            return $this->redirect('/');
        }

        return $this->redirect([
            'action' => 'view',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid,
            'token' => $this->ebayCheckoutSession->session_token
        ]);
    }

    /**
     * @return \Cake\Http\Response|void|null
     */
    public function removeItem()
    {
        $itemId = $this->request->getParam('itemId', false);
        if (!$itemId) {
            $this->Flash->error(__('Item not found'));
            return $this->redirect($this->referer());
        }

        $items = $this->ebayCheckoutSession->ebay_checkout_session_items;

        foreach ($items as $key => $item) {
            if ($item->id == $itemId) {
                unset($items[$key]);
                $this->ebayCheckoutSession->ebay_checkout_session_items = $items;
                if (!$this->request->is('ajax') && !empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
                    $this->Flash->success(__('Item removed'));
                }
                break;
            }
        }

        if ($this->ebayCheckoutSession->ebay_checkout_session_id) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = null;
        }

        $this->syncTotalsWithoutEbayCheckoutSession();
        $this->saveEbayCheckoutSession();

        if ($this->request->is('ajax')) {
            $this->set('response', ['success' => true, 'message' => __('Item removed')]);
            $this->set('_serialize', ['response']);
            $this->viewBuilder()->setClassName('Json');
            return;
        }

        if (empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
            $this->ebayCheckoutSession = null;
            $this->request->getSession()->write('EbayCheckout.session_token', null);
            return $this->redirect('/');
        }

        return $this->redirect([
            'action' => 'view',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid,
            'token' => $this->ebayCheckoutSession->session_token
        ]);

    }

    /**
     * @param null $address
     * @return bool|\Cake\Http\Response
     * @throws \Exception
     */
    public function saveShippingAddress($address = null)
    {

        $errors = [];
        $shippingAddressProvided = false;
        if (!$address) {
            $shippingAddress = $this->request->getData();
        } else {
            $shippingAddress = $address;
            $shippingAddressProvided = true;
        }

        $customer = $this->Auth->user();
        if (!$address && isset($shippingAddress['save_address']) && $shippingAddress['save_address']) {
            $customerAddressTable = TableRegistry::get('customer_addresses');
            $savedAddresses = $customerAddressTable->find('all', [
                'conditions' => ['customer_id =' => $customer->id]
            ]);
            $addressFound = null;
            foreach ($savedAddresses as $savedAddress) {
                $addressFound = $savedAddress;
            }
            $customerAddress = $customerAddressTable->newEntity();
            if ($addressFound) {
                $customerAddress->id = $addressFound->id;
            } else {
                $customerAddress->created = Time::now();
            }
            $customerAddress->customer_id = $customer->id;
            $customerAddress->core_country_id = 1;
            $customerAddress->first_name = $shippingAddress['first_name'];
            $customerAddress->last_name = $shippingAddress['last_name'];
            $customerAddress->street_line_1 = $shippingAddress['address_line_1'];
            $customerAddress->street_line_2 = $shippingAddress['address_line_2'];
            $customerAddress->state = $shippingAddress['state_or_province'];
            $customerAddress->city = $shippingAddress['city'];
            $customerAddress->postal_code = $shippingAddress['postal_code'];
            $customerAddress->phone_number = $shippingAddress['phone_number'];
            $customerAddress->modified = Time::now();
            if ($customerAddressTable->save($customerAddress)) {
                if (!$addressFound) {
                    $customerAddressTypeTable = TableRegistry::get('customer_addresses_customer_address_types');
                    $customerAddressType = $customerAddressTypeTable->newEntity();
                    $customerAddressType->customer_address_id = $customerAddress->id;
                    $customerAddressType->customer_address_type_id = 2;
                    $customerAddressType->created = Time::now();
                    $customerAddressType->modified = Time::now();
                    if (!$customerAddressTypeTable->save($customerAddressType)) {
                        $errors += ['message' => "Error while saving the address type"];
                    }
                }
            } else {
                $errors += ['message' => "Error while saving the shipping Data"];
            }
        }

        $this->ebayCheckoutSession->first_name = $shippingAddress['first_name'];
        $this->ebayCheckoutSession->last_name = $shippingAddress['last_name'];
        $this->ebayCheckoutSession->email = $shippingAddress['email'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ebayCheckoutSession->ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ebayCheckoutSession->ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $this->ebayCheckoutSession->ip = $_SERVER['REMOTE_ADDR'];
        }

        $shippingAddress['recipient'] = $shippingAddress['first_name'] . ' ' . $shippingAddress['last_name'];

        if (!$this->ebayCheckoutSession->ebay_checkout_session_shipping_address) {
            /** @var EbayCheckoutSessionShippingAddress $ebayShippingAddress */
            $ebayShippingAddress = $this->EbayCheckoutSessions->EbayCheckoutSessionShippingAddresses->newEntity($shippingAddress);
            $ebayShippingAddress->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
        } else {
            $ebayShippingAddress =
                $this->EbayCheckoutSessions->EbayCheckoutSessionShippingAddresses
                    ->patchEntity(
                        $this->ebayCheckoutSession->ebay_checkout_session_shipping_address,
                        $shippingAddress
                    );
        }
        $this->ebayCheckoutSession->ebay_checkout_session_shipping_address = $ebayShippingAddress;

        if ($this->ebayCheckoutSession->payment_initiated) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = null;
        }

        if ($this->ebayCheckoutSession->ebay_checkout_session_id && !$this->ebayCheckoutSession->payment_initiated && !$this->ebayCheckoutSession->redemption_code) {
            $updateGuestShippingAddressRequest = new UpdateGuestShippingAddressRequest();
            $updateGuestShippingAddressRequest->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id)
                ->setShippingAddress($this->buildShippingAddressEntity($ebayShippingAddress));

            $response = $this->EbayBuyApi
                ->setAccount($this->ebayAccount)
                ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                ->callOrderApi($updateGuestShippingAddressRequest);
        } else {
            $response = $this->initiateEbayCheckoutSession();

            if ($response->checkoutSessionId ?? null) {
                $success = $this->syncEbayCheckoutSession($response);
                if ($success !== true) {
                    $errors = $success;
                }
            }
        }
        if (isset($response->errors)) {
            $errors = $this->handleEbayResponseErrors($response);
        }

        if (!$this->EbayCheckoutSessions->save($this->ebayCheckoutSession,
            ['associated' => 'EbayCheckoutSessionShippingAddresses'])) {
            $errors['error'] = true;
            $errors['message'] = $this->ebayCheckoutSession->getErrors();
        }

        if($address){
            if(!empty($errors)) {
                $shippingAddressProvided = false;
            }
            return $shippingAddressProvided;
        }

        if(!empty($errors)){
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        } else {
            return $this->response->withType("application/json")->withStringBody(json_encode(
                [
                    'shippingAddress' => $this->ebayCheckoutSession->ebay_checkout_session_shipping_address,
                    'paymentMethods' => $response->acceptedPaymentMethods
                ]
            ));
        }
    }

    /**
     * Get Payment
     */
    public function getPayment()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * Get Payment
     */
    public function getApplyCoupon()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * @throws \Exception
     */
    public function savePayment()
    {
        $errors = [];
        $payment = $this->request->getData();

        if (!isset($payment['payment_method_type']) || empty($payment['payment_method_type'])) {
            $errors['error'] = true;
            $errors['message'] = __('Payment method type missing.');
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }

        $errors = $this->checkPaymentInitized($payment['payment_method_type']);

        if ($errors) {
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }

        foreach ($this->ebayCheckoutSession->ebay_checkout_session_payments as $paymentMethod) {
            if ($paymentMethod->payment_method_type == $payment['payment_method_type']) {
                $this->ebayCheckoutSession->selected_ebay_checkout_session_payment_id = $paymentMethod->id;
                $this->ebayCheckoutSession->selected_ebay_checkout_session_payment = $paymentMethod;
                $this->saveEbayCheckoutSession();
            }
        }

        $response = $this->handlePayment($payment);

        if (is_array($response) && isset($response['errors'])) {
            $errors = $response;
        }

        if ($errors || $response === false) {
            $errors['error'] = true;
            $errors['message'] = __('There was a problem with your payment data.');
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }

        return $this->response->withType("application/json")->withStringBody(json_encode($response));
    }

    /**
     * Get Totals
     */
    public function getTotals()
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * applyCoupon
     */
    public function applyCoupon()
    {
        $errors = [];

        $redemptionCode = $this->request->getData('redemption_code');

        if (!$this->ebayCheckoutSession->ebay_checkout_session_id) {
            return $this->jsonError(__('Checkout needs to be initialized'));
        }

        if ($this->ebayCheckoutSession->payment_initiated) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = null;
            $response = $this->initiateEbayCheckoutSession($skipRedemptionCode = true);
            if ($response->checkoutSessionId ?? null) {
                $this->ebayCheckoutSession->payment_initiated = 0;
                $success = $this->syncEbayCheckoutSession($response);
                if ($success !== true) {
                    $errors['error'] = true;
                    $errors['messages'] = [];
                    $errors['messages'] += $success;
                }
            }
        }

        if ($redemptionCode) {
            $firsName = $this->ebayCheckoutSession->first_name;
            $lastName = $this->ebayCheckoutSession->last_name;
            $email = $this->ebayCheckoutSession->email;
            $street = $this->ebayCheckoutSession->ebay_checkout_session_shipping_address->address_line_1;
            $postalCode = $this->ebayCheckoutSession->ebay_checkout_session_shipping_address->postal_code;
            $ip = $this->ebayCheckoutSession->ip;

            $streetVariants = [
                $street,
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1str$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1Str$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1str.$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1Str.$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1straße$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1Straße$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1strasse$3', $street),
                preg_replace('/(.+)(stra?s?s?ß?e?\.?)(.*)/uis', '$1Strasse$3', $street),
            ];

            $rules = [
                [
                    'maxAllowedExistingOrders' => 0,
                    'rule' => [
                        'EbayCheckoutSessions.email' => $email,
                    ]
                ],
                [
                    'maxAllowedExistingOrders' => 0,
                    'rule' => [
                        'EbayCheckoutSessions.first_name' => $firsName,
                        'EbayCheckoutSessions.last_name' => $lastName,
                        'EbayCheckoutSessionShippingAddresses.postal_code' => $postalCode,
                        'EbayCheckoutSessionShippingAddresses.address_line_1 IN' => $streetVariants,
                    ]
                ],
                [
                    'maxAllowedExistingOrders' => 1,
                    'rule' => [
                        'EbayCheckoutSessions.ip' => $ip,
                        'EbayCheckoutSessionShippingAddresses.postal_code' => $postalCode,
                        'EbayCheckoutSessionShippingAddresses.address_line_1 IN' => $streetVariants,
                    ]
                ],
                [
                    'maxAllowedExistingOrders' => 2,
                    'rule' => [
                        'EbayCheckoutSessions.ip' => $ip,
                    ],
                ],
                [
                    'maxAllowedExistingOrders' => 4,
                    'rule' => [
                        'EbayCheckoutSessionShippingAddresses.postal_code' => $postalCode,
                        'EbayCheckoutSessionShippingAddresses.address_line_1 IN' => $streetVariants,
                    ]
                ],
            ];

            // TODO: find a way to ignore coupons in unfinished sessions without creating coupon abuse exploits
            // we don't allow to apply the coupon to another session again even if the other session was not finished
            // this is to prevent cases where the user applies the coupon in multiple sessions and then finishes all of them
            // real world example: https://www.mydealz.de/gutscheine/runtastic-3-monate-premium-gratis-1412670
            $defaultRule = [
                'EbayCheckoutSessions.id !=' => $this->ebayCheckoutSession->id,
                'EbayCheckoutSessions.redemption_code' => $redemptionCode,
                //'EbayCheckoutSessions.purchase_order_id IS NOT NULL'
            ];

            $rulesPassed = true;
            foreach ($rules as $rule) {
                if ($this->EbayCheckoutSessions->find()->contain(['EbayCheckoutSessionShippingAddresses'])
                        ->where($defaultRule + $rule['rule'])->count() > $rule['maxAllowedExistingOrders']) {
                    $rulesPassed = false;
                    break;
                }
            }

            if ($rulesPassed) {
                $response = $this->applyRedemptionCode($redemptionCode);
                $this->ebayCheckoutSession->payment_initiated = 1;
            } else {
                $redemptionCode = null;
                $errors['error'] = true;
                $errors['message'] = __('This coupon has already been used. The coupon was ignored and no discount was applied to this order.');
                return $this->response->withType("application/json")->withStringBody(json_encode($errors));

            }
        } else {
            $this->ebayCheckoutSession->redemption_code = null;
        }

        if (isset($response->errors)) {
            $errors = $this->handleEbayResponseErrors($response);
        } elseif (isset($response->warnings)) {
            $errors = $this->handleEbayResponseWarnings($response);
        } else {
            $this->ebayCheckoutSession->redemption_code = $redemptionCode;
            $this->syncEbayCheckoutSessionTotals($response);
        }

        $this->saveEbayCheckoutSession();

        if (!empty($errors)) {
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        } else {
            return $this->response->withType("application/json")->withStringBody(json_encode($response));
        }
    }

    /**
     * Save Qty
     *
     * @throws \Exception
     */
    public function saveQty()
    {
        $this->checkAjax('post');

        $itemId = $this->request->getData('itemId');
        $qty = $this->request->getData('qty');

        if (!$itemId || !$qty) {
            return $this->jsonError('Item Id or Qty missing');
        }

        $errors = $this->checkPaymentInitized();

        if ($errors) {
            $this->set('error', $errors);
            return;
        }

        $itemFound = false;
        $errors = false;

        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items as &$item) {
            /** @var EbayCheckoutSessionItem $item */
            if ($item->id == $itemId) {
                $itemFound = true;
                $item->quantity = $qty;

                if ($this->ebayCheckoutSession->ebay_checkout_session_id) {
                    $updateQuantity = new UpdateGuestQuantityRequest();
                    $updateQuantity->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);
                    $updateQuantity->setLineItemId($item->ebay_line_item_id);
                    $updateQuantity->setQuantity($qty);

                    $response = $this->EbayBuyApi
                        ->setAccount($this->ebayAccount)
                        ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                        ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                        ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                        ->callOrderApi($updateQuantity);

                    if (isset($response->errors)) {
                        $errors = $this->handleEbayResponseErrors($response);
                    } else {
                        if (!$this->EbayCheckoutSessions->EbayCheckoutSessionItems->save($item)) {
                            return $this->jsonError(print_r($item->getErrors(), true));
                        }
                        $this->syncEbayCheckoutSessionTotals($response);
                        $this->saveEbayCheckoutSession();
                    }

                    if ($errors) {
                        foreach ($errors as $key => $value) {
                            $errors[$key] = __($value);
                        }
                        return $this->jsonError($errors);
                    }
                } else {
                    if (!$this->EbayCheckoutSessions->EbayCheckoutSessionItems->save($item)) {
                        return $this->jsonError(print_r($item->getErrors(), true));
                    }
                    $this->syncTotalsWithoutEbayCheckoutSession();
                    $this->saveEbayCheckoutSession();
                }

                break;
            }
        }

        if (!$itemFound) {
            return $this->jsonError("Item not found");
        }

        $this->set('response', ['success' => true]);
        $this->set('_serialize', ['response']);
    }

    /**
     * Save Shipping
     *
     * @throws \Exception
     */
    public function saveShipping()
    {
        $errors = [];
        $itemId = $this->request->getData('itemId');
        $shippingId = $this->request->getData('shippingId');

        if (!$itemId || !$shippingId) {
            $errors['error'] = true;
            $errors['message'] = 'Item Id or Shipping Id missing';
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }
        $errors = $this->checkPaymentInitized();

        if ($errors) {
            $errors['error'] = true;
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }

        $shippingFound = false;
        $errors = [];
        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
            /** @var EbayCheckoutSessionItem $item */
            if ($item->id == $itemId) {
                foreach ($item->ebay_checkout_session_item_shippings as $shipping) {
                    if ($shipping->shipping_service_code == $shippingId) {
                        $shippingFound = true;
                        $item->selected_ebay_checkout_session_item_shipping_id = $shipping->id;
                        if (!$this->EbayCheckoutSessions->EbayCheckoutSessionItems->save($item)) {
                            return $this->jsonError(print_r($item->getErrors(), true));
                        }

                        if ($this->ebayCheckoutSession->ebay_checkout_session_id) {
                            $updateShippingOption = new UpdateGuestShippingOptionRequest();
                            $updateShippingOption->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);
                            $updateShippingOption->setLineItemId($item->ebay_line_item_id)
                                ->setShippingOptionId($shipping->shipping_option_id);

                            $response = $this->EbayBuyApi
                                ->setAccount($this->ebayAccount)
                                ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                                ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                                ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                                ->callOrderApi($updateShippingOption);

                            if (isset($response->errors)) {
                                $errors = $this->handleEbayResponseErrors($response);
                            } else {
                                $this->syncEbayCheckoutSessionTotals($response);
                                $this->saveEbayCheckoutSession();
                            }
                        } else {
                            $this->syncTotalsWithoutEbayCheckoutSession($shippingId, $itemId);
                            $this->saveEbayCheckoutSession();
                        }
                    }
                }
                break;
            }
        }

        if (!$shippingFound) {
            $errors['error'] = true;
            $errors['message'] = 'Shipping not found';
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }

        if ($errors){
            return $this->response->withType("application/json")->withStringBody(json_encode($errors));
        }
        return $this->response->withType("application/json")->withStringBody(json_encode($this->ebayCheckoutSession->toArray()));
    }

    /**
     * Handle Payment Additional Data
     *
     * @param $payment
     * @return bool
     */
    protected function  handlePayment($payment)
    {
        $method = 'handlePayment' . Inflector::camelize(strtolower($payment['payment_method_type']));

        if (method_exists($this, $method)) {
            return $this->{$method}($payment);
        }

        return false;
    }

    /**
     * Handle Payment Wallet
     *
     * @param $payment
     * @return array|bool|mixed
     * @throws \Exception
     */
    protected function handlePaymentWallet($payment)
    {
        if (empty($payment['additionalData']['payerID'])) {
            $initiateGuestPayment = new InitiateGuestPaymentRequest();

            $initiateGuestPayment->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);
            $initiateGuestPayment->setPaymentMethodBrandType(InitiateGuestPaymentRequest::PAYMENT_METHOD_BRAND_TYPE_PAYPAL_CHECKOUT);
            $initiateGuestPayment->setPaymentMethodType(InitiateGuestPaymentRequest::PAYMENT_METHOD_TYPE_WALLET);

            $response = $this->EbayBuyApi
                ->setAccount($this->ebayAccount)
                ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                ->callOrderApi($initiateGuestPayment);

            if (isset($response->errors)) {
                return ['errors' => $this->handleEbayResponseErrors($response)];
            }

            if (
                isset($response->providedPaymentInstrument->paymentMethodType)
                && !empty($response->providedPaymentInstrument->paymentInstrumentReference->externalReferenceId)
            ) {
                $this->ebayCheckoutSession->payment_initiated = 1;
                $this->saveEbayCheckoutSession();
                return ['externalReferenceId' => $response->providedPaymentInstrument->paymentInstrumentReference->externalReferenceId];
            }

            return $response;
        }

        $wallet = new Wallet();
        $wallet->setPaymentToken($payment['additionalData']['payerID']);

        $updatePaymentRequest = new UpdateGuestPaymentInfoRequest();
        $updatePaymentRequest->setWallet($wallet);
        $updatePaymentRequest->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);

        $response = $this->EbayBuyApi
            ->setAccount($this->ebayAccount)
            ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
            ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
            ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
            ->callOrderApi($updatePaymentRequest);

        if (isset($response->errors)) {
            return ['errors' => $this->handleEbayResponseErrors($response)];
        }

        return ['success' => true];
    }

    /**
     * cart
     */
    public function cart()
    {
        if (!$this->ebayCheckoutSession->form_key) {
            $formKey = bin2hex(openssl_random_pseudo_bytes(15));
            $this->ebayCheckoutSession->form_key = $formKey;
            if (!$this->EbayCheckoutSessions->save($this->ebayCheckoutSession)) {
                throw new BadRequestException("Huups");
            }
        }

        $itemsNumber = 0;
        if (!empty($this->ebayCheckoutSession->ebay_checkout_session_items)) {
            foreach ($this->ebayCheckoutSession->ebay_checkout_session_items as $item) {
                $itemsNumber += $item->quantity;
            }
        }

        $this->set('itemsNumber', $itemsNumber);

        $this->set('maxItems', Configure::read('ebayCheckout.max_items', 10)); // there's a setting for this? NOW there is!
        $this->set('maxItemQuantity', Configure::read('ebayCheckout.max_item_quantity', 10));

        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->removeBehavior('SoftDelete');

        $query = $this->EbayCheckoutSessions->EbayCheckoutSessionItems
            ->find()
            ->cache(Application::USER_CACHE_KEY_CART_USER_DELETED_ITEMS . $this->getRequest()->getSession()->id())
            ->where([
                'is_deleted' => 1,
                'ebay_checkout_session_id' => $this->ebayCheckoutSession->id
            ]);

        $this->set('deletedItems', $query->toArray());

        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->addBehavior('SoftDelete');

        $checkoutUrl = \Cake\Routing\Router::url([
            'controller' => 'EbayCheckoutSessions',
            'action' => 'view',
            'plugin' => 'EbayCheckout',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid
        ]);

        $this->set('checkoutUrl', $checkoutUrl);

        $baseUrl = null;//Router::url('', true); // ATM not mandative..

        $this->set('socialLogins', [
            'ebay' => $baseUrl . $checkoutUrl,
            'facebook' => $baseUrl . $checkoutUrl,
            'google' => $baseUrl . $checkoutUrl,
            //'instagram' => $baseUrl . $checkoutUrl,
            'twitter' => $baseUrl . $checkoutUrl
        ]);
        //$this->set('feederHomepage', $this->loadModel('Feeder.FeederHomepages')->get(1));
        $this->set('title', __('Cart') . ' | CATCH');
    }
}
