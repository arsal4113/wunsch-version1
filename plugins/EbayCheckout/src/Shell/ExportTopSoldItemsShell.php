<?php

namespace EbayCheckout\Shell;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\I18n\Time;
use Cake\Datasource\Exception\MissingModelException;
use Cake\Core\Exception\Exception;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable;

/**
 * ExportTopSoldItems shell command.
 * @property CsvHandlerComponent $CsvHandler
 * @property EbayCheckoutSessionItemsTable $EbayCheckoutSessionItems
 */
class ExportTopSoldItemsShell extends Shell
{

    protected $delimiter = ';';
    protected $handle;
    protected $offsetInDays = 30;

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * @return bool|int|void|null
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
        $this->CsvHandler = new CsvHandlerComponent(new ComponentRegistry());

        if (isset($this->args[0]) && is_numeric($this->args[0])) {
            $this->offsetInDays = $this->args[0];
        }

        $this->out('Upload of Top Sold Items Shell started');

        try {
            $baseDate = new Time(strtotime('-1 day'));
            $dateTimeEnd = (new Time())->setDateTime($baseDate->year, $baseDate->month, $baseDate->day, 23, 59, 59);
            $baseDate->modify('-' . $this->offsetInDays . ' days');
            $dateTimeStart = (new Time())->setDateTime($baseDate->year, $baseDate->month, $baseDate->day, 0, 0, 0);

            $filePath = $this->generateFeed($dateTimeStart, $dateTimeEnd);

            if (!empty($filePath)) {
                $this->out('gzip started');

                $gzipFilePath = $this->createGzipFile($filePath);
                if (!empty($gzipFilePath)) {

                    $this->out('Upload started');

                    $uploadFileName = 'top_sold_items_' . ($baseDate->addDay())->i18nFormat('yyyyMMdd') . '.csv.gz';

                    $headers = [
                        'API-AUTH-TOKEN' => Configure::read('EisFeedApi.token'),
                        'API-UPLOAD-FEED-CODE' => Configure::read('EisFeedApi.feeds.topSoldItems.feedCode'),
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
     * @throws Exception
     * @throws MissingModelException
     */
    public function generateFeed(Time $dateFrom, Time $dateTo)
    {
        $this->loadModel('EbayCheckout.EbayCheckoutSessionItems');

        $filename = TMP . Configure::read('EisFeedApi.feeds.topSoldItems.fileName');
        $this->openUploadFile($filename, 'w')
            ->writeFileHeader($this->getFileHeader());

        $limit = 100;
        $page = 1;

        do {
            $query = $this->EbayCheckoutSessionItems->find()
                ->contain(['EbayCheckoutSessions']);
            $topSoldItems = $query->select([
                'ebay_item_id' => $query->func()->substring_index(['ebay_item_id' => 'identifier', "|", 2]),
                'quantity' => $query->func()->sum('quantity')
            ])
                ->where([
                    'EbayCheckoutSessions.purchase_order_timestamp >=' => $dateFrom->timestamp,
                    'EbayCheckoutSessions.purchase_order_timestamp <=' => $dateTo->timestamp,
                    'EbaycheckoutSessions.purchase_order_id IS NOT' => null
                ])
                ->group($query->func()->substring_index(['ebay_item_id' => 'identifier', "|", 2]))
                ->orderDesc('quantity')
                ->limit($limit)
                ->page($page++);

            foreach ($topSoldItems as $topSoldItem) {
                $line = [
                    str_replace('v1|', '', $topSoldItem->ebay_item_id),
                    $topSoldItem->quantity,
                ];
                $this->writeFileLine($line);
            }
        } while (count($topSoldItems->toArray()) == $limit);

        $this->closeUploadFile();

        return $filename;
    }

    /**
     * @param $filePath
     * @param string $mode
     * @return $this
     * @throws Exception
     */
    protected function openUploadFile($filePath, $mode = 'w')
    {
        $this->handle = $this->CsvHandler->openHandle($filePath, $mode);
        return $this;
    }

    /**
     * @throws Exception
     */
    protected function closeUploadFile()
    {
        return $this->CsvHandler->closeHandle($this->handle);
    }

    /**
     * @param array $fileHeader
     * @return int
     */
    protected function writeFileHeader(array $fileHeader)
    {
        return $this->CsvHandler->writeCsvLine($fileHeader, $this->handle, count($fileHeader), $this->delimiter);
    }

    /**
     * @param array $fileLine
     * @return int
     */
    protected function writeFileLine(array $fileLine)
    {
        return $this->CsvHandler->writeCsvLine($fileLine, $this->handle, count($fileLine), $this->delimiter);
    }

    /**
     * @return array
     */
    protected function getFileHeader()
    {
        return [
            __('ProductID'),
            __('Count'),
        ];
    }
}
