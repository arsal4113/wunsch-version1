<?php

namespace EbayCheckout\Shell;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Http\Client;
use Cake\Core\Configure;
use Cake\I18n\Time;
use EbayCheckout\Model\Table\EbayCheckoutsTable;
use VisitManager\Shell\AbstractUploadShell;

/**
 * UploadCheckoutSessions shell command.
 *
 * @property CsvHandlerComponent CsvHandler
 * @property EbayCheckoutsTable $EbayCheckouts
 */
class UploadCheckoutSessionsShell extends AbstractUploadShell
{
    protected $offsetInDays = 1;
    protected $originTimeZone = 'CET';
    protected $convertTimeZone = 'MST';

    /**
     * @return bool|int|void|null
     */
    public function main()
    {
        if (isset($this->args[0]) && is_numeric($this->args[0])) {
            $this->offsetInDays = $this->args[0];
        }
        if (isset($this->args[1])) {
            $this->originTimeZone = $this->args[1];
        }
        if (isset($this->args[2])) {
            $this->convertTimeZone = $this->args[2];
        }

        $this->out('Upload of Checkout Sessions Shell started');

        try {
            $baseDate = new Time(strtotime('-' . $this->offsetInDays . ' days'), $this->convertTimeZone);

            $timeStart = (new Time())->setTimezone($this->convertTimeZone)->setDateTime($baseDate->year, $baseDate->month, $baseDate->day, 0, 0, 0);
            $timeEnd = (new Time())->setTimezone($this->convertTimeZone)->setDateTime($baseDate->year, $baseDate->month, $baseDate->day, 23, 59, 59);

            if (!empty($this->originTimeZone)) {
                $timeStart->setTimezone($this->originTimeZone);
                $timeEnd->setTimezone($this->originTimeZone);
            }

            $filePath = $this->generateFeed($timeStart, $timeEnd);

            if (!empty($filePath)) {
                $this->out('gzip started');

                $gzipFilePath = $this->createGzipFile($filePath);
                if (!empty($gzipFilePath)) {

                    $this->out('Upload started');

                    $uploadFileName = 'iways_purchase_ord_' . ($baseDate->addDay())->i18nFormat('yyyyMMdd') . '.csv.gz';

                    $headers = [
                        'API-AUTH-TOKEN' => Configure::read('EisFeedApi.token'),
                        'API-UPLOAD-FEED-CODE' => Configure::read('EisFeedApi.feeds.checkoutSession.feedCode'),
                        'API-UPLOAD-FILE-NAME' => $uploadFileName
                    ];
                    $data = [
                        'fileContent' => base64_encode(file_get_contents($gzipFilePath))
                    ];
                    $client = new Client();
                    $client->post(Configure::read('EisFeedApi.endpoint'), $data, ['headers' => $headers]);

                    if (file_exists($gzipFilePath)) {
                        unlink($gzipFilePath);
                    }
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $this->out('Upload finished');
                }
            }
        } catch (\Exception $exp) {
            $this->err($exp->getMessage());
        }
    }

    /**
     * @param Time $dateFrom
     * @param Time $dateTo
     * @return string
     */
    public function generateFeed(Time $dateFrom, Time $dateTo)
    {
        $this->loadModel('EbayCheckout.EbayCheckouts');

        $filename = TMP . Configure::read('EisFeedApi.feeds.checkoutSession.fileName');#'checkout_sessions_export.csv';
        $this->openUploadFile($filename, 'w')
            ->writeFileHeader($this->getFileHeader());

        $limit = 100;
        $page = 1;

        do {
            $sessions = $this->EbayCheckouts->EbayCheckoutSessions->find()
                ->contain([
                    'EbayCheckoutSessionTotals'
                ])
                ->where([
                    'EbayCheckoutSessions.purchase_order_id IS NOT' => null,
                    'EbayCheckoutSessions.modified >=' => $dateFrom->i18nFormat("yyyy-MM-dd HH:mm:ss"),
                    'EbayCheckoutSessions.modified <=' => $dateTo->i18nFormat("yyyy-MM-dd HH:mm:ss")
                ])
                ->orderDesc('modified')
                ->limit($limit)
                ->page($page++);

            foreach ($sessions as $session) {
                /** @var \EbayCheckout\Model\Entity\EbayCheckoutSession $session */
                $amount = null;
                foreach ($session->ebay_checkout_session_totals as $total) {
                    if ($total->code == 'total') {
                        $amount = $total->value;
                    }
                }
                $line = [
                    trim($session->last_name),
                    trim($session->first_name),
                    trim($session->email),
                    $session->ebay_checkout_session_id,
                    $session->purchase_order_id,
                    $amount,
                    $session->modified->i18nFormat('yyyy-MM-dd HH:mm:ss'),
                    $session->marketing_consent == 1 ? __('Yes') : __('No'),
                    $session->ebay_app_id,
                    $session->ebay_epn_reference_id,
                    $session->ebay_epn_campaign_id
                ];
                $this->writeFileLine($line);
            }
        } while (count($sessions->toArray()) == $limit);

        $this->closeUploadFile();

        return $filename;
    }

    /**
     * @return array
     */
    protected function getFileHeader()
    {
        return [
            __('Name'),
            __('Vorname'),
            'Mail',
            'Transaction ID',
            'Purchase Order ID',
            __('Amount'),
            'Timestamp',
            __('Marketing Consent'),
            __('eBay APP ID'),
            __('eBay EPN Reference ID'),
            __('eBay EPN Campaign ID')
        ];
    }

    /**
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser
            ->addArgument('offset', [
                'help' => 'Offset in days.',
                'required' => false
            ])
            ->addArgument('originTimeZone', [
                'help' => 'Origin time zone of the checkout sessions. Default is CEST.',
                'required' => false
            ])
            ->addArgument('convertTimeZone', [
                'help' => 'desired time zone for export. Default is null.',
                'required' => false
            ])
            ->setDescription('<info>' . __('Shell to export checkout sessions.') . '</info>');
        return $parser;
    }
}
