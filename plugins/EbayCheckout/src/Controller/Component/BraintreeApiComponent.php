<?php

namespace EbayCheckout\Controller\Component;

use Cake\Controller\Component;
use Braintree\ClientToken;
use Braintree\Configuration;
use Cake\Core\Configure;
use Cake\Http\Client;
use EbayCheckout\Model\Entity\EbayCheckoutSessionBillingAddress;

/**
 * BraintreeAPi component
 */
class BraintreeApiComponent extends Component
{
    const BRAINTREE_ENDPOINT = [
        'sandbox' => 'https://forwarding.sandbox.braintreegateway.com/',
        'production' => 'https://forwarding.braintreegateway.com/'
    ];

    const UPDATE_PAYMENT_ENDPOINT = [
        'sandbox' => ''
    ];

    const GRAND_TYPE = 'client_credentials';
    const SCOPE = 'https://api.ebay.com/oauth/api_scope/buy.guest.order';

    protected $environment;
    protected $merchantId;
    protected $publicKey;
    protected $privateKey;

    /**
     * Initialize controller
     *
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
    }

    public function setCoreSellerUuid($uuid)
    {
        $this->environment = Configure::read('disco.' . $uuid . '.braintree.mode');
        $this->merchantId = Configure::read('disco.' . $uuid . '.braintree.' . $this->environment . '.merchant_id');
        $this->publicKey = Configure::read('disco.' . $uuid . '.braintree.' . $this->environment . '.public_key');
        $this->privateKey = Configure::read('disco.' . $uuid . '.braintree.' . $this->environment . '.private_key');
        Configuration::environment($this->environment);
        Configuration::merchantId($this->merchantId);
        Configuration::publicKey($this->publicKey);
        Configuration::privateKey($this->privateKey);
    }

    /**
     * Generate Client Token for Hosted fields
     *
     * Add to app config:
     * 'Braintree' => [
     *       'environment' => 'ENVIRONMENT', // sandbox or live
     *       'merchant_id' => 'MERCHANT_ID',
     *       'public_key' => 'PUBLIC_KEY',
     *       'private_key' => 'PRIVATE_KEY'
     *   ]
     *
     * @return array
     */
    public function generateClientToken()
    {
        return ClientToken::generate();
    }

    /**
     * Update Payment
     *
     * @param $checkoutSessionId
     * @param $ebayAccessToken
     * @param $nonce
     * @param $deviceData
     * @param EbayCheckoutSessionBillingAddress $billingAddress
     * @param null $ebayGlobalId
     * @return bool|mixed
     */
    public function updatePaymentInformation(
        $checkoutSessionId,
        $ebayAccessToken,
        $nonce,
        $deviceData,
        EbayCheckoutSessionBillingAddress $billingAddress,
        $ebayGlobalId = null
    )
    {
        $body = [
            'payment_method_nonce' => $nonce,
            'url' => 'https://api' . ($this->environment == 'sandbox' ? '.sandbox' : 'x') . '.ebay.com/buy/order/v1/guest_checkout_session/' . urlencode($checkoutSessionId) . '/update_payment_info',
            'method' => 'POST',
            'sensitive_data' => $this->buildSensitiveData(['ebay_access_token' => $ebayAccessToken]),
            'name' => 'ebay_update_guest_payment_info',
            'device_data' => $deviceData,
            'override' => [
                'body' => $this->buildBody($billingAddress)
            ],
            'data' => [
                'ebay_marketplace_id' => $ebayGlobalId
            ]
        ];
        return $this->makeForwardCall($body);
    }


    protected function buildSensitiveData()
    {
        $args = func_get_args();
        $sensitiveData = [];
        foreach ($args as $name => $arg) {
            if (is_array($arg)) {
                $sensitiveData += $arg;
            } else {
                $sensitiveData[$name] = $arg;
            }
        }
        return $sensitiveData;
    }

    /**
     * @deprecated
     * @return array|string
     */
    protected function getPaymentInformationCallConfig()
    {
        $config = [
            'name' => 'update-payment-information',
            'url' => '^https:\/\/api\.sandbox\.ebay\.com\/buy\/order\/v1\/guest_checkout_session\/.*\/update_payment_info$',
            'methods' => ['POST'],
            'types' => ['CreditCard'],
            'request_format' => [
                '/body' => 'json'
            ],
            'transformations' => [
                [
                    'path' => '/body/creditCard/cardNumber',
                    'value' => '$number'
                ],
                [
                    'path' => '/body/creditCard/cvvNumber',
                    'value' => '$cvv'
                ],
                [
                    'path' => '/body/creditCard/brand',
                    'value' => '$card_type'
                ],
                [
                    'path' => '/body/creditCard/expireMonth',
                    'value' => '$expiration_month'
                ],
                [
                    'path' => '/body/creditCard/expireYear',
                    'value' => '$expiration_year'
                ],
                [
                    'path' => '/body/creditCard/accountHolderName',
                    'value' => [
                        'join',
                        ' ',
                        [
                            'array',
                            '$first_name',
                            '$last_name'
                        ]
                    ]
                ],
                [
                    'path' => '/body/creditCard/billingAddress/addressLine1',
                    'value' => '$address_line_1'

                ],
                [
                    'path' => '/body/creditCard/billingAddress/addressLine2',
                    'value' => '$address_line_2'
                ],
                [
                    'path' => '/body/creditCard/billingAddress/city',
                    'value' => '$city'
                ],
                [
                    'path' => '/body/creditCard/billingAddress/country',
                    'value' => '$country'
                ],
                [
                    'path' => '/body/creditCard/billingAddress/county',
                    'value' => '$county'
                ],
                [
                    'path' => '/body/creditCard/billingAddress/postalCode',
                    'value' => '$postal_code'
                ],
                [
                    'path' => '/body/creditCard/billingAddress/stateOrProvince',
                    'value' => '$state_or_province'
                ]
            ]
        ];
        return $config;
    }

    /**
     * Make Forward Call
     * @param array $body
     * @return bool|mixed
     */
    protected function makeForwardCall(array $body)
    {
        if (!isset($body['merchant_id'])) {
            $body['merchant_id'] = $this->merchantId;
        }
        if (is_array($body)) {
            $body = json_encode($body);
        }

        $client = new Client();
        $response = $client->post(
            self::BRAINTREE_ENDPOINT[$this->environment],
            $body,
            [
                'auth' => [
                    'username' => $this->publicKey,
                    'password' => $this->privateKey
                ],
                'type' => 'json'
            ]
        );

        if (isset($response->json['body'])) {
            return json_decode($response->json['body']);
        }

        if (isset($response->json['error'])) {
            return $response->json;
        }

        return false;
    }


    /**
     * @param $billingAddress
     * @return array
     */
    protected function buildBody($billingAddress)
    {
        $billingAddressBody = [];

        if ($billingAddress->first_name) {
            $billingAddressBody['firstName'] = $billingAddress->first_name;
        }

        if ($billingAddress->last_name) {
            $billingAddressBody['lastName'] = $billingAddress->last_name;
        }

        if ($billingAddress->address_line_1) {
            $billingAddressBody['addressLine1'] = $billingAddress->address_line_1;
        }

        if ($billingAddress->address_line_2) {
            $billingAddressBody['addressLine2'] = $billingAddress->address_line_2;
        }

        if ($billingAddress->city) {
            $billingAddressBody['city'] = $billingAddress->city;
        }

        if ($billingAddress->country) {
            $billingAddressBody['country'] = $billingAddress->country;
        }

        if ($billingAddress->county) {
            $billingAddressBody['county'] = $billingAddress->county;
        }

        if ($billingAddress->postal_code) {
            $billingAddressBody['postalCode'] = $billingAddress->postal_code;
        }

        if ($billingAddress->state_or_province) {
            $billingAddressBody['stateOrProvince'] = $billingAddress->state_or_province;
        }

        $body = [
            'creditCard' =>
                [
                    'accountHolderName' => $billingAddress->first_name . ' ' . $billingAddress->last_name,
                    'billingAddress' => $billingAddressBody
                ]
        ];

        return $body;
    }
}
