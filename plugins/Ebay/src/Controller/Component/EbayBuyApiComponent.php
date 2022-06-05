<?php

namespace Ebay\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Ebay\Lib\BuyApi\BrowseApi\Request\GetItemByItemGroupRequest;
use Ebay\Lib\BuyApi\BrowseApi\Request\GetItemRequest;
use Ebay\Lib\BuyApi\OrderApi\Security\Session as OrderApiSession;
use Ebay\Lib\BuyApi\BrowseApi\Security\Session as BrowseApiSession;
use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Lib\IdentityApi\Request\AuthorizeUserTokenRequest;
use Ebay\Lib\IdentityApi\Request\GetUserTokenRequest;
use Ebay\Lib\IdentityApi\Request\RefreshUserTokenRequest;
use Ebay\Lib\IdentityApi\Security\Session as IdentityApiSession;
use Ebay\Lib\Rest\BuyApi\MarketingApi\Security\Session as MarketingApiSession;
use Ebay\Lib\IdentityApi\Request\GetApplicationTokenRequest;
use Psr\Log\LogLevel;

/**
 * Class EbayBuyApiComponent
 * @package Ebay\Controller\Component
 *
 * @property \App\Controller\Component\CurrencyComponent $Currency
 */
class EbayBuyApiComponent extends Component
{
    protected $ebayAccount;
    protected $ebayGlobalId = 'EBAY-US';
    protected $locationCountryCode;
    protected $locationPostalCode;
    protected $affiliateReferenceId;
    protected $affiliateCampaignId;
    protected $ebayLoginRoverPixel = 'https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub={epn_account_id}&toolid=10001&campid={epn_campaign_id}&customid=&mpre={target_url}';
    protected $ebayLoginRoverPixelCampaignId;
    protected $ebayLoginRoverPixelAccountId;
    public $components = ['Currency'];
    const USER_REST_TOKEN_KEY = 'User.ebay_rest_token';
    const USER_REST_TOKEN_SCOPE_KEY = 'User.ebay_rest_token_scope';
    const USER_REST_TOKEN_EXPIRE_TIME_KEY = 'User.ebay_rest_token_expire_time';
    const USER_REST_REFRESH_TOKEN_KEY = 'User.ebay_rest_refresh_token';
    const USER_REST_REFRESH_TOKEN_EXPIRE_TIME_KEY = 'User.ebay_rest_refresh_token_expire_time';
    const USER_REST_TOKEN_REQUEST_ID_KEY = 'User.ebay_rest_request_id';

    /**
     * Set eBay Account related for the api call
     *
     * @param $ebayAccount
     * @return $this
     */
    public function setAccount($ebayAccount)
    {
        if (!isset($this->ebayAccount->id) || $this->ebayAccount->id != $ebayAccount->id) {
            $this->ebayAccount = $ebayAccount;
        }
        return $this;
    }

    /**
     * @param string|null $epnCampaignId
     */
    public function setEbayLoginRoverPixelCampaignId(string $epnCampaignId = null)
    {
        $this->ebayLoginRoverPixelCampaignId = $epnCampaignId;
        return $this;
    }

    /**
     * @param string|null $epnAccountId
     */
    public function setEbayLoginRoverPixelAccountId(string $epnAccountId = null)
    {
        $this->ebayLoginRoverPixelAccountId = $epnAccountId;
        return $this;
    }

    /**
     * Set Ebay Global Id for the specific Ebay Site
     * @param $ebayGlobalId
     * @return $this
     */
    public function setEbayGlobalId($ebayGlobalId)
    {
        if (!empty($ebayGlobalId)) {
            $this->ebayGlobalId = $ebayGlobalId;
        }
        return $this;
    }

    /**
     * Set User Location country Code
     *
     * @param $countryCode
     * @return $this
     */
    public function setLocationCountryCode($countryCode)
    {
        $this->locationCountryCode = $countryCode;
        return $this;
    }

    /**
     * Set User location postal code
     * @param $postalCode
     * @return $this
     */
    public function setLocationPostalCode($postalCode)
    {
        $this->locationPostalCode = $postalCode;
        return $this;
    }

    /**
     * Set AffiliateReferenceId
     * @param $affiliateReferenceId
     * @return $this
     */
    public function setAffiliateReferenceId($affiliateReferenceId)
    {
        $this->affiliateReferenceId = $affiliateReferenceId;
        return $this;
    }

    /**
     * Set AffiliateCampaignId
     * @param $affiliateCampaignId
     * @return $this
     */
    public function setAffiliateCampaignId($affiliateCampaignId)
    {
        $this->affiliateCampaignId = $affiliateCampaignId;
        return $this;
    }

    /**
     * Get current AffiliateReferenceId
     *
     * @return mixed
     */
    public function getAffiliateReferenceId()
    {
        return $this->affiliateReferenceId;
    }

    /**
     *  Get current AffiliateCampaignId
     *
     * @return mixed
     */
    public function getAffiliateCampaignId()
    {
        return $this->affiliateCampaignId;
    }

    /**
     * Execute Buy REST order API call
     *
     * @param $request
     * @param bool $forceTokenRefresh
     * @return bool|mixed
     * @throws \Exception
     */
    public function callOrderApi($request, $forceTokenRefresh = false)
    {
        $session = new OrderApiSession();
        if (empty($this->affiliateReferenceId) && empty($this->affiliateCampaignId)) {
            if (!empty($this->ebayAccount->epn_identifier)) {
                $epnData = explode(',', str_replace(';', ',', $this->ebayAccount->epn_identifier));
                $this->affiliateReferenceId = $epnData[0] ?? '';
                $this->affiliateCampaignId = $epnData[1] ?? '';
            }
        }

        return $session
            ->setRequestBody($request)
            ->setAccessToken($this->getAccessToken($request->getTokenType(), $request->getScope(), $forceTokenRefresh))
            ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
            ->setEbayGlobalId($this->ebayGlobalId)
            ->setUserLocation($this->locationCountryCode, $this->locationPostalCode)
            ->setAffiliateReference($this->getAffiliateReferenceId(), $this->getAffiliateCampaignId())
            ->sendRequest();
    }

    /**
     * Execute Buy REST browse API call
     *
     * @param $request
     * @param bool $forceTokenRefresh
     * @return bool|mixed
     * @throws \Exception
     */
    public function callBrowseApi($request, $forceTokenRefresh = false)
    {
        $session = new BrowseApiSession();
        return $session
            ->setRequestBody($request)
            ->setTimeout(60)
            ->setAccessToken($this->getAccessToken($request->getTokenType(), $request->getScope(), $forceTokenRefresh))
            ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
            ->setEbayGlobalId($this->ebayGlobalId)
            ->setUserLocation($this->locationCountryCode, $this->locationPostalCode)
            ->sendRequest();
    }

    /**
     * @param $request
     * @param bool $forceTokenRefresh
     * @return bool|mixed
     * @throws \Exception
     */
    public function callMarketingApi($request, $forceTokenRefresh = false)
    {
        $session = new MarketingApiSession();
        return $session
            ->setRequest($request)
            ->setAccessToken($this->getAccessToken($request->getTokenType(), $request->getScope(), $forceTokenRefresh))
            ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
            ->setEbayGlobalId($this->ebayGlobalId)
            ->sendRequest();
    }

    /**
     * Return eBay REST API Access Token
     *
     * @param $tokenType
     * @param $scope
     * @param $forceTokenRefresh
     * @return \Cake\Http\Response|string|null
     * @throws \Exception
     */
    public function getAccessToken($tokenType, $scope, $forceTokenRefresh)
    {
        $safetyTimeInterval = '+1 minute';
        if (!$forceTokenRefresh) {

            switch ($tokenType) {
                case AccessTokenType::APPLICATION :
                    if (isset($this->ebayAccount->ebay_rest_api_access_tokens) && !empty($this->ebayAccount->ebay_rest_api_access_tokens)) {
                        foreach ($this->ebayAccount->ebay_rest_api_access_tokens as $ebayRestApiAccessToken) {
                            if ($ebayRestApiAccessToken->token_type == $tokenType && $ebayRestApiAccessToken->scope == $scope) {
                                $expireTimestamp = $ebayRestApiAccessToken->expire_timestamp ?? null;
                                if (is_numeric($expireTimestamp) && $expireTimestamp > strtotime($safetyTimeInterval)) {
                                    return $ebayRestApiAccessToken->token;
                                }
                            }
                        }
                    }
                    break;
                case AccessTokenType::USER :
                    $token = $this->getController()->request->getSession()->read(self::USER_REST_TOKEN_KEY);
                    $tokenLifeTime = $this->getController()->request->getSession()->read(self::USER_REST_TOKEN_EXPIRE_TIME_KEY);
                    $tokenScope = $this->getController()->request->getSession()->read(self::USER_REST_TOKEN_SCOPE_KEY);
                    if (!empty($token) && $scope == $tokenScope && (is_numeric($tokenLifeTime) && $tokenLifeTime > strtotime($safetyTimeInterval))) {
                        return $token;
                    }
                    $refreshToken = $this->getController()->request->getSession()->read(self::USER_REST_REFRESH_TOKEN_KEY);
                    $refreshTokenLifeTime = $this->getController()->request->getSession()->read(self::USER_REST_REFRESH_TOKEN_EXPIRE_TIME_KEY);
                    if (!empty($refreshToken) && $scope == $tokenScope && (is_numeric($refreshTokenLifeTime) && $refreshTokenLifeTime > strtotime($safetyTimeInterval))) {
                        $token = $this->refreshUserAccessToken($refreshToken, $scope);
                        if (!empty($token)) {
                            return $token;
                        }
                    }
                    break;
            }
        }
        return $this->generateNewAccessToken($tokenType, $scope);
    }

    /**
     * @param $refreshToken
     * @param $scope
     * @return mixed
     */
    public function refreshUserAccessToken($refreshToken, $scope)
    {
        $refreshUserTokenRequest = (new RefreshUserTokenRequest())
            ->setRefreshToken($refreshToken)
            ->setScope($scope);

        $response = json_decode((new IdentityApiSession())
            ->setRequest($refreshUserTokenRequest)
            ->setAppId($this->ebayAccount->ebay_credential->app_id ?? '')
            ->setAppSecret($this->ebayAccount->ebay_credential->cert_id ?? '')
            ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
            ->setEbayGlobalId($this->ebayGlobalId)
            ->sendRequest());

        if (!empty($response) && isset($response->access_token) && !empty($response->access_token)) {
            $this->getController()->request->getSession()->write(self::USER_REST_TOKEN_KEY, $response->access_token);
            $this->getController()->request->getSession()->write(self::USER_REST_TOKEN_EXPIRE_TIME_KEY, time() + ($response->expires_in ?? 0));
            return $response->access_token;
        }
    }

    /**
     * @param $authCode
     * @return bool
     */
    public function generateNewUserAccessToken($authCode)
    {
        $getUserTokenRequest = (new GetUserTokenRequest())
            ->setRedirectUri($this->ebayAccount->ebay_credential->ru_name ?? '')
            ->setAuthorizationCode(urldecode($authCode));

        return (new IdentityApiSession())
            ->setRequest($getUserTokenRequest)
            ->setAppId($this->ebayAccount->ebay_credential->app_id ?? '')
            ->setAppSecret($this->ebayAccount->ebay_credential->cert_id ?? '')
            ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
            ->setEbayGlobalId($this->ebayGlobalId)
            ->sendRequest();
    }

    /**
     * Generate new eBay REST API Access Token based on given eBay Account
     *
     * @param $tokenType
     * @param $scope
     * @return \Cake\Http\Response|string|null
     * @throws \Exception
     */
    public function generateNewAccessToken($tokenType, $scope)
    {
        $session = new IdentityApiSession();

        switch ($tokenType) {
            case AccessTokenType::APPLICATION :
                $getApplicationTokenRequest = (new GetApplicationTokenRequest())
                    ->setRedirectUri($this->ebayAccount->ebay_credential->ru_name ?? '')
                    ->setScope($scope);

                $authResponse = json_decode($session
                    ->setAppId($this->ebayAccount->ebay_credential->app_id ?? '')
                    ->setAppSecret($this->ebayAccount->ebay_credential->cert_id ?? '')
                    ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
                    ->setEbayGlobalId($this->ebayGlobalId)
                    ->setRequest($getApplicationTokenRequest)
                    ->sendRequest(), true);

                $newAccessToken = $authResponse['access_token'] ?? '';

                if (!empty($newAccessToken)) {
                    $newExpireTimeStamp = time() + ($authResponse['expires_in'] ?? 0);
                    $restApiAccessTokens = $this->ebayAccount->ebay_rest_api_access_tokens ?? [];

                    $ebayAccountTable = TableRegistry::getTableLocator()->get('Ebay.EbayAccounts');

                    $tokenUpdated = false;
                    if (!empty($restApiAccessTokens)) {
                        foreach ($restApiAccessTokens as &$restApiAccessToken) {
                            if ($restApiAccessToken->token_type == $tokenType && $restApiAccessToken->scope == $scope) {
                                $restApiAccessToken->token = $newAccessToken;
                                $restApiAccessToken->expire_timestamp = $newExpireTimeStamp;
                                $tokenUpdated = true;
                                break;
                            }
                        }
                    }

                    if (!$tokenUpdated) {
                        $newRestApiAccessToken = $ebayAccountTable->EbayRestApiAccessTokens->newEntity();
                        $newRestApiAccessToken->token_type = $tokenType;
                        $newRestApiAccessToken->scope = $scope;
                        $newRestApiAccessToken->token = $newAccessToken;
                        $newRestApiAccessToken->expire_timestamp = $newExpireTimeStamp;
                        $restApiAccessTokens[] = $newRestApiAccessToken;
                    }

                    $this->ebayAccount->ebay_rest_api_access_tokens = $restApiAccessTokens;
                    if ($ebayAccountTable->save($this->ebayAccount)) {
                        $event = new Event('Ebay.Component.EbayBuyApi.afterAccessTokenSaved', $this, [
                            'ebay_account_id' => $this->ebayAccount->id
                        ]);
                        (new EventManager())->dispatch($event);

                        return $newAccessToken;
                    }
                } else {
                    Log::alert(json_encode($authResponse), ['scope' => 'api_call']);
                    sleep(1);
                }
                break;
            case AccessTokenType::USER :
                $authorizeUserTokenRequest = (new AuthorizeUserTokenRequest())
                    ->setRedirectUri($this->ebayAccount->ebay_credential->ru_name ?? '')
                    ->setAppId($this->ebayAccount->ebay_credential->app_id ?? '')
                    ->setScope($scope);
                $requestId = $authorizeUserTokenRequest->getState();
                $this->getController()->request->getSession()->write(self::USER_REST_TOKEN_REQUEST_ID_KEY, $requestId);

                $session
                    ->setMode($this->ebayAccount->ebay_account_type->type ?? '')
                    ->setEbayGlobalId($this->ebayGlobalId)
                    ->setRequest($authorizeUserTokenRequest);

                return $this->getController()->redirect($this->generateRoverPixelLoginUrl($session->getEndpoint() . '?' . $session->getRequest()->getRequestBody()));
            default :
                throw new \Exception(__('Unknown token type "{0}", only "{1}" token types allowed', [$tokenType, implode(',', [AccessTokenType::APPLICATION, AccessTokenType::USER])]));
        }
    }

    /**
     * @param $originalLoginUrl
     * @return string|string[]
     */
    protected function generateRoverPixelLoginUrl($originalLoginUrl)
    {
        if (!empty($this->ebayLoginRoverPixelAccountId) && !empty($this->ebayLoginRoverPixelCampaignId)) {
            return str_replace(
                [
                    '{epn_account_id}',
                    '{epn_campaign_id}',
                    '{target_url}'
                ],
                [
                    $this->ebayLoginRoverPixelAccountId,
                    $this->ebayLoginRoverPixelCampaignId,
                    urlencode($originalLoginUrl)
                ],
                $this->ebayLoginRoverPixel);
        }
        return $originalLoginUrl;
    }

    /**
     * @param $itemId
     * @param int $imageSizeCode
    Q
     * @return mixed
     * @throws \Exception
     */
    public function getRawItem($itemId)
    {
        $itemGroupId = $this->extractItemGroupId($itemId);

        if (is_numeric($itemGroupId)) {
            $getGroupItemRequest = new GetItemByItemGroupRequest();
            $getGroupItemRequest->setItemGroupId($itemGroupId);
            try {
                $ebayItem = $this->callBrowseApi($getGroupItemRequest);
            } catch (\Exception $exp) {
                $this->log($exp->getMessage() . '. RequestUrl:' . $getGroupItemRequest->getCallName(), LogLevel::ERROR, ['scope' => 'ebay_api']);
                throw new \Exception($exp->getMessage(), $exp->getCode());
            }


            if (isset($ebayItem->errors)) {
                $isSimpleItem = false;
                foreach ($ebayItem->errors as $error) {
                    if ($error->errorId == '11005' || $error->errorId == '11002') {
                        $isSimpleItem = true;
                        break;
                    }
                }
                if ($isSimpleItem) {
                    $simpleItemRequest = new GetItemRequest();
                    $simpleItemRequest->setItemId('v1|' . $itemGroupId . '|0');

                    try {
                        $ebayItem = $this->callBrowseApi($simpleItemRequest);
                    } catch (\Exception $exp) {
                        $this->log($exp->getMessage() . '. RequestUrl:' . $getGroupItemRequest->getCallName(), LogLevel::ERROR, ['scope' => 'ebay_api']);
                        throw new \Exception($exp->getMessage(), $exp->getCode());
                    }
                }
            }
        } else {
            $simpleItemRequest = new GetItemRequest();
            $simpleItemRequest->setItemId($itemId);
            try {
                $ebayItem = $this->callBrowseApi($simpleItemRequest);
            } catch (\Exception $exp) {
                $this->log($exp->getMessage() . '. RequestUrl:' . $simpleItemRequest->getCallName(), LogLevel::ERROR, ['scope' => 'ebay_api']);
                throw new \Exception($exp->getMessage(), $exp->getCode());
            }
        }

        return $ebayItem;
    }

    /**
     * @param $itemId
     * @param int $imageSizeCode
     * 1 = 400x400
     * 2 = 200x200
     * 3 = 800x800
     * 4 = 640x480
     * 5 = 100x75
     * 6 = 70x70
     * 7 = 150x150
     * 8 = 300x300
     * 9 = 200x150,
     * 10 = 1600x1600,
     * 11 = 310x90
     * 12 = 500x500
     * @return array
     * @throws \Exception
     */
    public function getItem($itemId, $imageSizeCode = 12) {
        return $this->convertItem($this->getRawItem($itemId, $imageSizeCode));
    }

    /**
     * @param $item
     * @param $imageSizeCode
     * @return array
     */
    public function convertItem($item, $imageSizeCode)
    {
        if (isset($item->errors)) {
            return (array)$item;
        }
        $parentId = '';
        $title = '';
        $description = '';
        $itemWebUrl = '';
        $items = [];
        $rating = [];
        $images = [];
        $configurableAttributes = [];
        $energyEfficiencyClass = '';
        $productFicheWebUrl = '';
        $categoryId = null;
        $categoryPath = null;
        $deliveryDurationDe = null;

        if (isset($item->items)) {
            foreach ($item->items as $variationItem) {
                $title = isset($variationItem->primaryItemGroup->itemGroupTitle) ? $variationItem->primaryItemGroup->itemGroupTitle : ($variationItem->title ?? '');
                $description = isset($item->commonDescriptions[0]->description) ? $item->commonDescriptions[0]->description : ($variationItem->description ?? '');
                $parentId = $variationItem->primaryItemGroup->itemGroupId ?? '';
                $rating = $this->getFormattedRating($variationItem);
                $formattedItem = $this->getFormattedItem($variationItem);
                $itemWebUrl = explode('?', $variationItem->itemWebUrl ?? '')[0];
                $energyEfficiencyClass = $variationItem->energyEfficiencyClass ?? '';
                $productFicheWebUrl = $variationItem->productFicheWebUrl ?? '';
                $items[] = $formattedItem;
                $categoryId = $variationItem->categoryId ?? null;
                $categoryPath = $variationItem->categoryPath ?? null;
                $deliveryDurationDe = $variationItem->deliveryDurationDe ?? null;

                $itemGroupImage = $variationItem->primaryItemGroup->itemGroupImage->imageUrl ?? '';
                if (!empty($itemGroupImage)) {
                    if (!in_array($itemGroupImage, $images)) {
                        $images[] = $this->getImageUrlBySizeCode($itemGroupImage, $imageSizeCode);
                    }
                }

                $additionalGroupImages = $variationItem->primaryItemGroup->itemGroupAdditionalImages ?? '';
                if (!empty($additionalGroupImages)) {
                    foreach ($additionalGroupImages as $additionalGroupImage) {
                        $imageUrl = $additionalGroupImage->imageUrl ?? '';
                        if (!empty($imageUrl) && !in_array($imageUrl, $images)) {
                            $images[] = $this->getImageUrlBySizeCode($imageUrl, $imageSizeCode);
                        }
                    }
                }
                if (isset($formattedItem['attributes']) && !empty($formattedItem['attributes'])) {
                    foreach ($formattedItem['attributes'] as $attribute) {
                        if (!isset($configurableAttributes[$attribute['name']]) || !in_array($attribute['value'], $configurableAttributes[$attribute['name']])) {
                            $configurableAttributes[$attribute['name']][] = $attribute['value'];
                        }
                    }
                }
            }

            foreach ($configurableAttributes as $attributeName => $attributeValues) {
                if (count($attributeValues) <= 1) {
                    unset($configurableAttributes[$attributeName]);
                }
            }
        } else {
            $title = $item->title ?? '';
            $description = $item->description ?? '';
            $parentId = $item->itemId;
            $items[] = $this->getFormattedItem($item);
            $rating = $this->getFormattedRating($item);
            $images = $items[0]['images'] ?? [];
            $itemWebUrl = $item->itemWebUrl ?? '';
            $energyEfficiencyClass = $item->energyEfficiencyClass ?? '';
            $productFicheWebUrl = $item->productFicheWebUrl ?? '';
            $categoryId = $item->categoryId ?? null;
            $categoryPath = $item->categoryPath ?? null;
            $deliveryDurationDe = $item->deliveryDurationDe ?? null;
        }

        $ebayItem = [
            'type' => isset($item->items) ? 'CONFIGURABLE' : 'SIMPLE',
            'parent_id' => $parentId,
            'title' => iconv('UTF-8', 'UTF-8//IGNORE', $title),
            'description' => $description,
            'item_web_url' => $itemWebUrl,
            'items' => $items,
            'energy_efficiency_class' => $energyEfficiencyClass,
            'productFicheWebUrl' => $productFicheWebUrl,
            'category_id' => $categoryId,
            'category_path' => $categoryPath,
            'delivery_duration_de' => $deliveryDurationDe
        ];

        if (!empty($rating)) {
            $ebayItem['rating'] = $rating;
        }
        if (!empty($images)) {
            $ebayItem['images'] = $images;
        }
        if (!empty($configurableAttributes)) {
            $ebayItem['configurable_attributes'] = $configurableAttributes;
        }

        return $ebayItem;
    }

    /**
     * @param $imageUrl
     * @param $imageSizeCode
     * @return mixed
     */
    private function getImageUrlBySizeCode($imageUrl, $imageSizeCode)
    {
        if (stripos($imageUrl, 'i.ebayimg.com') !== false) {
            $urlCheck = pathinfo($imageUrl);
            if (substr($urlCheck['basename'], 0, 1) == '$') {
                $imageUrl = str_replace($urlCheck['basename'], '$_' . $imageSizeCode . '.JPG', $imageUrl);
            }
        }
        return $imageUrl;
    }

    /**
     * @param $item
     * @return array
     */
    private function getFormattedRating($item)
    {
        $rating = [];
        if (isset($item->primaryProductReviewRating)) {
            $rating['avg_rating'] = $item->primaryProductReviewRating->averageRating ?? '';
            $rating['review_count'] = $item->primaryProductReviewRating->reviewCount ?? '';
            $rating['rating_count'] = 0;
            if (isset($item->primaryProductReviewRating->ratingHistograms)) {
                $histogram = [];
                foreach ($item->primaryProductReviewRating->ratingHistograms as $ratingHistogram) {
                    $histogram[] = [
                        'stars' => $ratingHistogram->rating,
                        'count' => $ratingHistogram->count
                    ];
                    $rating['rating_count'] += (int)$ratingHistogram->count;
                }
                if (!empty($histogram)) {
                    $rating['histogram'] = $histogram;
                }
            }

        }
        if (($rating['review_count'] ?? 0) == 0 && ($rating['rating_count'] ?? 0) == 0) {
            return [];
        }
        return $rating;
    }

    /**
     * @param $item
     * @return array
     */
    private function getFormattedItem($item)
    {
        $images = [];
        $quantity = 0;
        $quantityType = 'EXACT';
        $soldQuantity = 0;
        $shippingOptions = [];
        $attributes = [];
        $shipToLocations = [];
        $availabilityStatus = null;

        $images[] = $item->image->imageUrl ?? [];
        if (isset($item->additionalImages)) {
            foreach ($item->additionalImages as $additionalImage) {
                $images[] = $additionalImage->imageUrl;
            }
        }

        if (isset($item->estimatedAvailabilities)) {
            foreach ($item->estimatedAvailabilities as $estimatedAvailability) {
                $estimatedQuantity = $estimatedAvailability->estimatedAvailableQuantity ?? null;
                $thresholdQuantity = $estimatedAvailability->availabilityThreshold ?? null;

                if (is_numeric($estimatedQuantity) || is_numeric($thresholdQuantity)) {
                    if (is_numeric($estimatedQuantity)) {
                        $quantity = $estimatedQuantity;
                    } elseif (is_numeric($thresholdQuantity)) {
                        $quantity = $thresholdQuantity;
                        $quantityType = 'MORE_THAN';
                    }

                    if (isset($estimatedAvailability->estimatedSoldQuantity)) {
                        $soldQuantity = $estimatedAvailability->estimatedSoldQuantity;
                    }

                    if (isset($estimatedAvailability->estimatedAvailabilityStatus)) {
                        $availabilityStatus = $estimatedAvailability->estimatedAvailabilityStatus;
                    }
                }
            }
        }

        if (isset($item->localizedAspects)) {
            foreach ($item->localizedAspects as $localizedAspect) {
                $attributes[] = [
                    'name' => trim($localizedAspect->name),
                    'value' => trim($localizedAspect->value)
                ];
            }
        }

        if (isset($item->shippingOptions)) {
            foreach ($item->shippingOptions as $shippingOption) {
                $ebayShippingOption = [
                    'shipping_service' => $shippingOption->shippingServiceCode ?? '',
                    'type' => $shippingOption->type ?? '',
                    'shipping_cost' => [
                        'amount' => $shippingOption->shippingCost->value ?? '',
                        'currency' => $shippingOption->shippingCost->currency ?? '',
                        'display_price' => $this->Currency->formatCurrency(($shippingOption->shippingCost->value ?? ''), ($shippingOption->shippingCost->currency ?? ''))
                    ]
                ];
                if (isset($shippingOption->maxEstimatedDeliveryDate) && !empty($shippingOption->maxEstimatedDeliveryDate)) {
                    $ebayShippingOption['max_delivery_date'] = $shippingOption->maxEstimatedDeliveryDate;
                }
                if (isset($shippingOption->minEstimatedDeliveryDate) && !empty($shippingOption->minEstimatedDeliveryDate)) {
                    $ebayShippingOption['min_delivery_date'] = $shippingOption->minEstimatedDeliveryDate;
                }
                if (isset($shippingOption->shipToLocationUsedForEstimate)) {
                    if (isset($shippingOption->shipToLocationUsedForEstimate->country) && !empty($shippingOption->shipToLocationUsedForEstimate->country)) {
                        $ebayShippingOption['ship_to_location_used_or_estimation']['country'] = $shippingOption->shipToLocationUsedForEstimate->country;
                    }
                    if (isset($shippingOption->shipToLocationUsedForEstimate->postalCode) && !empty($shippingOption->shipToLocationUsedForEstimate->postalCode)) {
                        $ebayShippingOption['ship_to_location_used_or_estimation']['postalCode'] = $shippingOption->shipToLocationUsedForEstimate->postalCode;
                    }
                }
                $shippingOptions[] = $ebayShippingOption;
            }
        }

        if (isset($item->shipToLocations)) {
            if (isset($item->shipToLocations->regionExcluded)) {
                $shipToLocations['region_excluded'] = [];
                foreach ($item->shipToLocations->regionExcluded as $regionExcluded) {
                    $shipToLocations['region_excluded'][] = [
                        'region_type' => $regionExcluded->regionType ?? '',
                        'region_name' => $regionExcluded->regionName ?? ''
                    ];
                }

            }
            if (isset($item->shipToLocations->regionIncluded)) {
                $shipToLocations['region_included'] = [];
                foreach ($item->shipToLocations->regionIncluded as $regionIncluded) {
                    $shipToLocations['region_included'][] = [
                        'region_type' => $regionIncluded->regionType ?? '',
                        'region_name' => $regionIncluded->regionName ?? ''
                    ];
                }
            }
        }
        $price = $item->price->value;
        $currency = $item->price->currency;
        $originalPrice = $item->marketingPrice->originalPrice->value ?? null;
        $originalPriceCurrency = $item->marketingPrice->originalPrice->currency ?? null;
        $discountPercentage = $item->marketingPrice->discountPercentage ?? null;
        $discountAmount = $item->marketingPrice->discountAmount->value ?? null;
        $discountAmountCurrency = $item->marketingPrice->discountAmount->currency ?? null;

        if (is_numeric($discountAmount) && !is_numeric($originalPrice)) {
            $originalPrice = $price + $discountAmount;
            $originalPriceCurrency = $currency;
            $discountPercentage = abs(($price * 100 / $originalPrice - 100));
        }

        if (is_numeric($originalPrice) && $originalPrice <= $price) {
            $originalPrice = 0.00;
            $discountAmount = 0.00;
            $discountPercentage = 0;
        }

        return [
            'id' => $item->itemId,
            'price' => [
                'amount' => $price,
                'currency' => $currency,
                'display_price' => $this->Currency->formatCurrency($price, $currency)
            ],
            'marketing_price' => [
                'discount_percentage' => $discountPercentage,
                'original_price' => [
                    'value' => $originalPrice,
                    'currency' => $originalPriceCurrency,
                    'display_price' => $this->Currency->formatCurrency($originalPrice, $originalPriceCurrency)
                ],
                'discount_amount' => [
                    'value' => $discountAmount,
                    'currency' => $discountAmountCurrency,
                    'display_price' => $this->Currency->formatCurrency($discountAmount, $discountAmountCurrency)
                ]
            ],
            'unit_pricing_measure' => $item->unitPricingMeasure ?? '',
            'unit_price' => [
                'value' => $item->unitPrice->value ?? '',
                'currency' => $item->unitPrice->currency ?? ''
            ],
            'energy_efficiency_class' => $item->energyEfficiencyClass ?? '',
            'item_web_url' => $item->itemWebUrl ?? '',
            'item_url' => $item->itemUrl ?? '',
            'short_description' => $item->shortDescription ?? '',
            'subtitle' => $item->subtitle ?? '',
            'location' => [
                'city' => $item->itemLocation->city ?? '',
                'country' => $item->itemLocation->country ?? '',
                'postalCode' => $item->itemLocation->postalCode ?? '',
                'stateOrProvince' => $item->itemLocation->stateOrProvince ?? ''
            ],
            'quantity' => $quantity,
            'quantity_type' => $quantityType,
            'max_buy_quantity' => $item->quantityLimitPerBuyer ?? '',
            'sold_quantity' => $soldQuantity,
            'availability_status' => $availabilityStatus,
            'item_end_date' => $item->itemEndDate ?? null,
            'return_terms' => [
                'extended_holiday_returns_offered' => $item->returnTerms->extendedHolidayReturnsOffered ?? '',
                'refund_method' => $item->returnTerms->refundMethod ?? '',
                'restocking_fee_percentage' => $item->returnTerms->restockingFeePercentage ?? '',
                'return_shipping_cost_payer' => $item->returnTerms->returnShippingCostPayer ?? '',
                'return_accepted' => $item->returnTerms->returnsAccepted ?? '',
                'return_instructions' => $item->returnTerms->returnInstructions ?? '',
                'return_method' => $item->returnTerms->returnMethod ?? '',
                'return_period' => [
                    'unit' => $item->returnTerms->returnPeriod->unit ?? '',
                    'value' => $item->returnTerms->returnPeriod->value ?? ''
                ]
            ],
            'seller' => [
                'feedback_percentage' => $item->seller->feedbackPercentage ?? '',
                'feedback_score' => $item->seller->feedbackScore ?? '',
                'username' => $item->seller->username ?? '',
                'account_type' => $item->seller->sellerAccountType ?? '',
                'legal_info' => [
                    'email' => $item->seller->sellerLegalInfo->email ?? '',
                    'fax' => $item->seller->sellerLegalInfo->fax ?? '',
                    'imprint' => nl2br($item->seller->sellerLegalInfo->imprint ?? ''),
                    'legal_contact_first_name' => $item->seller->sellerLegalInfo->legalContactFirstName ?? '',
                    'legal_contact_last_name' => $item->seller->sellerLegalInfo->legalContactLastName ?? '',
                    'name' => $item->seller->sellerLegalInfo->name ?? '',
                    'phone' => $item->seller->sellerLegalInfo->phone ?? '',
                    'registration_number' => $item->seller->sellerLegalInfo->registrationNumber ?? '',
                    'legal_address' => [
                        'address_line_1' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->addressLine1 ?? '',
                        'address_line_2' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->addressLine2 ?? '',
                        'city' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->city ?? '',
                        'country' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->country ?? '',
                        'country_name' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->countryName ?? '',
                        'county' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->county ?? '',
                        'postal_code' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->postalCode ?? '',
                        'state_or_province' => $item->seller->sellerLegalInfo->sellerProvidedLegalAddress->stateOrProvince ?? '',
                    ],
                    'terms_of_service' => nl2br($item->seller->sellerLegalInfo->termsOfService ?? ''),
                    'vat_details' => [
                        'issuing_country' => isset($item->seller->sellerLegalInfo->vatDetails[0]->issuingCountry) ? $item->seller->sellerLegalInfo->vatDetails[0]->issuingCountry : '',
                        'vat_id' => $item->seller->sellerLegalInfo->vatDetails[0]->vatId ?? '',
                    ]
                ],
            ],
            'attributes' => $attributes,
            'shipping_options' => $shippingOptions,
            'ship_to_locations' => $shipToLocations,
            'images' => $images,
            'enabled_for_guest_checkout' => $item->enabledForGuestCheckout ?? false,
            'eligible_for_inline_checkout' => $item->eligibleForInlineCheckout ?? false
        ];
    }

    /**
     * @param $itemId
     * @return int|string|null
     */
    public function extractItemGroupId($itemId)
    {
        $itemGroupId = is_numeric($itemId) ? $itemId : null;
        $expItemId = explode('|', $itemId);
        if (isset($expItemId[2]) && $expItemId[2] !== '0') {
            $itemGroupId = trim($expItemId[1]);
        }
        return $itemGroupId;
    }
}
