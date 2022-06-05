<?php

namespace Dashboard\View\Cell;

use Cake\I18n\Time;
use Cake\View\Cell;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;

/**
 * Orders cell
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 */
class OrdersCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];
    private $ordersPerDay = [];
    private $turnoverPerDay = [];

    /**
     * Number of orders method.
     *
     * @param string $dashboardType
     * @param integer $currentSellerId
     * @param integer $currentUserId
     * @return void
     */
    public function numberOfOrders($dashboardType, $currentSellerId, $currentUserId)
    {
        /** @var EbayCheckoutSessionsTable $checkoutSessions */
        $ebayCheckoutSessions = $this->loadModel('EbayCheckout.EbayCheckoutSessions');

        switch($dashboardType) {
            case "user":
                $identifier['core_user_id'] = $currentUserId;
                break;
            case "seller":
                $identifier['core_seller_id'] = $currentSellerId;
                break;
        }

        $orders = $ebayCheckoutSessions->find()
            ->where(['purchase_order_id IS NOT' => null]);

        $numberOfOrders = new \stdclass;
        $numberOfOrders->total = (clone $orders)->count();

        $quarterStart = Time::now()->toQuarter(true)[0];
        $quarterEnd = Time::now()->toQuarter(true)[1];

        $inQuarter = [
            'created >' => $quarterStart,
            'created <=' => $quarterEnd
        ];

        $numberOfOrders->quarter = (clone $orders)->where($inQuarter)->count();
        $numberOfOrders->quarterEstimate = (int) ($numberOfOrders->quarter * (strtotime($quarterEnd) - strtotime($quarterStart)) / (time() - strtotime($quarterStart)));

        $numberOfOrders->uniqueBuyersTotal = (clone $orders)->select(['email'])->distinct(['email'])->count();
        $numberOfOrders->uniqueBuyersQuarter = (clone $orders)->where($inQuarter)->select(['email'])->distinct(['email'])->count();

        $numberOfOrders->registeredBuyersTotal = (clone $orders)->select(['customer_id'])->where(['customer_id IS NOT' => null])->distinct(['customer_id'])->count();
        $numberOfOrders->registeredBuyersQuarter = (clone $orders)->where($inQuarter)->select(['customer_id'])->where(['customer_id IS NOT' => null])->distinct(['customer_id'])->count();

        $numberOfOrders->turnoverTotal = (clone $orders)->innerJoinWith('EbayCheckoutSessionItems')
            ->select([
                'turnover' => $orders->func()->sum('EbayCheckoutSessionItems.net_price_value')
            ])->first()->turnover;

        $inQuarter = [
            'EbayCheckoutSessions.created >' => $quarterStart,
            'EbayCheckoutSessions.created <=' => $quarterEnd
        ];

        $numberOfOrders->turnoverQuarter = (clone $orders)->innerJoinWith('EbayCheckoutSessionItems')
            ->where($inQuarter)
            ->select([
                'turnover' => $orders->func()->sum('EbayCheckoutSessionItems.net_price_value')
            ])->first()->turnover;

        $this->set(compact('numberOfOrders'));
    }

    /**
     * Get month values for chart
     *
     * @return array
     */
    private function getMonthValuesForChart()
    {
        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[$m] = date('Y, m, 1', mktime(0,0,0,$m, 1, date('Y')));
        }
        return $months;
    }

    /**
     * Last Two Weeks orders
     */
    public function getLastOrders()
    {
        /** @var EbayCheckoutSessionsTable $checkoutSessions */
        $this->loadModel('EbayCheckout.EbayCheckoutSessions');
        $ebayCheckoutSessions = $this->EbayCheckoutSessions->find()->where(['purchase_order_id IS NOT' => null, 'purchase_order_timestamp >=' => strtotime('-14 days midnight')])->contain(['EbayCheckoutSessionItems'])->toArray();
        array_map(array($this,'ordersCountPerDay'), $ebayCheckoutSessions);
        $this->set(compact('ebayCheckoutSessions'));
        $this->set('ordersPerDay', $this->ordersPerDay);
        $this->set('turnoverPerDay', $this->turnoverPerDay);
    }

    /**
     * @param $ebayCheckoutSession
     */
    public function ordersCountPerDay($ebayCheckoutSession)
    {
        if (isset($this->ordersPerDay[date('Y-m-d', $ebayCheckoutSession->purchase_order_timestamp)])) {
            $this->ordersPerDay[date('Y-m-d', $ebayCheckoutSession->purchase_order_timestamp)] += 1;
        } else {
            $this->ordersPerDay[date('Y-m-d', $ebayCheckoutSession->purchase_order_timestamp)] = 1;
        }

        $this->turnoverPerDay($ebayCheckoutSession->ebay_checkout_session_items, date('Y-m-d', $ebayCheckoutSession->purchase_order_timestamp));
    }

    public function turnoverPerDay($ebayCheckoutItems, $date)
    {
        if(!isset($this->turnoverPerDay[$date])) {
            $this->turnoverPerDay[$date] = 0;
        }

        foreach ($ebayCheckoutItems as $ebayCheckoutItem)
        {
            $this->turnoverPerDay[$date] += $ebayCheckoutItem->net_price_value;
        }
    }

    /**
     * Current Week Turnover
     */
    public function currentWeekTurnover()
    {
        $currentWeekTurnover = 0;
        /** @var EbayCheckoutSessionsTable $checkoutSessions */
        $this->loadModel('EbayCheckout.EbayCheckoutSessions');
        $ebayCheckoutSessions = $this->EbayCheckoutSessions->find()->where(['purchase_order_id IS NOT' => null, 'purchase_order_timestamp >=' => strtotime('last sunday midnight')])->contain(['EbayCheckoutSessionItems']);

        foreach ($ebayCheckoutSessions as $ebayCheckoutSession)
        {
            foreach ($ebayCheckoutSession->ebay_checkout_session_items as $ebayCheckoutSessionItem)
            {
                $currentWeekTurnover += $ebayCheckoutSessionItem->net_price_value;
            }
        }

        $this->set('currentWeekTurnover', $currentWeekTurnover);
    }

    /**
     * Current Quarter Order Info
     */
    public function currentQuarterOrderInfo()
    {
        $quarters = [1 => 'Jan 1', 2 => 'Apr 1', 3 => 'Jul 1', 4 => 'Oct 1'];
        $currentQuarter = ceil(date('m')/3);
        $numberOfDaysInCurrentQuarter = round((\time() - strtotime($quarters[$currentQuarter] . ' ' . date('Y')))/(24 * 60 * 60));

        /** @var EbayCheckoutSessionsTable $checkoutSessions */
        $this->loadModel('EbayCheckout.EbayCheckoutSessions');
        $ebayCheckoutSessions = $this->EbayCheckoutSessions->find()->where(['purchase_order_id IS NOT' => null, 'purchase_order_timestamp >=' => strtotime($quarters[$currentQuarter] . ' ' . date('Y'))])->contain(['EbayCheckoutSessionItems']);

        $averageOrdersPerDayInQuarter = ($ebayCheckoutSessions->count())/$numberOfDaysInCurrentQuarter;

        $totalRevenue = 0;

        foreach ($ebayCheckoutSessions as $ebayCheckoutSession)
        {
            foreach ($ebayCheckoutSession->ebay_checkout_session_items as $ebayCheckoutSessionItem)
            {
                $totalRevenue += $ebayCheckoutSessionItem->net_price_value;
            }
        }

        $averageRevenuePerDayInQuarter = $totalRevenue/$numberOfDaysInCurrentQuarter;

        $this->set('averageOrdersPerDayInQuarter', $averageOrdersPerDayInQuarter);
        $this->set('averageRevenuePerDayInQuarter', $averageRevenuePerDayInQuarter);
    }
}
