<?php

namespace ItoolCustomer\Shell;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\ORM\Query;
use Ebay\Model\Table\EbayCategoriesTable;
use ItoolCustomer\Controller\Component\CatchEbayCategoryMappingComponent;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * @property CsvHandlerComponent $CsvHandler
 * @property CatchEbayCategoryMappingComponent $CatchEbayCategoryMapping
 * @property CustomersTable $Customers
 * @property EbayCategoriesTable $EbayCategories
 * @property NewslettersTable $Newsletters
 * CustomerSalesExport shell command.
 */
class CustomerRegistrationNewsletterSubscriptionExportShell extends Shell
{
    protected $revenuePerSession = 0;
    protected $totalItemsCount = 0;
    protected $totalRevenue = 0;
    protected $ebayFullCategoryPath = '';
    protected $catchCategories = [];
    protected $ebaySites = [];
    protected $couponCodes = '';
    protected $registeredCustomersPath;
    protected $subscribedCustomersPath;
    public $CsvHandler;
    protected $registeredCustomerExportHeader = ROOT . DS . 'plugins' . DS . 'ItoolCustomer' . DS . 'webroot' . DS . 'customer_export_header.csv';
    public $CatchEbayCategoryMapping;

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
        $component = new ComponentRegistry();
        $this->CsvHandler = new CsvHandlerComponent($component);
        $this->loadModel('ItoolCustomer.Customers');
        $this->CatchEbayCategoryMapping = new CatchEbayCategoryMappingComponent($component);
        $this->loadModel('ItoolCustomers.Customers');
        $this->loadModel('Ebay.EbayCategories');
        $this->loadModel('ItoolCustomer.Newsletters');
    }

    /**
     * @return bool|int|void|null
     */
    public function main()
    {
        $this->initialize();
        $this->registeredCustomers();
        $this->subscribedCustomers();
    }

    /**
     *  RegisteredCustomers
     *
     */
    private function registeredCustomers()
    {
        $this->registeredCustomersPath = TMP . DS . 'registered_customers_iways_' . date('dmY-Hi') . '_list' . '.csv';

        $handle = $this->CsvHandler->openHandle($this->registeredCustomersPath, "w+");
        $headers = $this->registeredCustomersHeader();

        fputcsv($handle, $headers);

        $this->Customers->addAssociations([
            'hasOne' => ['CustomerAddresses'],
            'hasMany' => ['EbayCheckoutSessions']
        ]);

        $this->Customers->EbayCheckoutSessions->addAssociations([
            'hasMany' => ['EbayCheckoutSessionItems']
        ]);

        $this->Customers->EbayCheckoutSessions->EbayCheckoutSessionItems->addAssociations([
            'hasMany' => ['EbayCheckoutSessionItemPromotions']
        ]);

        $limit = 50;
        $page = 1;

        do {
            $customers = $this->Customers->find()
                ->contain('EbayCheckoutSessions', function (Query $q) {
                    return $q->select(['EbayCheckoutSessions.customer_id', 'country_code', 'id', 'email', 'purchase_order_id', 'purchase_order_timestamp']);
                })
                ->contain('EbayCheckoutSessions.EbayCheckoutSessionItems', function (Query $q) {
                    return $q->select(['id', 'EbayCheckoutSessionItems.ebay_checkout_session_id', 'ebay_category_path', 'base_price_value', 'base_price_currency', 'net_price_value', 'quantity', 'ebay_item_id']);
                })
                ->contain('EbayCheckoutSessions.EbayCheckoutSessionItems.EbayCheckoutSessionItemPromotions', function (Query $q) {
                    return $q->select(['EbayCheckoutSessionItemPromotions.ebay_checkout_session_item_id', 'promotion_code']);
                })
                ->limit($limit)->page($page++);

            foreach ($customers as $customer) {
                $this->catchCategories = [];
                $genders = ['M' => 1, 'F' => 2, 'D' => 3, '-' => 4];
                $line = [];
                $this->ebayFullCategoryPath = '';
                $this->couponCodes = '';

                $line['first_name'] = isset($customer->first_name) ? substr($customer->first_name, 0, 59) : '';
                $line['last_name'] = isset($customer->last_name) ? substr($customer->last_name, 0, 59) : '';
                $line['postal_code'] = isset($customer->customer_addresses[0]->postal_code) ? $customer->customer_addresses[0]->postal_code : '';
                $line['place'] = isset($customer->customer_addresses[0]->city) ? substr($customer->customer_addresses[0]->city, 0, 59) : '';
                $line['region'] = isset($customer->customer_addresses[0]->state) ? substr($customer->customer_addresses[0]->state, 0, 59) : '';
                $line['email'] = isset($customer->email) ? substr($customer->email, 0, 254) : '';
                $line['date_of_birth'] = '';
                $line['first_order_date'] = '';
                $line['second_order_date'] = '';
                $line['third_order_date'] = '';
                $line['second_last_order_date'] = '';
                $line['third_last_order_date'] = '';
                $line['last_order_date'] = '';
                $line['item_count_total'] = 0;
                $line['transaction_count'] = 0;
                $line['catch_category'] = '';
                $line['norb'] = 2;
                $line['anrede_catch'] = isset($genders[$customer->gender]) ? $genders[$customer->gender] : 4;
                $line['total_revenue'] = 0;
                $line['total_revenue_on_first_purchase'] = 0;
                $line['total_revenue_on_second_purchase'] = 0;
                $line['total_revenue_on_third_purchase'] = 0;
                $line['coupon_used'] = (strlen($this->couponCodes) <= 0) ? 2 : 1;
                $line['total_revenue_on_last_purchase'] = 0;

                if (count($customer->ebay_checkout_sessions) > 0) {
                    $ebayCheckoutSessions = $customer->ebay_checkout_sessions;
                    $line['transaction_count'] = count($ebayCheckoutSessions);

                    $orders = ['first' => 0, 'second' => 1, 'third' => 2, 'last' => count($ebayCheckoutSessions) - 1];

                    foreach ($orders as $key => $order) {
                        $this->revenuePerSession = 0;
                        if (isset($ebayCheckoutSessions[$order]) && ($ebayCheckoutSessions[$order]->purchase_order_id !== NULL) && ($ebayCheckoutSessions[$order]->purchase_order_timestamp !== NULL)) {
                            $line[$key . '_order_date'] = gmdate('Y-m-d', $ebayCheckoutSessions[$order]->purchase_order_timestamp);
                            if ($key !== 'second_last' || $key !== 'third_last') {
                                array_map(array($this, 'revenuePerSession'), $ebayCheckoutSessions[$order]->ebay_checkout_session_items);
                                $line['total_revenue_on_' . $key . '_purchase'] = $this->revenuePerSession;
                            }
                        }
                    }

                    $orderDates = ['second_last' => count($ebayCheckoutSessions) - 2, 'third_last' => count($ebayCheckoutSessions) - 3];

                    foreach ($orderDates as $key => $orderDate) {
                        $this->revenuePerSession = 0;

                        if (isset($ebayCheckoutSessions[$orderDate]) && ($ebayCheckoutSessions[$orderDate]->purchase_order_timestamp !== NULL)) {
                            $line[$key . '_order_date'] = gmdate('Y-m-d', $ebayCheckoutSessions[$orderDate]->purchase_order_timestamp);
                        }
                    }

                    $this->revenuePerSession = 0;
                    $this->totalRevenue = 0;
                    $this->totalItemsCount = 0;
                    array_map(array($this, 'totalRevenueAndItems'), $customer->ebay_checkout_sessions);
                    $line['total_revenue'] = $this->totalRevenue;
                    $line['item_count_total'] = $this->totalItemsCount;
                    $line['coupon_used'] = (strlen($this->couponCodes) <= 0) ? 2 : 1;
                    $this->catchCategories = array_unique($this->catchCategories);
                    sort($this->catchCategories);
                    $line['catch_category'] = implode(';', $this->catchCategories);
                }
                fputcsv($handle, $line);
            }
        } while(count($customers->toArray()) === $limit);

        if (file_exists($this->registeredCustomersPath)) {

            $this->out('Upload started');

            $headers = [
                'API-AUTH-TOKEN' => Configure::read('EisFeedApi.token'),
                'API-UPLOAD-FEED-CODE' => Configure::read('EisFeedApi.feeds.registeredCustomersToEbay.feedCode'),
                'API-UPLOAD-FILE-NAME' => basename($this->registeredCustomersPath)
            ];
            $data = [
                'fileContent' => base64_encode(file_get_contents($this->registeredCustomersPath))
            ];

            $client = new Client();
            $client->post(Configure::read('EisFeedApi.endpoint'), $data, ['headers' => $headers]);

            if (file_exists($this->registeredCustomersPath)) {
                unlink($this->registeredCustomersPath);
            }
            $this->out('Upload finished');
        }
    }

    /**
     *  Creates Subscribed Customers export
     */
    private function subscribedCustomers()
    {
        $this->subscribedCustomersPath = TMP . DS . 'subscribed_customer_iways_' . date('dmY-Hi') . '_list.csv';

        header('Content-Disposition: attachment; filename=' . $this->subscribedCustomersPath);
        header("Content-Transfer-Encoding: UTF-8");

        $handle = $this->CsvHandler->openHandle($this->subscribedCustomersPath, "w+");
        $headers = ['Email ";" Subscribed ";" Subscribe Type ";" influencer'];
        fputcsv($handle, $headers);

        $limit = 50;
        $page = 1;

        do {
            $customers = $this->Customers->find()
                ->innerJoin(
                    ['Newsletters' => 'newsletters'],
                    ['Newsletters.email = Customers.email', 'Newsletters.subscribed = 1'])
                ->select(['Newsletters.subscribe_type', 'email', 'Newsletters.registration_source'])
                ->limit($limit)->page($page++);

            foreach ($customers as $customer) {
                if (isset($customer->email)) {
                    $line = [];
                    $line[0] = $customer->email . '";"' . '1' . '";"' . $customer->Newsletters['subscribe_type']
                             . '";"' . ($customer->Newsletters['registration_source'] == 'influencer' ? '1' : '0');
                    fputcsv($handle, $line);
                }
            }
        } while(count($customers->toArray()) === $limit);

        if (file_exists($this->subscribedCustomersPath)) {

            $this->out('Upload started');

            $headers = [
                'API-AUTH-TOKEN' => Configure::read('EisFeedApi.token'),
                'API-UPLOAD-FEED-CODE' => Configure::read('EisFeedApi.feeds.subscribedCustomersToEbay.feedCode'),
                'API-UPLOAD-FILE-NAME' => basename($this->subscribedCustomersPath)
            ];
            $data = [
                'fileContent' => base64_encode(file_get_contents($this->subscribedCustomersPath))
            ];

            $client = new Client();
            $client->post(Configure::read('EisFeedApi.endpoint'), $data, ['headers' => $headers]);

            if (file_exists($this->subscribedCustomersPath)) {
                unlink($this->subscribedCustomersPath);
            }
            $this->out('Upload finished');
        }
    }

    /**
     * @param $ebayCheckoutSessionItem
     * @return int
     */
    private function revenuePerSession($ebayCheckoutSessionItem)
    {
        $this->revenuePerSession += $ebayCheckoutSessionItem->net_price_value;
        $this->totalItemsCount += $ebayCheckoutSessionItem->quantity;
        return $this->revenuePerSession;
    }

    /**
     * @param $ebayCheckoutSession
     * @return int
     * @throws \Exception
     */
    private function totalRevenueAndItems($ebayCheckoutSession)
    {
        if (($ebayCheckoutSession->purchase_order_id !== NULL) && ($ebayCheckoutSession->purchase_order_timestamp !== NULL)) {
            foreach ($ebayCheckoutSession->ebay_checkout_session_items as $ebayCheckoutSessionItem) {
                $this->revenuePerSession = 0;
                $this->revenuePerSession($ebayCheckoutSessionItem);
                $this->totalRevenue += $this->revenuePerSession;
                if (isset($ebayCheckoutSessionItem->ebay_category_path) && !empty($ebayCheckoutSessionItem->ebay_category_path)) {
                    $this->catchCategories = array_merge($this->CatchEbayCategoryMapping->getCatchCategoryFromEbayCategoryPath($ebayCheckoutSessionItem), $this->catchCategories);
                }

                if (count($ebayCheckoutSessionItem->ebay_checkout_session_item_promotions) > 0) {
                    array_map(array($this, 'couponsInformation'), $ebayCheckoutSessionItem->ebay_checkout_session_item_promotions);
                }
            }
        }
        return $this->totalRevenue;
    }

    /**
     * @param $ebayCheckoutSessionItemPromotion
     * @return string
     */
    private function couponsInformation($ebayCheckoutSessionItemPromotion)
    {
        $this->couponCodes .= ((strlen($this->couponCodes) <= 0) ? '' : '; ') . $ebayCheckoutSessionItemPromotion->promotion_code;
        return $this->couponCodes;
    }

    /**
     * @return array
     */
    private function registeredCustomersHeader()
    {
        return explode(',', file_get_contents($this->registeredCustomerExportHeader));
    }
}
