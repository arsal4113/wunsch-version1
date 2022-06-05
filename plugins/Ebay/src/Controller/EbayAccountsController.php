<?php

namespace Ebay\Controller;

use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Ebay\Controller\Component\EbayTradingApiComponent;
use Ebay\Model\Table\EbayAccountsEbaySitesTable;

/**
 * EbayAccounts Controller
 *
 * @property Ebay\Model\Table\EbayAccountsTable $EbayAccounts
 * @property EbayTradingApiComponent $EbayTradingApi
 * @property EbayAccountsEbaySitesTable $EbayAccountsEbaySites
 */
class EbayAccountsController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EbayAccountTypes', 'EbayCredentials', 'CoreSellers']
        ];

        $this->Prg->commonProcess();

        $ebaySessions = $this->request->getSession()->read('ebay.requestToken.sessions');
        if (!empty($ebaySessions)) {
            $ebaySessions = unserialize($ebaySessions);
        }

        $unusedSearchColumns = ['token'];
        $availableColumns = $this->EbayAccounts->schema()->columns();
        $availableColumns = array_diff($availableColumns, $unusedSearchColumns);

        $this->set('ebayAccounts', $this->paginate($this->EbayAccounts->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('ebaySessions', $ebaySessions);
        $this->set('_serialize', ['ebayAccounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Account id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayAccount = $this->EbayAccounts->get($id, [
            'contain' => ['EbayAccountTypes', 'EbayCredentials', 'CoreSellers', 'EbaySites', 'EbayLaunchProfiles', 'EbayListings']
        ]);
        $this->set('ebayAccount', $ebayAccount);
        $this->set('_serialize', ['ebayAccount']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebayAccount = $this->EbayAccounts->newEntity();
        if ($this->request->is('post')) {
            $ebayAccount = $this->EbayAccounts->patchEntity($ebayAccount, $this->request->data);
            if ($this->EbayAccounts->save($ebayAccount)) {
                $this->Flash->success(__('eBay account has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay account could not be saved. Please, try again.'));
            }
        }
        $ebayAccountTypes = $this->EbayAccounts->EbayAccountTypes->find('list', ['limit' => 200]);
        $ebayCredentials = $this->EbayAccounts->EbayCredentials->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'key_set_name']);
        $coreSellers = $this->EbayAccounts->CoreSellers->find('list', ['limit' => 200]);
        $ebaySites = $this->EbayAccounts->EbaySites->find('list', ['limit' => 200]);
        $this->set(compact('ebayAccount', 'ebayAccountTypes', 'ebayCredentials', 'coreSellers', 'ebaySites'));
        $this->set('_serialize', ['ebayAccount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Account id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebayAccount = $this->EbayAccounts->get($id, [
            'contain' => ['EbaySites']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebayAccount = $this->EbayAccounts->patchEntity($ebayAccount, $this->request->data);
            if ($this->EbayAccounts->save($ebayAccount)) {
                $this->Flash->success(__('eBay account has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay account could not be saved. Please, try again.'));
            }
        }
        $ebayAccountTypes = $this->EbayAccounts->EbayAccountTypes->find('list', ['limit' => 200]);
        $ebayCredentials = $this->EbayAccounts->EbayCredentials->find('list', ['limit' => 200, 'keyField' => 'id', 'valueField' => 'key_set_name']);
        $coreSellers = $this->EbayAccounts->CoreSellers->find('list', ['limit' => 200]);
        $ebaySites = $this->EbayAccounts->EbaySites->find('list', ['limit' => 200]);
        $this->set(compact('ebayAccount', 'ebayAccountTypes', 'ebayCredentials', 'coreSellers', 'ebaySites'));
        $this->set('_serialize', ['ebayAccount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Account id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebayAccount = $this->EbayAccounts->get($id);
        if ($this->EbayAccounts->delete($ebayAccount)) {
            $this->Flash->success(__('eBay account has been deleted.'));
        } else {
            $this->Flash->error(__('eBay account could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Request eBay token
     *
     * @param $id
     * @return \Cake\Network\Response|null
     */
    public function requestToken($id)
    {
        try {
            $ebayAccount = $this->EbayAccounts->find()
                ->contain([
                    'EbayCredentials',
                    'EbayAccountTypes',
                    'EbaySites'
                ])
                ->where(['EbayAccounts.id' => $id])
                ->first();

            if (empty($ebayAccount)) {
                throw new \Exception('eBay Account not found!');
            }
            $this->loadComponent('Ebay.EbayTradingApi');
            $ebaySiteId = isset($ebayAccount->ebay_sites[0]) ? $ebayAccount->ebay_sites[0]->ebay_site_id : null;
            $ebaySiteDomain = isset($ebayAccount->ebay_sites[0]) ? $ebayAccount->ebay_sites[0]->domain : null;

            $ebayCredential = $this->EbayAccounts->EbayCredentials->getCredential($ebayAccount->ebay_account_type_id, $ebayAccount->core_seller_id);
            $ebayAccount->ebay_credential = $ebayCredential;

            $this->EbayTradingApi->initSession($ebayAccount, $ebaySiteId, false);
            $res = $this->EbayTradingApi->getSessionId(['ruName' => $ebayAccount->ebay_credential->ru_name]);
            $this->EbayTradingApi->validateResponse($res);
            $sessionId = (String)$res->SessionID;

            $sessions = [];
            if ($this->request->getSession()->check('ebay.requestToken.sessions')) {
                $sessions = unserialize($this->request->getSession()->read('ebay.requestToken.sessions'));
            }
            $sessions[$id] = [
                'sessionId' => $sessionId,
                'ebayCredentialId' => $ebayAccount->ebay_credential->id ?? null,
                'creationTime' => time()
            ];
            $this->request->getSession()->write('ebay.requestToken.sessions', serialize($sessions));

            $loginUrl = str_replace(['{domain}', '{RuName}', '{SessionID}'], [$ebaySiteDomain, $ebayAccount->ebay_credential->ru_name, $sessionId], $ebayAccount->ebay_account_type->login_url);

            return $this->redirect($loginUrl);
        } catch (\Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
        $this->redirect($this->referer());
    }

    /**
     * Fetch eBay token
     *
     * @param $id
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function fetchToken($id)
    {
        try {
            $this->autoRender = false;
            $ebaySessions = [];
            if ($this->request->getSession()->check('ebay.requestToken.sessions')) {
                $ebaySessions = unserialize($this->request->getSession()->read('ebay.requestToken.sessions'));
            }
            if (isset($ebaySessions[$id])) {
                $ebayAccount = $this->EbayAccounts->get($id, [
                    'contain' => ['EbayCredentials', 'EbayAccountTypes', 'EbaySites']
                ]);
                $this->loadComponent('Ebay.EbayTradingApi');

                if ($ebayAccount->ebay_credential_id != $ebaySessions[$id]['ebayCredentialId']) {
                    $ebayCredential = $this->EbayAccounts->EbayCredentials->getCredential($ebayAccount->ebay_account_type_id, $ebayAccount->core_seller_id);
                    $ebayAccount->ebay_credential = $ebayCredential;
                }

                $this->EbayTradingApi->initSession($ebayAccount, null, false);
                $res = $this->EbayTradingApi->fetchToken(['sessionId' => $ebaySessions[$id]['sessionId']]);

                $this->EbayTradingApi->validateResponse($res);
                $ebayAccount->token = (String)$res->eBayAuthToken;
                $ebayAccount->token_expiration_time = date('Y-m-d H:i:s', strtotime((String)$res->HardExpirationTime));
                $ebayAccount->ebay_credential_id = $ebaySessions[$id]['ebayCredentialId'];

                $this->EbayTradingApi->initSession($ebayAccount);
                $res = $this->EbayTradingApi->getUser(['detailLevel' => 'ReturnSummary']);
                $ebayUserId = isset($res->User->UserID) ? (String)$res->User->UserID : '';

                if (!empty($ebayUserId)) {
                    $ebayAccount->code = $ebayUserId;
                    $ebayAccount->name = $ebayUserId;
                }

                $this->EbayAccounts->save($ebayAccount);
                unset($ebaySessions[$id]);
                $this->request->getSession()->write('ebay.requestToken.sessions', serialize($ebaySessions));
            }
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }

        return $this->redirect($this->referer());
    }

    /**
     * Set store description
     *
     * @param $id
     * @param $description
     * @throws \Exception
     */
    public function setStoreDescription($id, $description)
    {
        $ebayAccount = $this->EbayAccounts->get($id, [
            'contain' => ['EbayCredentials', 'EbayAccountTypes', 'EbaySites']
        ]);
        $this->loadComponent('Ebay.EbayTradingApi');
        try {
            $this->EbayTradingApi->initSession($ebayAccount);
            $res = $this->EbayTradingApi->setStore(['storeDescription' => $description]);
            $this->EbayTradingApi->validateResponse($res);
            $this->Flash->success('Success');
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
    }

    /**
     * @param $ebayAccountId
     * @throws \Exception
     */
    public function getApiCallLimits($ebayAccountId)
    {
        $ebayAccount = $this->EbayAccounts->find()
            ->where([
                'EbayAccounts.id' => $ebayAccountId
            ])
            ->contain([
                'EbayCredentials', 'EbayAccountTypes', 'EbaySites'
            ])
            ->first();
        $this->loadComponent('Ebay.EbayTradingApi');
        try {
            $this->EbayTradingApi->initSession($ebayAccount);
            $apiAccessRules = $this->EbayTradingApi->getApiAccessRules();
            $this->EbayTradingApi->validateResponse($apiAccessRules);
            $this->set(compact('apiAccessRules'));
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
    }

    /**
     * @param $ebayAccountId
     * @throws \Exception
     */
    public function getNotificationPreferences($ebayAccountId)
    {
        $this->autoRender = false;
        $ebayAccount = $this->EbayAccounts->find()
            ->where([
                'EbayAccounts.id' => $ebayAccountId
            ])
            ->contain([
                'EbayCredentials', 'EbayAccountTypes', 'EbaySites'
            ])
            ->first();
        $this->loadComponent('Ebay.EbayTradingApi');
        try {
            $this->EbayTradingApi->initSession($ebayAccount);
            $notificationPreferences = $this->EbayTradingApi->getNotificationPreferences('User');
            print_r($notificationPreferences);
            $this->EbayTradingApi->validateResponse($notificationPreferences);
            $this->set(compact('notificationPreferences'));
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
    }

    /**
     * @param $ebayAccountId
     * @throws \Exception
     */
    public function getNotificationUsage($ebayAccountId)
    {
        $this->autoRender = false;
        $ebayAccount = $this->EbayAccounts->find()
            ->where([
                'EbayAccounts.id' => $ebayAccountId
            ])
            ->contain([
                'EbayCredentials', 'EbayAccountTypes', 'EbaySites'
            ])
            ->first();
        $this->loadComponent('Ebay.EbayTradingApi');
        try {
            $this->EbayTradingApi->initSession($ebayAccount);
            $notificationUsage = $this->EbayTradingApi->getNotificationsUsage(['startTime' => gmdate('Y-m-d H:i:s', strtotime('-1 day'))]);
            print_r($notificationUsage);
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
    }

    /**
     * @param $ebayAccountId
     * @param $status
     * @throws \Exception
     */
    public function setNotificationPreferences($ebayAccountId, $status)
    {
        $this->autoRender = false;
        $enableStatus = Configure::read('eBayNotificationApi.status.' . $status);

        $callArg = [
            'applicationEnable' => $enableStatus,
            'applicationUrl' => Configure::read('eBayNotificationApi.endPoint'),
            'deviceType' => Configure::read('eBayNotificationApi.deviseType'),
        ];

        $events = Configure::read('eBayNotificationApi.events');
        foreach ($events as $eventName) {
            $callArg['events'][] = [
                'status' => $enableStatus,
                'type' => $eventName
            ];
        }

        $ebayAccount = $this->EbayAccounts->find()
            ->where([
                'EbayAccounts.id' => $ebayAccountId,
                'EbayAccounts.is_active' => 1
            ])
            ->contain([
                'EbayCredentials',
                'EbayAccountTypes',
                'EbaySites'
            ])
            ->first();
        if (!empty($ebayAccount)) {
            $this->loadComponent('Ebay.EbayTradingApi');
            $this->EbayTradingApi->initSession($ebayAccount);
            $res = $this->EbayTradingApi->setNotificationPreferences($callArg);
            $this->EbayTradingApi->validateResponse($res);
            $ebayAccount->use_notifications = $status;
            $this->EbayAccounts->save($ebayAccount);
            print_r($res);
        }
    }

    /**
     * @param $ebayAccountId
     * @throws \Exception
     */
    public function updateUserId($ebayAccountId)
    {
        $this->autoRender = false;
        $ebayAccount = $this->EbayAccounts->find()
            ->where([
                'EbayAccounts.id' => $ebayAccountId
            ])
            ->contain([
                'EbayCredentials', 'EbayAccountTypes', 'EbaySites'
            ])
            ->first();
        $this->loadComponent('Ebay.EbayTradingApi');
        try {
            $this->EbayTradingApi->initSession($ebayAccount);
            $user = $this->EbayTradingApi->getUser();
            $userId = (String)$user->User->UserID ?? null;
            if (!empty($userId)) {
                $ebayAccount->code = $userId;
                $ebayAccount->name = $userId;
                $this->EbayAccounts->save($ebayAccount);
            }
            $this->Flash->success(__('Ebay Account Code updated!'));
        } catch (Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
        $this->redirect($this->referer());
    }

    /**
     * @param null $ebayAccountId
     * @param null $ebaySiteId
     */
    public function setEbaySite($ebayAccountId = null, $ebaySiteId = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);
        $this->loadModel('Ebay.EbayAccountsEbaySites');

        $data = [
            'ebay_account_id' => $ebayAccountId,
            'ebay_site_id' => $ebaySiteId
        ];

        $existingEntry = $this->EbayAccountsEbaySites->find()
            ->where(['ebay_account_id' => $ebayAccountId])
            ->first();

        if (!empty($existingEntry)) {
            $existingEntry->ebay_site_id = $ebaySiteId;
            $this->EbayAccountsEbaySites->save($existingEntry);
        } else {
            $entry = $this->EbayAccountsEbaySites->newEntity($data);
            $this->EbayAccountsEbaySites->save($entry);
        }
    }
}
