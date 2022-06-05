<?php

namespace Ebay\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use Ebay\Lib\CommerceApi\IdentityApi\Request\GetUserRequest;
use Ebay\Lib\CommerceApi\IdentityApi\Security\Session;
use ItoolCustomer\Controller\AppController;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Ebay\Lib\IdentityApi\Entity\AccessTokenType;
use Ebay\Model\Table\EbayAccountsTable;

/**
 * EbayAuthLandingPages Controller
 *
 *
 * @method \Ebay\Model\Entity\EbayAuthLandingPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @property EbayAccountsTable $EbayAccounts
 * @property EbayBuyApiComponent $EbayBuyApi
 */
class EbayAuthLandingPagesController extends AppController
{
    protected $loginScope;

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['accepted', 'declined', 'login']);
        $this->loginScope = (new GetUserRequest())->getScope();
    }

    /**
     * @throws \Exception
     */
    public function login()
    {
        $this->autoRender = false;
        $mode = Configure::read('dealsguru.mode');
        $ebayAccountId = Configure::read('dealsguru.ebay.' . $mode . '_account_id');

        $this->loadComponent('Ebay.EbayBuyApi');
        $this->loadModel('Ebay.EbayAccounts');

        $ebayAccount = $this->EbayAccounts->find()
            ->where(['EbayAccounts.id' => $ebayAccountId])
            ->contain(['EbayCredentials', 'EbayAccountTypes'])
            ->first();

        $this->EbayBuyApi
            ->setAccount($ebayAccount)
            ->setEbayLoginRoverPixelAccountId(Configure::read('dealsguru.roverPixel.ebayLoginEpnAccountId'))
            ->setEbayLoginRoverPixelCampaignId(Configure::read('dealsguru.roverPixel.ebayLoginEpnCampaignId'))
            ->setEbayGlobalId('EBAY-DE')
            ->getAccessToken(AccessTokenType::USER, $this->loginScope, true);

        $this->request->getSession()->delete('EbayAuth.redirectUrl');
        $redirectUrl = $this->request->getQuery('redirect');

        if (!empty($redirectUrl)) {
            $this->request->getSession()->write('EbayAuth.redirectUrl', $redirectUrl);
        }
    }

    /**
     * This is the URL to which the user will be redirected after successful logging in on eBay
     *
     * @return \Cake\Http\Response|null
     */
    public function accepted()
    {
        try {
            $this->loadComponent('Ebay.EbayBuyApi');
            $this->loadModel('Ebay.EbayAccounts');
            $authorizeCode = $this->request->getQuery('code');
            $requestId = $this->request->getQuery('state');

            if (!empty($authorizeCode) && $requestId == $this->request->getSession()->read(EbayBuyApiComponent::USER_REST_TOKEN_REQUEST_ID_KEY)) {
                $mode = Configure::read('dealsguru.mode');
                $ebayAccountId = Configure::read('dealsguru.ebay.' . $mode . '_account_id');

                $ebayAccount = $this->EbayAccounts->find()
                    ->where(['EbayAccounts.id' => $ebayAccountId])
                    ->contain(['EbayCredentials', 'EbayAccountTypes'])
                    ->first();

                $response = json_decode($this->EbayBuyApi->setAccount($ebayAccount)->generateNewUserAccessToken($authorizeCode));

                if (!empty($response) && !isset($response->access_token) || empty($response->access_token)) {
                    $event = new Event('Ebay.Controller.EbayAuthLandingPages.failedFetchToken', $this);
                    $this->getEventManager()->dispatch($event);
                    $redirectUrl = $event->getResult()['redirect'] ?? '/';

                    return $this->redirect($redirectUrl);
                } else {
                    $this->request->getSession()->write(EbayBuyApiComponent::USER_REST_TOKEN_KEY, $response->access_token);
                    $this->request->getSession()->write(EbayBuyApiComponent::USER_REST_TOKEN_EXPIRE_TIME_KEY, time() + ($response->expires_in ?? 0));
                    $this->request->getSession()->write(EbayBuyApiComponent::USER_REST_REFRESH_TOKEN_KEY, $response->refresh_token ?? '');
                    $this->request->getSession()->write(EbayBuyApiComponent::USER_REST_REFRESH_TOKEN_EXPIRE_TIME_KEY, time() + ($response->refresh_token_expires_in ?? 0));
                    $this->request->getSession()->write(EbayBuyApiComponent::USER_REST_TOKEN_SCOPE_KEY, $this->loginScope);

                    $getUserRequest = new GetUserRequest();
                    $session = new Session();
                    $ebayUser = $session
                        ->setEbayGlobalId('EBAY-DE')
                        ->setAccessToken($response->access_token)
                        ->setMode($mode)
                        ->setRequestBody($getUserRequest)
                        ->sendRequest();

                    $event = new Event('Ebay.Controller.EbayAuthLandingPages.userLoggedIn', $this, [
                        'ebayUser' => $ebayUser
                    ]);
                    $this->getEventManager()->dispatch($event);
                    $redirectUrl = $this->request->getSession()->read('EbayAuth.redirectUrl');
                    $this->request->getSession()->delete('EbayAuth.redirectUrl');
                    if (empty($redirectUrl)) {
                        $redirectUrl = $event->getResult()['redirect'] ?? '/';
                    }
                    $customer = $event->getResult()['user'];
                    $this->Auth->setUser($customer);
                    $this->request->getSession()->write('Pandata.just_logged', $customer->id);
                    return $this->redirect($redirectUrl);
                }
            }
        } catch (\Exception $exp) {
            $this->Flash->error($exp->getMessage());
        }
        return $this->redirect('/');
    }

    /**
     * This is the URL to which the user will be redirected in case of login rejecting on eBay
     *
     * @return \Cake\Http\Response|null
     */
    public function declined()
    {
        $event = new Event('Ebay.Controller.EbayAuthLandingPages.declined', $this);
        $this->getEventManager()->dispatch($event);
        $redirectUrl = $event->getResult()['redirect'] ?? '/';

        return $this->redirect($redirectUrl);
    }
}
