<?php

namespace EbayCheckout\Controller;

use Cake\ORM\Query;
use Cake\Utility\Inflector;
use Cake\I18n\Time;

/**
 * EbayCheckouts Controller
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutsTable $EbayCheckouts
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckout[] paginate($object = null, array $settings = [])
 *
 * @property \EbayCheckout\Controller\Component\CheckoutSessionsFileComponent $CheckoutSessionsFile
 */
class EbayCheckoutsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoreSellers']
        ];
        $ebayCheckouts = $this->paginate($this->EbayCheckouts);

        $this->set(compact('ebayCheckouts'));
        $this->set('_serialize', ['ebayCheckouts']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Checkout id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayCheckout = $this->EbayCheckouts->get($id, [
            'contain' => ['CoreSellers', 'EbayCheckoutSessions']
        ]);

        $this->set('ebayCheckout', $ebayCheckout);
        $this->set('_serialize', ['ebayCheckout']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebayCheckout = $this->EbayCheckouts->newEntity();
        if ($this->request->is('post')) {
            $ebayCheckout = $this->EbayCheckouts->patchEntity($ebayCheckout, $this->request->getData());
            if ($this->EbayCheckouts->save($ebayCheckout)) {
                $this->Flash->success(__('The ebay checkout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ebay checkout could not be saved. Please, try again.'));
        }
        $coreSellers = $this->EbayCheckouts->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('ebayCheckout', 'coreSellers'));
        $this->set('_serialize', ['ebayCheckout']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Checkout id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebayCheckout = $this->EbayCheckouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebayCheckout = $this->EbayCheckouts->patchEntity($ebayCheckout, $this->request->getData());
            if ($this->EbayCheckouts->save($ebayCheckout)) {
                $this->Flash->success(__('The ebay checkout has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ebay checkout could not be saved. Please, try again.'));
        }
        $coreSellers = $this->EbayCheckouts->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('ebayCheckout', 'coreSellers'));
        $this->set('_serialize', ['ebayCheckout']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Checkout id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebayCheckout = $this->EbayCheckouts->get($id);
        if ($this->EbayCheckouts->delete($ebayCheckout)) {
            $this->Flash->success(__('The ebay checkout has been deleted.'));
        } else {
            $this->Flash->error(__('The ebay checkout could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * indexSessions
     */
    public function indexSessions()
    {
        $this->paginate = [
            'order' => [
                'modified' => 'desc'
            ],
            'sortWhitelist' => [
                'first_name', 'last_name', 'email', 'modified', 'ebay_checkout_session_id', 'purchase_order_id', 'value',
                'address_line_1', 'postal_code', 'city', 'legacy_order_id'
            ],
        ];

        $availableColumns = ['last_name', 'first_name', 'email', 'modified', 'ebay_checkout_session_id', 'purchase_order_id',
            'address_line_1', 'postal_code', 'city', 'legacy_order_id'];

        $sessions = $this->EbayCheckouts->EbayCheckoutSessions->find('searchable', $this->request->getQueryParams())
            ->where([
                'purchase_order_id IS NOT' => null
            ])
            ->select(['id', 'last_name', 'first_name', 'email', 'ebay_checkout_session_id', 'purchase_order_id', 'modified'])
            ->matching('EbayCheckoutSessionTotals', function (Query $q) {
                return $q->where(['EbayCheckoutSessionTotals.code' => 'total']);
            })
            ->select(['value' => 'EbayCheckoutSessionTotals.value', 'currency' => 'EbayCheckoutSessionTotals.currency'])
            ->contain('EbayCheckoutSessionShippingAddresses')
            ->select(['address_line_1' => 'EbayCheckoutSessionShippingAddresses.address_line_1',
                'postal_code' => 'EbayCheckoutSessionShippingAddresses.postal_code', 'city' => 'EbayCheckoutSessionShippingAddresses.city']);

        if (!empty(array_intersect(array_keys($this->request->getQueryParams()),
            ['address_line_1', 'postal_code', 'city']))) {

            $findSearchable = function (Query $q) {
                return $q->find('searchable', $this->request->getQueryParams());
            };
            $sessions = $sessions
                ->matching('EbayCheckoutSessionShippingAddresses', $findSearchable)
                ->select($this->EbayCheckouts->EbayCheckoutSessions->EbayCheckoutSessionShippingAddresses);
        }

        if (!empty($this->request->getQueryParams()['legacy_order_id'])) {
            $findSearchable = function (Query $q) {
                return $q->find('searchable', $this->request->getQueryParams());
            };
            $sessions = $sessions
                ->matching('EbayCheckoutSessionItems', $findSearchable)
                ->select($this->EbayCheckouts->EbayCheckoutSessions->EbayCheckoutSessionItems);
        }

        $this->set('sessions', $this->paginate($sessions));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
    }

    /**
     * @param null $id
     */
    public function viewSession($id = null)
    {
        $session = $this->EbayCheckouts->EbayCheckoutSessions->get($id, [
            'contain' => [
                'EbayCheckoutSessionShippingAddresses',
                'EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings'
            ]
        ]);

        $this->set('session', $session);
    }

    /**
     * @return \Cake\Http\Response
     * @throws \Exception
     */
    public function exportSessions()
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', -1);

        $filteredFields = [
            'ebay_epn_campaign_id',
            'ebay_epn_reference_id',
            'order_payment_status',
            'utm_campaign',
            'utm_content',
            'utm_medium',
            'utm_source'
        ];

        $filteredValues = [];
        foreach ($filteredFields as $filteredField) {
            $filteredValues[$filteredField] = Inflector::variable(Inflector::pluralize($filteredField));
        }

        if ($this->request->is(['post'])) {
            /**
             * @var string $year
             * @var string $month
             * @var string $day
             * @var string $hour
             * @var array $ebayEpnCampaignIds
             * @var array $ebayEpnReferenceIds
             * @var array $orderPaymentStatuses
             * @var array $utmCampaigns
             * @var array $utmContents
             * @var array $utmMedia
             * @var array $utmSources
             * @var bool $subscribedNewsletter
             */
            extract($this->request->getData('startTime'));
            $startTime = $year && $month && $day && $hour ? Time::create($year, $month, $day, $hour) : null;

            extract($this->request->getData('endTime'));
            $endTime = $year && $month && $day && $hour ? Time::create($year, $month, $day, $hour) : null;

            $subscribedNewsletter = ['' => null, '0' => false, '1' => true][$this->request->getData('subscribedNewsletter')];

            foreach ($filteredValues as $filteredField => $filteredValue) {
                $$filteredValue = $this->request->getData($filteredValue) ?: null;
            }

            $this->loadComponent('EbayCheckout.CheckoutSessionsFile');
            $filename = $this->CheckoutSessionsFile->generateFeed(
                $startTime,
                $endTime,
                $ebayEpnCampaignIds,
                $ebayEpnReferenceIds,
                $orderPaymentStatuses,
                $utmCampaigns,
                $utmContents,
                $utmMedia,
                $utmSources,
                $subscribedNewsletter);

            $response = $this->response->withFile($filename, ['download' => true]);
            return $response;
        }

        foreach ($filteredValues as $filteredField => $filteredValue) {
            $$filteredValue = $this->EbayCheckouts->EbayCheckoutSessions->find('list', ['keyField' => $filteredField, 'valueField' => $filteredField])
                ->where(['purchase_order_id IS NOT' => null])
                ->where([$filteredField .' IS NOT' => null])
                ->select($filteredField)
                ->group($filteredField);

            $this->set($filteredValue, $$filteredValue);
        }

        $this->set('filteredValues', $filteredValues);
        $this->set('startTime', Time::now()->subHours(24));
        $this->set('endTime', Time::now());
    }
}
