<?php

namespace Ebay\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Exception\Exception;

use App\Error\ItoolException;

use Ebay\Lib\TradingApi\Entity\ApplicationDeliveryPreferences;
use Ebay\Lib\TradingApi\Entity\CustomPage;
use Ebay\Lib\TradingApi\Entity\LineItem;
use Ebay\Lib\TradingApi\Entity\NotificationEnable;
use Ebay\Lib\TradingApi\Entity\Shipment;
use Ebay\Lib\TradingApi\Entity\ShipmentLineItem;
use Ebay\Lib\TradingApi\Entity\ShipmentTrackingDetails;
use Ebay\Lib\TradingApi\Entity\Store;
use Ebay\Lib\TradingApi\Entity\UserDeliveryPreferenceArray;
use Ebay\Lib\TradingApi\Request\CompleteSaleRequest;
use Ebay\Lib\TradingApi\Request\GetApiAccessRulesRequest;
use Ebay\Lib\TradingApi\Request\GetCategorySpecificsRequest;
use Ebay\Lib\TradingApi\Request\GetItemRequest;
use Ebay\Lib\TradingApi\Request\GetNotificationPreferencesRequest;
use Ebay\Lib\TradingApi\Request\GetNotificationsUsageRequest;
use Ebay\Lib\TradingApi\Request\GetStoreCustomPageRequest;
use Ebay\Lib\TradingApi\Request\GetStoreRequest;
use Ebay\Lib\TradingApi\Request\GetTokenStatusRequest;
use Ebay\Lib\TradingApi\Request\GetUserRequest;
use Ebay\Lib\TradingApi\Request\LeaveFeedbackRequest;
use Ebay\Lib\TradingApi\Request\ReviseItemRequest;
use Ebay\Lib\TradingApi\Request\SetNotificationPreferencesRequest;
use Ebay\Lib\TradingApi\Request\SetStoreCustomPageRequest;
use Ebay\Lib\TradingApi\Request\SetStoreRequest;
use Ebay\Lib\TradingApi\Security\Session;
use Ebay\Lib\TradingApi\Request\AddFixedPriceItemRequest;
use Ebay\Lib\TradingApi\Request\ReviseFixedPriceItemRequest;
use Ebay\Lib\TradingApi\Request\AddDisputeRequest;
use Ebay\Lib\TradingApi\Request\AddDisputeResponseRequest;
use Ebay\Lib\TradingApi\Request\GetDisputeRequest;
use Ebay\Lib\TradingApi\Request\GetSessionIDRequest;
use Ebay\Lib\TradingApi\Request\FetchTokenRequest;
use Ebay\Lib\TradingApi\Request\GetCategoriesRequest;
use Ebay\Lib\TradingApi\Request\GetCategoryFeaturesRequest;
use Ebay\Lib\TradingApi\Request\GeteBayOfficialTimeRequest;
use Ebay\Lib\TradingApi\Request\GetSellerEventsRequest;
use Ebay\Lib\TradingApi\Request\GetOrdersRequest;
use Ebay\Lib\TradingApi\Request\GetSellerTransactionsRequest;
use Ebay\Lib\TradingApi\Request\GetSellerListRequest;

use Ebay\Lib\TradingApi\Entity\Item;
use Ebay\Lib\TradingApi\Entity\ProductListingDetails;
use Ebay\Lib\TradingApi\Entity\PrimaryCategory;
use Ebay\Lib\TradingApi\Entity\PictureDetails;
use Ebay\Lib\TradingApi\Entity\Header;
use Ebay\Lib\TradingApi\Entity\Pagination;
use Ebay\Lib\TradingApi\Entity\OrderIdArray;
use Ebay\Lib\TradingApi\Entity\SkuArray;

/**
 *
 * Ebay Trading API Component
 *
 */
class EbayTradingApiComponent extends Component
{
    private $session = null;
    private $apiVersion = 995;
    private $warningLevel = 'High';
    private $errorLanguage = 'en_GB';
    private $invalidTokenErrorCodes = [
        '16110', '930', '931', '932', '16119', '17569', '21707',
        '21916013', '17470'
    ];

    /**
     * Init session
     *
     * @param \Ebay\Model\Entity\EbayAccount $ebayAccount
     * @param integer $ebaySiteId
     * @param boolean $setToken
     */
    public function initSession($ebayAccount, $ebaySiteId = null, $setToken = true)
    {
        if (!isset($ebaySiteId) && isset($ebayAccount->ebay_sites[0]->ebay_site_id)) {
            $ebaySiteId = $ebayAccount->ebay_sites[0]->ebay_site_id;
            if (isset($ebayAccount->ebay_sites[0]->language) && !empty($ebayAccount->ebay_sites[0]->language)) {
                $ebaySiteLanguage = $ebayAccount->ebay_sites[0]->language;
                $this->errorLanguage = str_replace('-', '_', $ebaySiteLanguage);
            }
        }

        if ($this->hasSession() === false || $this->session->getToken() != $ebayAccount->token ||
            $this->session->getSiteId() != $ebaySiteId
        ) {
            $this->session = new Session();
            $this->session->setMode($ebayAccount->ebay_account_type->type);
            $this->session->setSiteId($ebaySiteId);
            if ($setToken) {
                $this->session->setToken($ebayAccount->token);
            }
            $this->session->setApiVersion($this->apiVersion);
            $this->session->setAppId($ebayAccount->ebay_credential->app_id);
            $this->session->setDevId($ebayAccount->ebay_credential->dev_id);
            $this->session->setCertId($ebayAccount->ebay_credential->cert_id);
        }
    }

    /**
     * @param $errorLanguage
     */
    public function setErrorLanguage($errorLanguage)
    {
        $this->errorLanguage = $errorLanguage;
    }

    /**
     * @return string
     */
    public function getErrorLanguage()
    {
        return $this->errorLanguage;
    }

    /**
     * @param $apiVersion
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return int
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * Check, whether session has been initialized
     *
     * @return boolean
     */
    private function hasSession()
    {
        if (!empty($this->session) && $this->session instanceof Session) {
            return true;
        }
        return false;
    }

    /**
     * GetSessionID for token creation
     * @params $requestArguments = [
     *              'RuName' => String
     *          ]
     */
    public function getSessionId($requestArguments)
    {
        if ($this->hasSession() === false) {
            throw new ItoolException(__("Ebay Session not present"));
        }

        $getSessionIdRequest = new GetSessionIDRequest();

        if (isset($requestArguments['ruName']) && !empty($requestArguments['ruName'])) {
            $getSessionIdRequest->setRuName($requestArguments['ruName']);
        }
        $getSessionIdRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($getSessionIdRequest);

        return $this->session->sendRequest();
    }

    /**
     * @param $requestArguments
     * @return mixed
     */
    public function fetchToken($requestArguments)
    {
        if ($this->hasSession() === false) {
            throw new ItoolException(__('Ebay Session not present.'));
        }

        $fetchTokenRequest = new FetchTokenRequest();

        if (isset($requestArguments['sessionId']) && !empty($requestArguments['sessionId'])) {
            $fetchTokenRequest->setSessionId($requestArguments['sessionId']);
        }
        $fetchTokenRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($fetchTokenRequest);

        return $this->session->sendRequest();
    }

    /**
     * @param $res
     */
    public function validateResponse($res)
    {
        if (empty($res)) {
            throw new ItoolException(__('Response body is empty. Please try again.'));
        }

        if ($res->Ack == 'Failure') {
            $errorMessages = [];
            foreach ($res->Errors as $error) {
                $errorMessages[] = htmlentities((String)$error->LongMessage) . PHP_EOL;
            }
            $errorMessage = implode(PHP_EOL, $errorMessages);
            throw new ItoolException($errorMessage);
        }
    }

    /**
     * @param $res
     * @return bool
     */
    public function isTokenInvalid($res)
    {
        $resStatus = strtolower((String)$res->Ack) ?? null;
        if ($resStatus == 'failure') {
            foreach ($res->Errors as $error) {
                $errorCode = (String)$error->ErrorCode ?? null;
                if (in_array($errorCode, $this->invalidTokenErrorCodes)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getEbayOfficialTime()
    {
        if ($this->hasSession() === false) {
            throw new ItoolException(__('Ebay Session not present.'));
        }
        $geteBayOfficialTimeRequest = new GeteBayOfficialTimeRequest();
        $geteBayOfficialTimeRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($geteBayOfficialTimeRequest);

        return $this->session->sendRequest();
    }

    /**
     * @param $ebayAccount
     * @param bool $ebaySiteId
     * @return bool
     */
    public function isTokenValid($ebayAccount, $ebaySiteId = false)
    {
        $this->initSession($ebayAccount);
        $res = $this->getEbayOfficialTime();
        return !$this->isTokenInvalid($res);
    }

    /**
     * @param null $requestArguments
     * @return mixed
     */
    public function getUser($requestArguments = null)
    {
        $simpleParams = [
            'userId',
            'detailLevel'
        ];

        $getUserRequest = new GetUserRequest();
        // Set simple parameters
        foreach ($simpleParams as $simpleParam) {
            if (isset($requestArguments[$simpleParam])) {
                $getUserRequest->{'set' . ucfirst($simpleParam)}($requestArguments[$simpleParam]);
            }
        }

        $getUserRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($getUserRequest);

        return $this->session->sendRequest();
    }

    /**
     * @return mixed
     */
    public function getApiAccessRules()
    {
        if ($this->hasSession() === false) {
            throw new ItoolException(__('Ebay Session not present.'));
        }

        $getApiAccessRulesRequest = new GetApiAccessRulesRequest();
        $getApiAccessRulesRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($getApiAccessRulesRequest);

        return $this->session->sendRequest();
    }

    /**
     * @param $ebayAccount
     * @return array
     */
    public function getConnectionStatus($ebayAccount)
    {
        $connectionStatus = [
            'isConnected' => false,
            'status' => $ebayAccount::STATUS_NOT_CONNECTED_CODE,
            'color' => $ebayAccount::STATUS_NOT_CONNECTED_COLOR
        ];

        $ebayToken = $ebayAccount->token ?? null;
        if (!empty($ebayToken)) {
            $isConnected = $this->isTokenValid($ebayAccount);

            if ($isConnected) {
                $ebayCredentialStatus = $ebayAccount->ebay_credential->is_active ?? null;
                $connectionStatus['isConnected'] = true;
                if ($ebayCredentialStatus) {
                    $connectionStatus['status'] = $ebayAccount::STATUS_IS_CONNECTED_CODE;
                    $connectionStatus['color'] = $ebayAccount::STATUS_IS_CONNECTED_COLOR;
                } else {
                    $connectionStatus['status'] = $ebayAccount::STATUS_RECREATE_CONNECTION_CODE;
                    $connectionStatus['color'] = $ebayAccount::STATUS_RECREATE_CONNECTION_COLOR;
                }
            }
        }
        return $connectionStatus;
    }

    /**
     * @return mixed
     */
    public function getTokenStatus()
    {
        if ($this->hasSession() === false) {
            throw new ItoolException(__('Ebay Session not present.'));
        }
        $getTokenStatusRequest = new GetTokenStatusRequest();
        $getTokenStatusRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($getTokenStatusRequest);
        return $this->session->sendRequest();
    }

    /**
     * GetCategories Request
     *
     * @param array $requestArguments
     * @return Ambigous <boolean, \SimpleXMLElement>
     * @throws Exception
     */
    public function getCategories($requestArguments = [])
    {
        if ($this->hasSession() === false) {
            throw new Exception(__("Ebay Session not present"));
        }

        $getCategoriesRequest = new GetCategoriesRequest();

        if (isset($requestArguments['categorySiteId']) && !empty($requestArguments['categorySiteId'])) {
            $getCategoriesRequest->setCategorySiteId($requestArguments['categorySiteId']);
        }

        if (isset($requestArguments['detailLevel']) && !empty($requestArguments['detailLevel'])) {
            $getCategoriesRequest->setDetailLevel($requestArguments['detailLevel']);
        }

        $getCategoriesRequest->setErrorLanguage($this->errorLanguage);
        $this->session->setRequestBody($getCategoriesRequest);

        return $this->session->sendRequest();
    }
}
