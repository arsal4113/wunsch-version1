<?php

namespace ItoolCustomer\Controller;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Core\Configure;
use Cake\Event\Event;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use ItoolCustomer\Controller\Component\EmailComponent;
use ItoolCustomer\Model\Entity\Newsletter;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * Class NewsletterController
 * @package ItoolCustomer\Controller
 * @property NewslettersTable $Newsletters
 * @property EmailComponent $Email
 * @property CsvHandlerComponent $CsvHandler
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 */
class NewsletterBackendController extends AppController
{

    public function initialize()
    {
        $this->isFrontend = false;
        parent::initialize();
        $this->loadModel('ItoolCustomer.Newsletters');
        $this->loadComponent('CsvHandler');
        $this->loadComponent('Feeder.GoogleCloudUploader');
    }

    /**
     * @param Event $event
     * @return null
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->setTheme('Inspiria');
    }

    public function export()
    {
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '256M');

        $handle = fopen('php://memory', 'wb');
        $header = [
            __('Mail'),
            __('Subscribed'),
            __('Subscribe Type'),
        ];
        fputcsv($handle, $header, ';');

        $limit = 250;
        $page = 1;
        do {
            $newsletters = $this->Newsletters->find()
                ->select([
                    'email', 'subscribed', 'subscribe_type'
                ])
                ->limit($limit)
                ->page($page++);
            foreach ($newsletters as $newsletter) {
                /** @var Newsletter $newsletter */
                $line = [
                    $newsletter->email,
                    $newsletter->subscribed,
                    $newsletter->subscribe_type,
                ];
                fputcsv($handle, $line, ';');
            }
        } while (count($newsletters->toArray()) == $limit);

        $filename = 'newsletter_customers.csv';
        return $this->getResponse()
            ->withHeader('Content-Type', 'application/csv; charset=UTF-8;')
            ->withHeader('Content-Disposition', 'attachment;filename="' . $filename . '";')
            ->withStringBody(stream_get_contents($handle, -1, 0));
    }
}
