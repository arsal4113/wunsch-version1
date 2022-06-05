<?php

namespace ItoolCustomer\Controller;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use ItoolCustomer\Controller\Component\EmailComponent;
use ItoolCustomer\Controller\Component\NewsletterHelperComponent;
use ItoolCustomer\Model\Table\NewslettersTable;
/**
 * Class NewsletterController
 * @package ItoolCustomer\Controller
 * @property NewslettersTable $Newsletters
 * @property EmailComponent $Email
 * @property NewsletterHelperComponent $NewsletterHelper
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 * @property CsvHandlerComponent $CsvHandler
 */
class NewsletterController extends AppController
{

    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ItoolCustomer.NewsletterHelper');
        $this->loadModel('ItoolCustomer.Newsletters');
        $this->loadComponent('Feeder.GoogleCloudUploader');
        $this->loadComponent('CsvHandler');
    }

    public function optInConfirmed()
    {
    	// TBD
    }

    /**
     * subscribe
     */
    public function subscribe()
    {
        $response = $this->NewsletterHelper->sendSignUpEmail();

        if (!empty(Configure::read('Sendgrid.apiKey'))) {
            $this->NewsletterHelper->addToSendgridContacts($this->request->getData('email'));
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setClassName('Json');
            $this->viewBuilder()->setLayout('ajax');
            $this->set('response', $response);
            $this->set('_serialize', ['response']);
        } else {
            $data = $this->request->getData();
            $this->autoRender = false;
            if (isset($data['react'])) {
                return $this->response->withType("application/json")->withStringBody(json_encode($response));
            }
        }
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function signUpSuccessful()
    {
        $email = $this->request->getQuery('mail');
        $response = $this->NewsletterHelper->subscribeToNewsletter(false, $email);
        if ($response['success']) {
            return $this->redirect('newsletter/signup');
        } else {
            return $this->redirect('/');
        }
    }

    /**
     * @param $email
     * @return \Cake\Http\Response|null
     */
    public function unsubscribe($email)
    {
        $newsletter = $this->NewsletterHelper->getNewsletterForEmail($email);
        if ($newsletter) {
            $newsletter->subscribed = 0;
            if ($this->Newsletters->save($newsletter)) {
                $this->Flash->success(__d('itool_customer', 'Unsubscribed!'));
            }
        }

        if (!empty(Configure::read('Sendgrid.apiKey'))) {
            $this->NewsletterHelper->deleteFromSendgridContacts($email);
        }

        $this->autoRender = false;
        return $this->redirect('/');
    }

    /**
     * @param $email
     * @param $type
     */
    public function changeSubscription($email, $type)
    {
        $newsletter = $this->NewsletterHelper->getNewsletterForEmail($email);
        $type = strtoupper($type);
        if ($newsletter && in_array($type, NewslettersTable::SUBSCRIPTION_TYPES)) {
            $newsletter->subscribe_type = $type;
            if ($this->Newsletters->save($newsletter)) {
                $this->Flash->success(__d('itool_customer', 'Changed!'));
            }
        }
    }

    /**
     * @param $filename
     */
    public function testTemplate($filename, $type = 'html', $email = 'test.email@test.tst')
    {
    	$this->layout = 'empty';
    	$this->set('email', $email);
    	return $this->render('Email/' . $type . '/' . $filename);
    }
}
