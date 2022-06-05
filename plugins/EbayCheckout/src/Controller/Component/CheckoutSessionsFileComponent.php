<?php

namespace EbayCheckout\Controller\Component;

use Cake\Controller\Component;
use Cake\Orm\TableRegistry;
use Cake\Core\Configure;
use Cake\I18n\Time;
use EbayCheckout\Model\Table\EbayCheckoutsTable;

/**
 * SaveSessionsToFile component
 *
 * @property \App\Controller\Component\CsvHandlerComponent $CsvHandler
 * @property EbayCheckoutsTable $EbayCheckouts
 */
class CheckoutSessionsFileComponent extends Component
{
    public $components = ['CsvHandler'];
    public $EbayCheckouts;

    /**
     * @param Time|null $dateFrom
     * @param Time|null $dateTo
     * @param array|null $ebayEpnCampaignIds
     * @param array|null $ebayEpnReferenceIds
     * @param array|null $orderPaymentStatuses
     * @param array|null $utmCampaigns
     * @param array|null $utmContents
     * @param array|null $utmMedia
     * @param array|null $utmSources
     * @param bool|null $subscribedNewsletter
     * @return string Saved csv file of checkout sessions in time range
     */
    public function generateFeed($dateFrom = null,
                                 $dateTo = null,
                                 $ebayEpnCampaignIds = null,
                                 $ebayEpnReferenceIds = null,
                                 $orderPaymentStatuses = null,
                                 $utmCampaigns = null,
                                 $utmContents = null,
                                 $utmMedia = null,
                                 $utmSources = null,
                                 $subscribedNewsletter = null)
    {
        $this->EbayCheckouts = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckouts');

        $filename = TMP . Configure::read('CheckoutSessions.fileName');
        $handle = $this->CsvHandler->openHandle($filename, "w");
        $headers = [
            __('FirstName'),
            __('LastName'),
            __('E-Mail'),
            __('Transaction ID'),
            __('Purchase Order ID'),
            __('Purchase Order Payment Status'),
            __('Amount'),
            __('Timestamp'),
            __('Marketing Consent'),
            __('eBay APP ID'),
            __('eBay EPN Reference ID'),
            __('eBay EPN Campaign ID'),
            __('UTM Campaign'),
            __('UTM Content'),
            __('UTM Medium'),
            __('UTM Source'),
            __('Catch Newsletter'),
            __('Top Rated Buying Experience')
        ];
        $this->CsvHandler->writeCsvLine($headers, $handle, count($headers), ";");

        $limit = 1500;
        $page = 1;

        do {
            $sessions = $this->EbayCheckouts->EbayCheckoutSessions->find();
            $sessions
                ->where([
                    'purchase_order_id IS NOT' => null
                ])
                ->select(['last_name', 'first_name', 'email', 'ebay_checkout_session_id', 'purchase_order_id', 'order_payment_status',
                    'modified', 'marketing_consent', 'ebay_app_id', 'ebay_epn_reference_id', 'ebay_epn_campaign_id',
                    'utm_campaign', 'utm_content', 'utm_medium', 'utm_source'])
                ->leftJoin(
                    ['EbayCheckoutSessionTotals' => 'ebay_checkout_session_totals'],
                    ['EbayCheckoutSessionTotals.ebay_checkout_session_id = EbayCheckoutSessions.id', 'EbayCheckoutSessionTotals.code = "total"'])
                ->leftJoin(
                    ['Newsletters' => 'newsletters'],
                    ['Newsletters.email = EbayCheckoutSessions.email', 'Newsletters.subscribed = 1'])
                ->leftJoin(
                    ['EbayCheckoutSessionItems' => 'ebay_checkout_session_items'],
                    ['EbayCheckoutSessionItems.ebay_checkout_session_id = EbayCheckoutSessions.id'])
                ->select(['newsletter_subscribed' => $sessions->newExpr('IF(COUNT(Newsletters.id) > 0, 1, 0)')])
                ->select(['amount' => $sessions->newExpr('MAX(EbayCheckoutSessionTotals.value)')])
                ->select(['top_rated_buying_experience' => $sessions->newExpr()
                    ->addCase(
                        [
                            $sessions->newExpr('SUM(EbayCheckoutSessionItems.top_rated_buying_experience) = 0'),
                            $sessions->newExpr('COUNT(EbayCheckoutSessionItems.id) = SUM(EbayCheckoutSessionItems.top_rated_buying_experience)'),
                        ],
                        [__('No'), __('Yes'), __('Partially')],
                        ['string', 'string', 'string']
                    )
                ])
                ->from(['EbayCheckoutSessions FORCE INDEX (purchase_order_id)' => 'ebay_checkout_sessions'], true)
                ->group('EbayCheckoutSessions.id')
                ->orderDesc('EbayCheckoutSessions.modified')
                ->limit($limit)
                ->page($page++);

            if ($dateFrom !== null) {
                $sessions = $sessions->where(['EbayCheckoutSessions.modified >=' => $dateFrom]);
            }
            if ($dateTo !== null) {
                $sessions = $sessions->where(['EbayCheckoutSessions.modified <=' => $dateTo]);
            }
            if (!empty($ebayEpnCampaignIds)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.ebay_epn_campaign_id IN' => $ebayEpnCampaignIds]);
            }
            if (!empty($ebayEpnReferenceIds)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.ebay_epn_reference_id IN' => $ebayEpnReferenceIds]);
            }
            if (!empty($orderPaymentStatuses)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.order_payment_status IN' => $orderPaymentStatuses]);
            }
            if (!empty($utmCampaigns)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.utm_campaign IN' => $utmCampaigns]);
            }
            if (!empty($utmContents)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.utm_content IN' => $utmContents]);
            }
            if (!empty($utmMedia)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.utm_medium IN' => $utmMedia]);
            }
            if (!empty($utmSources)) {
                $sessions = $sessions->where(['EbayCheckoutSessions.utm_source IN' => $utmSources]);
            }
            if (!is_null($subscribedNewsletter)) {
                $sessions = $sessions->where(['Newsletters.id IS' . ($subscribedNewsletter === true ? ' NOT' : '') => null]);
            }

            foreach ($sessions as $session) {
                $line = [
                    trim($session->last_name),
                    trim($session->first_name),
                    trim($session->email),
                    $session->ebay_checkout_session_id,
                    $session->purchase_order_id,
                    $session->order_payment_status,
                    $session->amount,
                    !empty($session->modified) ? $session->modified->i18nFormat('yyyy-MM-dd HH:mm:ss') : '',
                    $session->marketing_consent == 1 ? __('Yes') : __('No'),
                    $session->ebay_app_id,
                    $session->ebay_epn_reference_id,
                    $session->ebay_epn_campaign_id,
                    $session->utm_campaign,
                    $session->utm_content,
                    $session->utm_medium,
                    $session->utm_source,
                    $session->newsletter_subscribed ? __('Yes') : __('No'),
                    $session->top_rated_buying_experience
                ];
                $this->CsvHandler->writeCsvLine($line, $handle, count($line), ";");
            }
        } while (count($sessions->toArray()) == $limit);

        $this->CsvHandler->closeHandle($handle);
        return $filename;
    }
}
