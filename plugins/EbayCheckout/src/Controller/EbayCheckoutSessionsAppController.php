<?php

namespace EbayCheckout\Controller;

use App\Application;
use App\Controller\AppController as BaseController;
use App\Model\Table\CoreErrorsTable;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Ebay\Lib\BuyApi\OrderApi\Entity\LineItemInput;
use Ebay\Lib\BuyApi\OrderApi\Entity\ShippingAddress;
use Ebay\Lib\BuyApi\OrderApi\Request\ApplyGuestCoupon;
use Ebay\Lib\BuyApi\OrderApi\Request\InitiateGuestCheckoutSessionRequest;
use Ebay\Lib\BuyApi\OrderApi\Request\UpdateGuestShippingOptionRequest;
use Ebay\Model\Entity\EbayAccount;
use Ebay\Model\Table\EbayAccountsTable;
use EbayCheckout\Controller\Component\GetItemComponent;
use EbayCheckout\Model\Entity\EbayCheckout;
use EbayCheckout\Model\Entity\EbayCheckoutSession;
use EbayCheckout\Model\Entity\EbayCheckoutSessionItem;
use EbayCheckout\Model\Entity\EbayCheckoutSessionShippingAddress;
use EbayCheckout\Model\Entity\EbayCheckoutSessionTotal;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;
use Exception;
use Cake\Http\Response;

/**
 * Class EbayCheckoutSessionsAppController
 * @package EbayCheckout\Controller
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 * @property EbayAccountsTable $EbayAccounts
 * @property EbayBuyApiComponent $EbayBuyApi
 * @property GetItemComponent $GetItem
 */
class EbayCheckoutSessionsAppController extends BaseController
{
    /**
     * @var EbayCheckoutSession
     */
    public $ebayCheckoutSession;

    /**
     * @var CoreSeller
     */
    protected $coreSeller;

    /**
     * @var EbayCheckout
     */
    protected $ebayCheckout;

    /**
     * @var EbayAccount
     */
    protected $ebayAccount;

    const ALLOWED_PAYMENT_METHODS = ['WALLET'];

    /**
     * @throws Exception
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('EbayCheckout.GetItem');
    }


    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return Response|void|null
     * @throws Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->initCheckout();
    }

    /**
     * Init Checkout
     *
     * @TODO Clean up an move parts to better places
     */
    protected function initCheckout()
    {
        $uuid = $this->request->getParam('uuid');

        if (!$uuid) {
            throw new NotFoundException(__('CoreSellerCode not found.'));
        }

        if (!Configure::read('ebayCheckout.enable_checkout', false)) {
            throw new NotFoundException(__('Nothing here.'));
        }

        $this->coreSeller = $this->EbayCheckoutSessions->CoreSellers->find('all')
            ->where(['CoreSellers.uuid' => $uuid])
            ->cache('initCheckoutCoreSeller' . $uuid, Application::SHORT_TERM_CACHE)
            ->first();

        if (!$this->coreSeller) {
            throw new NotFoundException(__('CoreSeller not found.'));
        }

        /*if (!$this->request->getSession()->read('EbayCheckout.session_token') && $this->request->getQuery('token')) {
            $this->request->getSession()->write('EbayCheckout.session_token', $this->request->getQuery('token'));
        }*/

        if ($this->request->getSession()->read('EbayCheckout.session_token')) {
            $this->ebayCheckoutSession = $this->EbayCheckoutSessions
                ->find('all')
                ->contain(
                    [
                        'CoreSellers',
                        'EbayCheckouts',
                        'EbayCheckoutSessionItems',
                        'EbayCheckoutSessionItems.EbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings',
                        'EbayCheckoutSessionShippingAddresses',
                        'EbayCheckoutSessionBillingAddresses',
                        'EbayCheckoutSessionPayments',
                        'EbayCheckoutSessionTotals',
                        'SelectedEbayCheckoutSessionPayments',
                    ]
                )
                ->where([
                    'EbayCheckoutSessions.session_token' => $this->request->getSession()->read('EbayCheckout.session_token')
                ])
                ->cache(Application::USER_CACHE_KEY_INIT_CHECKOUT_SESSION . $this->getRequest()->getSession()->id())
                ->first();
        }

        if (isset($this->ebayCheckoutSession)) {
            if ($this->ebayCheckoutSession->purchase_order_id && $this->request->getParam('action') !== 'success') {
                $this->ebayCheckoutSession = null;
                $this->request->getSession()->write('EbayCheckout.session_token', null);
            }
        }

        if (!$this->ebayCheckoutSession) {
            $ebayCheckout = $this->EbayCheckoutSessions->EbayCheckouts
                ->find('all')
                ->where([
                    'EbayCheckouts.core_seller_id' => $this->coreSeller->id
                ])
                ->cache('ebay_checkout_entity', Application::SHORT_TERM_CACHE)
                ->first();

            if (!$ebayCheckout) {
                throw new NotFoundException(__('CoreSeller has no checkout.'));
            }

            $sessionToken = bin2hex(openssl_random_pseudo_bytes(50));
            $this->ebayCheckoutSession = $this->EbayCheckoutSessions->newEntity();
            $this->ebayCheckoutSession->session_token = $sessionToken;
            $this->ebayCheckoutSession->core_seller = $this->coreSeller;
            $this->ebayCheckoutSession->ebay_checkout = $ebayCheckout;
            $this->ebayCheckoutSession->type = EbayCheckoutSession::GUEST;

            $customer = $this->Auth->user();
            $this->ebayCheckoutSession->customer_id = $customer->id ?? null;

            $this->EbayCheckoutSessions->save($this->ebayCheckoutSession);
            $this->request->getSession()->write('EbayCheckout.session_token', $sessionToken);
        }

        if ($this->ebayCheckoutSession->core_seller_id != $this->coreSeller->id) {
            throw new BadRequestException(__('Something went really wrong.'));
        }

        $this->set('ebayCheckoutSession', $this->ebayCheckoutSession);
        $this->set('coreSeller', $this->coreSeller);

        if (Configure::read('disco.' . $uuid . '.braintree.mode', false) && !$this->request->getSession()->read('EbayCheckout.bt_client_token')) {
            try {
                $this->loadComponent('EbayCheckout.BraintreeApi');
                $this->BraintreeApi->setCoreSellerUuid($uuid);
                $this->request->getSession()->write(
                    'EbayCheckout.bt_client_token', $this->BraintreeApi->generateClientToken()
                );
            } catch (\Exception $e) {
                throw new InternalErrorException($e->getMessage());
            }
        }

        $this->checkFormKey();

        $this->loadModel('Ebay.EbayAccounts');
        $this->loadComponent('Ebay.EbayBuyApi');

        if ($this->ebayCheckoutSession->ebay_global_id) {
            $this->EbayBuyApi->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id);
        }
        if ($this->ebayCheckoutSession->country_code) {
            $this->EbayBuyApi->setLocationCountryCode($this->ebayCheckoutSession->country_code);
        }

        $mode = Configure::read('disco.' . $uuid . '.mode');
        $accountId = Configure::read('disco.' . $uuid . '.ebay.' . $mode . '_account_id');

        $this->ebayAccount = $this->EbayAccounts->find()
            ->where(['EbayAccounts.id' => $accountId])
            ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
            ->cache('CheckoutSessionAppEbayAccount' . $accountId, Application::SHORT_TERM_CACHE)
            ->first();
    }

    /**
     * Check Origin
     */
    protected function checkOrigin()
    {
        $referer = $this->referer();

        if (!$referer || $referer == '/') {
            throw new BadRequestException('Referer not found.');
        }
        $checkoutUrl = Router::url([
            'action' => 'view',
            'uuid' => $this->ebayCheckoutSession->core_seller->uuid
        ], true);

        $baseUrl = Router::url('/', true);
        if ($this->request->is('ajax')) {
            if ($referer != $checkoutUrl) {
                throw new BadRequestException('Checkout invalid.');
            }
        } else {
            if ($referer == $checkoutUrl) {
                return true;
            }
            if (strpos($referer, $baseUrl) === 0) {
                return true;
            }
            $parsedReferer = parse_url($referer);
            $allowedUrls = $this->ebayCheckoutSession->ebay_checkout->x_frame_origins;
            $requestDomain = $parsedReferer['scheme'] . '://' . $parsedReferer['host'];
            $requestAllowed = false;
            foreach (explode(',', $allowedUrls) as $allowedUrl) {
                if (strpos($allowedUrl, $requestDomain) === 0) {
                    $requestAllowed = true;
                    $this->response = $this->response->withHeader('X-Frame-Options', 'ALLOW-FROM ' . trim($allowedUrl));
                    break;
                }
            }

            if (!$requestAllowed) {
                throw new BadRequestException('Request not allowed.');
            }
        }
    }

    /**
     * Prepare ajax request
     *
     * @param string $method
     */
    protected function checkAjax($method = 'get')
    {
        $this->viewBuilder()->setClassName('Json');
        $this->viewBuilder()->setLayout('ajax');

        if (!$this->request->is('ajax')) {
            throw new BadRequestException(__('Only ajax calls are accepted'));
        }

        if (!$this->request->is($method)) {
            throw new BadRequestException(__('Wrong Method'));
        }
    }

    /**
     * Json error
     *
     * @param $message
     * @param int $statusCode
     */
    protected function jsonError($message, $statusCode = 500)
    {
        $this->set('error', $message);
        $this->set('_serialize', ['error']);
    }

    /**
     * Sync eBay Checkout
     *
     * @TODO REFACTOR! Maybe move to EbayCheckoutSessionModel
     * @param $response
     * @return array|bool
     */
    protected function syncEbayCheckoutSession($response)
    {
        if (
            $this->ebayCheckoutSession->ebay_checkout_session_id
            && $this->ebayCheckoutSession->ebay_checkout_session_id != $response->checkoutSessionId
        ) {
            throw new BadRequestException('Checkout session error');
        }
        $this->ebayCheckoutSession->ebay_checkout_session_id = $response->checkoutSessionId;
        $shippingChanged = $this->syncEbayCheckoutSessionItemsAndShippings($response);
        $this->syncEbayCheckoutSessionPayments($response);
        $this->syncEbayCheckoutSessionTotals($response);

        if (isset($response->appliedCoupons[0]->redemptionCode)) {
            $this->ebayCheckoutSession->redemption_code = $response->appliedCoupons[0]->redemptionCode;
        } else {
            $this->ebayCheckoutSession->redemption_code = null;
        }

        $this->saveEbayCheckoutSession();

        if (!empty($shippingChanged)) {
            $shippingErrors = [];
            $shippingUpdated = false;
            foreach ($this->ebayCheckoutSession->ebay_checkout_session_items as $sessionItem) {
                if (isset($shippingChanged[$sessionItem->ebay_item_id])) {
                    if ($sessionItem->selected_ebay_checkout_session_item_shipping) {
                        try {
                            $updateShippingOption = new UpdateGuestShippingOptionRequest();
                            $updateShippingOption->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);
                            $updateShippingOption->setLineItemId($sessionItem->ebay_line_item_id)
                                ->setShippingOptionId($shippingChanged[$sessionItem->ebay_item_id]->shippingOptionId);

                            $response = $this->EbayBuyApi
                                ->setAccount($this->ebayAccount)
                                ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
                                ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
                                ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
                                ->callOrderApi($updateShippingOption);

                            if (isset($response->errors)) {
                                $shippingErrors = $this->handleEbayResponseErrors($response);
                            } else {
                                $shippingUpdated = true;
                            }
                        } catch (\Exception $e) {
                            $shippingErrors['error'] = true;
                            $shippingErrors['message'] = $e->getMessage();
                        }
                    }
                }
            }
            if ($shippingUpdated) {
                $this->syncEbayCheckoutSessionTotals($response);
                $this->saveEbayCheckoutSession();
            }
            if (!empty($shippingErrors)) {
                return $shippingErrors;
            }
        }
        return true;
    }

    /**
     * Sync Ebay Checkout Session Totals
     * @param $response
     */
    protected function syncEbayCheckoutSessionTotals($response)
    {
        $totals = [];
        foreach ($response->pricingSummary as $code => $pricingSummery) {
            /** @var EbayCheckoutSessionTotal $total */
            $total = $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->newEntity();
            $total->code = $code;
            if ($code == 'adjustment') {
                $total->label = $pricingSummery->label ?? null;
                $total->currency = $pricingSummery->adjustment->currency ?? null;
                $total->value = $pricingSummery->adjustment->value ?? null;
            } else {
                $total->currency = $pricingSummery->currency ?? null;
                $total->value = $pricingSummery->value ?? null;
            }
            if ($code == 'total') {
                $total->sort_order = 1;
            }
            $totals[] = $total;
        }
        $this->ebayCheckoutSession->ebay_checkout_session_totals = $totals;
    }

    /**
     * Save Ebay Checkout Session
     * @return array
     */
    protected function saveEbayCheckoutSession()
    {
        $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->setSaveStrategy('replace');
        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->setSaveStrategy('replace');
        $this->EbayCheckoutSessions->EbayCheckoutSessionPayments->setSaveStrategy('replace');
        $this->EbayCheckoutSessions->EbayCheckoutSessionItems->EbayCheckoutSessionItemShippings->setSaveStrategy('replace');

        if (!$this->EbayCheckoutSessions->save($this->ebayCheckoutSession,
            [
                'associated' => [
                    'EbayCheckoutSessionItems',
                    'EbayCheckoutSessionItems.EbayCheckoutSessionItemShippings',
                    'EbayCheckoutSessionShippingAddresses',
                    'EbayCheckoutSessionTotals',
                    'EbayCheckoutSessionPayments'
                ]
            ])) {
            return $this->ebayCheckoutSession->getErrors();
        }
    }

    /**
     * Sync Ebay Checkout Session Items And Shippings
     * @param $response
     * @return array
     */
    protected function syncEbayCheckoutSessionItemsAndShippings($response)
    {
        $items = [];
        $this->shippingChanged = [];
        $count = 0;
        foreach ($response->lineItems as $ebayLineItem) {
            $items[] = $this->syncItemAndShipping($ebayLineItem, null, $count);
            $count++;
        }

        $this->ebayCheckoutSession->ebay_checkout_session_items = $items;
        return $this->shippingChanged;
    }

    /**
     * @param $response
     */
    protected function syncEbayCheckoutSessionPayments($response)
    {

        if (!empty($response->acceptedPaymentMethods) && empty($this->ebayCheckoutSession->ebay_checkout_session_payments)) {
            $paymentMethods = [];
            foreach ($response->acceptedPaymentMethods as $acceptedPaymentMethod) {
                if (in_array($acceptedPaymentMethod->paymentMethodType, self::ALLOWED_PAYMENT_METHODS)) {
                    $paymentMethod = $this->EbayCheckoutSessions->EbayCheckoutSessionPayments->newEntity();
                    $paymentMethod->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
                    $paymentMethod->label = $acceptedPaymentMethod->label;
                    $paymentMethod->payment_method_type = $acceptedPaymentMethod->paymentMethodType;
                    array_unshift($paymentMethods, $paymentMethod);
                }
            }
            $this->ebayCheckoutSession->ebay_checkout_session_payments = $paymentMethods;
        }
    }

    /**
     * @param $ebayLineItem
     * @param null $newQty
     * @param $count - to identify the lineItem with the sessionItem
     * @return \Cake\Datasource\EntityInterface|EbayCheckoutSessionItem
     */
    protected function syncItemAndShipping($ebayLineItem, $newQty = null, $count = null)
    {
        $item = $this->EbayCheckoutSessions->EbayCheckoutSessionItems->newEntity();
        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items ?? [] as $key => $sessionItem) {
            /* @var EbayCheckoutSessionItem $item */
            if ($ebayLineItem->itemId == $sessionItem->ebay_item_id) {
                $item->id = $sessionItem->id;
                $item->quantity = $sessionItem->quantity;
                $item->ebay_category_path = $sessionItem->ebay_category_path;
                $item->top_rated_buying_experience = $sessionItem->top_rated_buying_experience;

                /**
                 * TODO: Needs proper bugfix
                 * weak workaround to get shipping information on the success page.
                 * Shipping information is not saved properly in checkout session.
                 * works only after shipping information is provided
                 */
                if (!isset($sessionItem->selected_ebay_checkout_session_item_shipping_id)) {
                    if (isset($ebayLineItem->shippingOptions[0]->shippingOptionId)) {
                        if (isset($count)) {
                            $item->selected_ebay_checkout_session_item_shipping_id = $this->ebayCheckoutSession->ebay_checkout_session_items[$count]->ebay_checkout_session_item_shippings[0]->id;
                        } else {
                            $item->selected_ebay_checkout_session_item_shipping_id = $this->ebayCheckoutSession->ebay_checkout_session_items[0]->ebay_checkout_session_item_shippings[0]->id;
                        }
                    }
                } else {
                    $item->selected_ebay_checkout_session_item_shipping_id = $this->ebayCheckoutSession->ebay_checkout_session_items[$count]->selected_ebay_checkout_session_item_shipping_id;
                }
            }
        }

        $item->title = $ebayLineItem->title ?? null;
        $item->short_description = $ebayLineItem->shortDescription ?? null;
        $item->image = $ebayLineItem->image->imageUrl ?? null;
        $item->seller_username = $ebayLineItem->seller->username ?? null;
        if ($item->quantity) {
            $newQty = $item->quantity + $newQty;
        }
        if ($newQty > Configure::read('ebayCheckout.max_item_quantity', 10)) {
            $newQty = Configure::read('ebayCheckout.max_item_quantity', 10);
            $this->Flash->error(__('Max item quantity of {0} reached on one of your items.', $newQty), ['key' => 'max_item_quantity']);
        }
        $item->quantity = $newQty;
        $item->ebay_item_id = $ebayLineItem->itemId ?? null;

        if (isset($ebayLineItem->categoryPath)) {
            $item->ebay_category_path = $ebayLineItem->categoryPath;
        }
        if (isset($ebayLineItem->topRatedBuyingExperience)) {
            $item->top_rated_buying_experience = $ebayLineItem->topRatedBuyingExperience;
        }

        $item->ebay_line_item_id = $ebayLineItem->lineItemId ?? null;

        $item->selected_ebay_checkout_session_item_shipping = $this->ebayCheckoutSession->ebay_checkout_session_items[$count]->selected_ebay_checkout_session_item_shipping ?? null;

        if (isset($ebayLineItem->price->value)) {
            $item->base_price_value = $ebayLineItem->price->value;
        }

        if (isset($ebayLineItem->price->currency)) {
            $item->base_price_currency = $ebayLineItem->price->currency;
        }

        if (isset($ebayLineItem->baseUnitPrice->value)) {
            $item->base_price_value = $ebayLineItem->baseUnitPrice->value;
        }

        if (isset($ebayLineItem->baseUnitPrice->currency)) {
            $item->base_price_currency = $ebayLineItem->baseUnitPrice->currency;
        }

        $item->net_price_value = $ebayLineItem->netPrice->value ?? null;
        $item->net_price_currency = $ebayLineItem->netPrice->currency ?? null;
        $shippingOptions = [];
        $shippingIdCount = 0;
        foreach ($ebayLineItem->shippingOptions ?? [] as $ebayShippingOption) {
            if ($ebayShippingOption->shippingServiceCode == 'eBayPlus') {
                continue;
            }
            $shipping = $this->EbayCheckoutSessions->EbayCheckoutSessionItems->EbayCheckoutSessionItemShippings->newEntity();

            # removed as part of shipping chaos fix (WD-996)
            /*if(isset($item->selected_ebay_checkout_session_item_shipping)){
                foreach ($item->selected_ebay_checkout_session_item_shipping ?? [] as $shippingOption) {
                    /** @var EbayCheckoutSessionItemShipping $shipping */
            /*if ($ebayShippingOption->shippingOptionId == $shippingOption->shipping_option_id) {
                $shipping->id = $shippingOption->id;
            }
        }
            }*/
            if (isset($count)) {
                $shipping->id = $this->ebayCheckoutSession->ebay_checkout_session_items[$count]->ebay_checkout_session_item_shippings[$shippingIdCount]->id ?? null;
            }
            $shippingIdCount++;
            $shipping->ebay_checkout_session_item_id = $item->id;
            $shipping->shipping_option_id = $ebayShippingOption->shippingOptionId ?? null;
            $shipping->shipping_carrier_code = $ebayShippingOption->shippingCarrierCode ?? null;
            $shipping->shipping_service_code = $ebayShippingOption->shippingServiceCode ?? null;
            if (isset($ebayShippingOption->minEstimatedDeliveryDate)) {
                $shipping->min_estimated_delivery_date = date('Y-m-d H:i:s',
                    strtotime($ebayShippingOption->minEstimatedDeliveryDate));
            }
            if (isset($ebayShippingOption->maxEstimatedDeliveryDate)) {
                $shipping->max_estimated_delivery_date = date('Y-m-d H:i:s',
                    strtotime($ebayShippingOption->maxEstimatedDeliveryDate));
            }

            if (isset($ebayShippingOption->shippingCost->value)) {
                $additionalValue = 0;
                if ($item->quantity && $item->quantity > 1 && isset($ebayShippingOption->additionalShippingCostPerUnit->value)) {
                    $additionalValue = $item->quantity * (float)$ebayShippingOption->additionalShippingCostPerUnit->value;
                }
                $shipping->base_delivery_cost_value = $ebayShippingOption->shippingCost->value + $additionalValue;
            }

            if (isset($ebayShippingOption->shippingCost->currency)) {
                $shipping->base_delivery_cost_currency = $ebayShippingOption->shippingCost->currency;
            }

            if (isset($ebayShippingOption->baseDeliveryCost->value)) {
                $shipping->base_delivery_cost_value = $ebayShippingOption->baseDeliveryCost->value;
            }
            if (isset($ebayShippingOption->baseDeliveryCost->currency)) {
                $shipping->base_delivery_cost_currency = $ebayShippingOption->baseDeliveryCost->currency;
            }

            if (isset($ebayShippingOption->additionalShippingCostPerUnit->value)) {
                $shipping->additional_unit_cost_value = $ebayShippingOption->additionalShippingCostPerUnit->value;
            }
            if (isset($ebayShippingOption->additionalShippingCostPerUnit->currency)) {
                $shipping->additional_unit_cost_currency = $ebayShippingOption->additionalShippingCostPerUnit->currency;
            }

            if (isset($ebayShippingOption->selected) && !$ebayShippingOption->selected) {
                if (isset($ebayShippingOption->shippingServiceCode)
                    && isset($item->selected_ebay_checkout_session_item_shipping)
                    && $item->selected_ebay_checkout_session_item_shipping->shipping_service_code == $ebayShippingOption->shippingServiceCode)
                {
                    $this->shippingChanged[$item->ebay_item_id] = $ebayShippingOption;
                }
            }
            $shippingOptions[] = $shipping;
        }
        $item->ebay_checkout_session_item_shippings = $shippingOptions;

        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items ?? [] as $key => $sessionItem) {
            /* @var EbayCheckoutSessionItem $item */
            if ($ebayLineItem->itemId == $sessionItem->ebay_item_id) {
                unset($this->ebayCheckoutSession->ebay_checkout_session_items[$key]);
            }
        }

        return $item;
    }

    /**
     * Sync Totals Without Ebay Checkout Session
     */
    protected function syncTotalsWithoutEbayCheckoutSession($shippingId = null, $itemId = null)
    {
        $currency = null;
        $priceSubtotalValue = 0;
        $deliveryCostValue = 0;
        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items ?? [] as $item) {
            if ($item->is_deleted) {
                continue;
            }
            if (!$currency) {
                $currency = $item->base_price_currency;
            }
            $priceSubtotalValue += $item->base_price_value * $item->quantity;
            $shippingFound = false;
            if (!empty($item->ebay_checkout_session_item_shippings)) {
                foreach ($item->ebay_checkout_session_item_shippings as $itemShipping) {
                    if ($itemShipping->shipping_service_code == 'eBayPlus') {
                        continue;
                    }
                    if (($item->id == $itemId && $itemShipping->shipping_service_code == $shippingId) || $item->selected_ebay_checkout_session_item_shipping_id == $itemShipping->id) {
                        $deliveryCostValue += $itemShipping->base_delivery_cost_value;
                        if ($item->quantity > 1 && !empty($itemShipping->additional_unit_cost_value)) {
                            $deliveryCostValue += ($item->quantity - 1) * $itemShipping->additional_unit_cost_value;
                        }
                        $shippingFound = true;
                        break;
                    }
                }
                if (!$shippingFound) {
                    $deliveryCostValue += $item->ebay_checkout_session_item_shippings[0]->base_delivery_cost_value;
                    if ($item->quantity > 1 && !empty($item->ebay_checkout_session_item_shippings[0]->additional_unit_cost_value)) {
                        $deliveryCostValue += ($item->quantity - 1) * $item->ebay_checkout_session_item_shippings[0]->additional_unit_cost_value;
                    }
                }
            }
        }

        $totals = [];

        $total = $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->newEntity();
        $total->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
        $total->code = 'total';
        $total->currency = $currency;

        //Pre calc totals
        $priceSubtotal = $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->newEntity();
        $priceSubtotal->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
        $priceSubtotal->code = 'priceSubtotal';
        $priceSubtotal->currency = $currency;
        $priceSubtotal->value = $priceSubtotalValue;

        $totals[] = $priceSubtotal;

        if ($deliveryCostValue) {
            $deliveryCost = $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->newEntity();
            $deliveryCost->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
            $deliveryCost->code = 'deliveryCost';
            $deliveryCost->currency = $currency;
            $deliveryCost->value = $deliveryCostValue;
            $totals[] = $deliveryCost;
        }

        //Pre calc totals
        $tax = $this->EbayCheckoutSessions->EbayCheckoutSessionTotals->newEntity();
        $tax->ebay_checkout_session_id = $this->ebayCheckoutSession->id;
        $tax->code = 'tax';
        $tax->currency = $currency;
        $tax->value = "0.00";

        $totals[] = $tax;

        $total->value = $priceSubtotalValue + $deliveryCostValue;

        $totals[] = $total;

        $this->ebayCheckoutSession->ebay_checkout_session_totals = $totals;
    }


    /**
     * Checks if form key is valid
     */
    protected function checkFormKey()
    {
        $needsValidFormKey = [
            'submit',
            'getItems',
            'saveShippingAddress',
            'getPayment',
            'savePayment',
            'getTotals',
            'saveQty',
            'saveShipping'
        ];

        if (!Configure::read('dealsguru.debug.success_page', false)) {
            $needsValidFormKey[] = 'success';
        }
        
        if (in_array($this->request->getParam('action'), $needsValidFormKey)) {
            //todo later
            //if (!$this->request->getQuery('key') || $this->request->getQuery('key') != $this->ebayCheckoutSession->form_key) {
                if (!$this->request->getQuery('key') || $this->request->getQuery('key') != '3d92161d3be2c65a7169bc1a98ad3d') {
                throw new BadRequestException(__('Only ajax calls are accepted'));
            }
        }
    }

    /**
     * Parse eBay API Response messages errors.
     * @param $response
     * @return array
     */
    protected function handleEbayResponseErrors($response)
    {
        $errors = [];

        /** @var CoreErrorsTable $coreErrors */
        $coreErrors = TableRegistry::getTableLocator()->get('CoreErrors');

        if (isset($response->errors)) {
            $errors['error'] = true;
            foreach ($response->errors as $error) {
                $errors['message'] = $this->humanizeEbayResponseErrors($error->message);

                $rlogid = $response->rlogid ?? null;
                $ebayCheckoutSessionId = $this->ebayCheckoutSession->ebay_checkout_session_id ?? null;

                $coreErrors->logError(null, $error->errorId, '', $error->message, null, null, 'Error ' . $error->domain, $rlogid, $ebayCheckoutSessionId);
            }
        }

        return $errors;
    }

    /**
     * Parse eBay API Response messages warnings.
     * @param $response
     * @return array
     */
    protected function handleEbayResponseWarnings($response)
    {
        $warnings = [];

        /** @var CoreErrorsTable $coreErrors */
        $coreErrors = TableRegistry::getTableLocator()->get('CoreErrors');

        if (isset($response->warnings)) {
            $warnings['error'] = true;
            foreach ($response->warnings as $warning) {
                $warnings['message'] = $this->humanizeEbayResponseErrors($warning->message);

                $rlogid = $response->rlogid ?? null;
                $ebayCheckoutSessionId = $this->ebayCheckoutSession->ebay_checkout_session_id ?? null;

                $coreErrors->logError(null, $warning->errorId, '', $warning->message, null, null, 'Warning ' . $warning->domain, $rlogid, $ebayCheckoutSessionId);
            }
        }

        return $warnings;
    }

    /**
     * Humanize eBay API response messages
     * @param $message
     * @return null|string
     */
    protected function humanizeEbayResponseErrors($message)
    {
        if ($message == 'Invalid field: phoneNumber. The indicated field contains an invalid value. Correct the value and resubmit the call.') {
            return __('Unfortunately the entered phone numbers contains superfluous characters. Please re-check!');
        }
        if ($message == 'Invalid field: postalCode. The indicated field contains an invalid value. Correct the value and resubmit the call.') {
            return __('Unfortunately the entered postal code contains superfluous characters. Please re-check!');
        }
        if ($message == 'Invalid field: contactEmail. The indicated field contains an invalid value. Correct the value and resubmit the call.') {
            return __('Unfortunately the entered email contains superfluous characters. Please re-check!');
        }
        if (strpos($message, 'Missing field :') === 0) {
            $field = $this->getFieldNameFromError($message);
            if ($field) {
                return __('Unfortunately you did not fill in the following field: {0}. Please provide the required information.',
                    $field);
            }
        }
        if (strpos($message, 'Invalid field:') === 0) {
            $field = $this->getFieldNameFromError($message);
            if ($field) {
                if ($field) {
                    return __('Unfortunately the field "{0}" contains superfluous characters. Please re-check!',
                        $field);
                }
            }
        }
        return __($message);
    }

    /**
     * Get Field name from message //Hax0r regex... I hate them...
     * @param $message
     * @return bool
     */
    protected function getFieldNameFromError($message)
    {
        $re1 = '.*?';
        $re2 = '(?:[a-z][a-z]+)';
        $re3 = '.*?';
        $re4 = '(?:[a-z][a-z]+)';
        $re5 = '.*?';
        $re6 = '((?:[a-z][a-z]+))';

        if ($c = preg_match_all("/" . $re1 . $re2 . $re3 . $re4 . $re5 . $re6 . "/is", $message, $matches)) {
            return $matches[1][0] ?? false;
        }
        return false;
    }

    /**
     * @param EbayCheckoutSessionShippingAddress $shippingAddress
     * @return ShippingAddress
     */
    protected function buildShippingAddressEntity($shippingAddress)
    {
        $apiShippingAddress = new ShippingAddress();

        if (empty($shippingAddress->phone_number)) {
            $shippingAddress->phone_number = '49' . rand(10**6, 10**7);
            $shippingAddress->random_phone_number = true;
        }

        return $apiShippingAddress->setRecipient($shippingAddress->recipient)
            ->setAddressLine1($shippingAddress->address_line_1)
            ->setAddressLine2($shippingAddress->address_line_2)
            ->setCity($shippingAddress->city)
            ->setPostalCode($shippingAddress->postal_code)
            ->setCountry($shippingAddress->country)
            ->setStateOrProvince($shippingAddress->state_or_province)
            ->setPhoneNumber($shippingAddress->phone_number);

    }

    /**
     * @param bool $skipRedemptionCode
     * @return bool|mixed
     * @throws \Exception
     */
    protected function initiateEbayCheckoutSession($skipRedemptionCode = false)
    {
        $initiateGuestCheckoutSessionRequest = new InitiateGuestCheckoutSessionRequest();
        $initiateGuestCheckoutSessionRequest
            ->setContactFirstName($this->ebayCheckoutSession->first_name)
            ->setContactLastName($this->ebayCheckoutSession->last_name)
            ->setContactEmail($this->ebayCheckoutSession->email)
            ->setShippingAddress($this->buildShippingAddressEntity($this->ebayCheckoutSession->ebay_checkout_session_shipping_address));

        foreach ($this->ebayCheckoutSession->ebay_checkout_session_items as $item) {
            /** @var EbayCheckoutSessionItem $item */
            $lineItem = new LineItemInput();
            $lineItem->setItemId($item->ebay_item_id)->setQuantity($item->quantity);
            $initiateGuestCheckoutSessionRequest->appendLineItemInput($lineItem);
        }

        $response = $this->EbayBuyApi
            ->setAccount($this->ebayAccount)
            ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
            ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
            ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
            ->callOrderApi($initiateGuestCheckoutSessionRequest);

        if (!$skipRedemptionCode && !isset($response->errors) && ($response->checkoutSessionId ?? false) && $this->ebayCheckoutSession->redemption_code) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = $response->checkoutSessionId;
            $response = $this->applyRedemptionCode($this->ebayCheckoutSession->redemption_code);
            if (isset($response->errors)) {
                $this->ebayCheckoutSession->redemption_code = null;
            }
        }
        $this->ebayCheckoutSession->payment_initiated = 0;

        return $response;
    }

    /**
     * @param $redemptionCode
     * @return bool|mixed
     * @throws \Exception
     */
    protected function applyRedemptionCode($redemptionCode)
    {
        $applyGuestCoupon = new ApplyGuestCoupon();
        $applyGuestCoupon->setCheckoutSessionId($this->ebayCheckoutSession->ebay_checkout_session_id);
        $applyGuestCoupon->setRedemptionCode($redemptionCode);

        return $this->EbayBuyApi
            ->setAccount($this->ebayAccount)
            ->setEbayGlobalId($this->ebayCheckoutSession->ebay_global_id ?? null)
            ->setAffiliateCampaignId($this->request->getSession()->read('EbayAffiliateCampaignId'))
            ->setAffiliateReferenceId($this->request->getSession()->read('EbayAffiliateReferenceId'))
            ->callOrderApi($applyGuestCoupon);
    }


    /**
     * @param null $paymentMethodType
     * @return array|bool|null
     * @throws \Exception
     */
    protected function checkPaymentInitized($paymentMethodType = null)
    {
        if ($this->ebayCheckoutSession->payment_initiated
            && (
                (
                    isset($this->ebayCheckoutSession->selected_ebay_checkout_session_payment)
                    && $this->ebayCheckoutSession->selected_ebay_checkout_session_payment->payment_method_type != $paymentMethodType
                )
                || $paymentMethodType == null
            )
        ) {
            $this->ebayCheckoutSession->ebay_checkout_session_id = null;
            $response = $this->initiateEbayCheckoutSession();
            $errors = [];
            if ($response->checkoutSessionId ?? null) {
                $success = $this->syncEbayCheckoutSession($response);
                if ($success !== true) {
                    $errors += $success;
                }

            }
            if (isset($response->errors)) {
                $errors += $this->handleEbayResponseErrors($response);
            }
            if (!$this->EbayCheckoutSessions->save($this->ebayCheckoutSession,
                ['associated' => 'EbayCheckoutSessionShippingAddresses'])) {
                $errors = $this->ebayCheckoutSession->getErrors();
                $errors += $this->ebayCheckoutSession->ebay_checkout_session_shipping_address->getErrors();
            }

            if (!empty($errors)) {
                return $errors;
            }
        }
        return null;
    }
}
