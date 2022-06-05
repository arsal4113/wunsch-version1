<?php

namespace ItoolCustomer\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Ebay\Model\Table\EbayCategoriesTable;
use ItoolCustomer\Controller\AppController;
use ItoolCustomer\Shell\CustomerSalesExportShell;
use function foo\func;

/**
 * Customers Controller
 *
 * @property \ItoolCustomer\Model\Table\CustomersTable $Customers
 * @property \App\Controller\Component\CsvHandlerComponent $CsvHandler
 * @property EbayCategoriesTable $EbayCategories
 *
 * @method \ItoolCustomer\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends \App\Controller\AppController
{
    public $components = ['CsvHandler'];
    protected $revenuePerSession = 0;
    protected $totalItemsCount = 0;
    protected $totalRevenue = 0;
    protected $ebayCategoryPaths = [];
    protected $ebayFullCategoryPath = '';
    protected $ebaySites = [];
    protected $couponCodes = '';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Ebay.EbayCategories');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'order' => [
                'modified' => 'desc'
            ],
            'sortWhitelist' => [
                'id', 'first_name', 'last_name', 'email', 'modified', 'street_line_1', 'postal_code'
            ],
            'contain' => [
                'SocialProfiles', 'CustomerAddresses'
            ],
        ];
        $availableColumns = ['id', 'first_name', 'last_name', 'email', 'modified',
            'street_line_1', 'postal_code', 'legacy_order_id'];

        $customers = $this->Customers->find('searchable', $this->request->getQueryParams());

        $customers->contain('EbayCheckoutSessions', function (Query $q) {
            return $q->where(['purchase_order_id IS NOT' => null])->orderDesc('purchase_order_timestamp');
        });

        if (!empty($this->request->getQueryParams()['street_line_1']) ||
            !empty($this->request->getQueryParams()['postal_code'])) {
            $findSearchable = function (Query $q) {
                return $q->find('searchable', $this->request->getQueryParams());
            };
            $customers = $customers
                ->matching('CustomerAddresses', $findSearchable);
        }

        if (!empty($this->request->getQueryParams()['legacy_order_id'])) {
            $findSearchable = function (Query $q) {
                return $q->find('searchable', $this->request->getQueryParams());
            };
            $customers = $customers
                ->matching('EbayCheckoutSessions.EbayCheckoutSessionItems', $findSearchable);
        }

        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('customers', $this->paginate($customers));
    }


    /**
     * @param null $id
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [
                'EbayCheckoutSessions' => function (Query $q) {
                    return $q->where(['purchase_order_id IS NOT' => null])
                        ->contain(['EbayCheckoutSessionItems.SelectedEbayCheckoutSessionItemShippings']);
                },
                'CustomerAddresses',
                'CustomerWishlistItems',
                'Newsletter']
        ]);

        $this->set('customer', $customer);
    }

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        $customer = $this->Customers->patchEntity($customer, ['is_deleted' => 1]);

        if ($this->Customers->save($customer)) {
            $this->Customers->Newsletters->deleteAll(['customer_id' => $customer->id]);
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function download()
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $this->autoRender = false;

        if ($this->request->is('post')) {
            $filename = TMP . 'registered_customers_short.csv';
            $handle = $this->CsvHandler->openHandle($filename, "w");
            $headers = [
                __('Id'),
                __('FirstName'),
                __('LastName'),
                __('E-Mail'),
                __('Address'),
                __('Postal Code'),
                __('City'),
                __('Provider'),
                __('Last Purchase'),
                __('Timestamp')
            ];
            $this->CsvHandler->writeCsvLine($headers, $handle, count($headers), ";");

            $customers = $this->Customers->find()
                ->select([
                    'id', 'first_name', 'last_name', 'email', 'created',
                ])
                ->contain('SocialProfiles', function (Query $q) {
                    return $q->select(['user_id', 'provider']);
                })
                ->contain('CustomerAddresses', function (Query $q) {
                    return $q->select(['customer_id', 'street_line_1', 'city', 'postal_code']);
                })
                ->contain('EbayCheckoutSessions', function (Query $q) {
                    return $q->select(['purchase_order_timestamp', 'customer_id'])
                        ->where(['purchase_order_id IS NOT' => null])->orderDesc('purchase_order_timestamp');
                })
                ->orderDesc('Customers.id')
                ->toArray();

            foreach ($customers as $customer) {
                $line = [
                    $customer->id,
                    trim($customer->first_name),
                    trim($customer->last_name),
                    trim($customer->email),
                    $customer->customer_addresses[0]->street_line_1 ?? '',
                    $customer->customer_addresses[0]->postal_code ?? '',
                    $customer->customer_addresses[0]->city ?? '',
                    $customer->ebay_registered ? 'eBay' : ($customer->social_profiles[0]->provider ?? ''),
                    isset($customer->ebay_checkout_sessions[0]->purchase_order_timestamp)
                        ? Time::createFromTimestamp($customer->ebay_checkout_sessions[0]->purchase_order_timestamp) : '',
                    $customer->created
                ];
                $this->CsvHandler->writeCsvLine($line, $handle, count($line), ";");
            }

            return $this->response->withFile($filename, ['download' => true]);
        }
    }
}
