<?php

namespace VisitManager\Shell;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Http\Client;
use Cake\Core\Configure;
use Cake\I18n\Time;
use VisitManager\Model\Table\ProductVisitsTable;
use Cake\Datasource\Exception\MissingModelException;

/**
 * Class UploadVisitsShell
 * @package VisitManager\Shell
 * @property CsvHandlerComponent $CsvHandler
 * @property ProductVisitsTable $ProductVisits
 */
class UploadProductVisitsShell extends AbstractUploadShell
{
    protected $offsetInDays = 1;

    /**
     * @return bool|int|void|null
     * @throws MissingModelException
     */
    public function main()
    {
        if (isset($this->args[0]) && is_numeric($this->args[0])) {
            $this->offsetInDays = $this->args[0];
        }

        $this->out('Upload of Product Visits Shell started');

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

                    $uploadFileName = 'product_visits_' . ($baseDate->addDay())->i18nFormat('yyyyMMdd') . '.csv.gz';

                    $headers = [
                        'API-AUTH-TOKEN' => Configure::read('EisFeedApi.token'),
                        'API-UPLOAD-FEED-CODE' => Configure::read('EisFeedApi.feeds.productVisit.feedCode'),
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
     * @throws MissingModelException
     */
    public function generateFeed(Time $dateFrom, Time $dateTo)
    {
        $this->loadModel('VisitManager.ProductVisits');

        $filename = TMP . Configure::read('EisFeedApi.feeds.productVisit.fileName');#'product_visit_export.csv';
        $this->setDelimiter("\t");

        $this->openUploadFile($filename, 'w')
            ->writeFileHeader($this->getFileHeader());

        $limit = 100;
        $page = 1;

        do {
            $query = $this->ProductVisits->find();
            $productVisits = $query->select([
                'marketplace_product' => $query->func()->substring_index(['marketplace_product' => 'identifier', "|", 2]),
                'hits' => $query->func()->sum('hits')
            ])
                ->where([
                    'ProductVisits.created >=' => $dateFrom,
                    'ProductVisits.created <=' => $dateTo
                ])
                ->group($query->func()->substring_index(['marketplace_product' => 'identifier', "|", 2]))
                ->orderDesc('hits')
                ->limit($limit)
                ->page($page++);

            foreach ($productVisits as $productVisit) {
                $line = [
                    str_replace('v1|', '', $productVisit->marketplace_product),
                    $productVisit->hits,
                    $dateFrom->i18nFormat('yyyy-MM-dd')
                ];
                $this->writeFileLine($line);
            }
        } while (count($productVisits->toArray()) == $limit);

        $this->closeUploadFile();

        return $filename;
    }

    /**
     * @return array
     */
    protected function getFileHeader()
    {
        return [
            __('ProductID'),
            __('Count'),
            __('Date')
        ];
    }
}
