<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 31.08.18
 * Time: 10:51
 */

namespace ItoolCustomer\Controller;

use Cake\Core\Configure;
use Cake\Event\Event;
use ItoolCustomer\Controller\Component\NewsletterHelperComponent;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Controller\Component\EmailComponent;
use ItoolCustomer\Model\Table\CustomersTable;
use App\Controller\Component\CsvHandlerComponent;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;

/**
 * Class RegistrationController
 * @property EmailComponent $Email
 * @property NewsletterHelperComponent $NewsletterHelper
 * @property CustomersTable $Customers
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 * @property CsvHandlerComponent $CsvHandler
 * @package ItoolCustomer\Controller
 */
class RegistrationController extends AppController
{

    /**
     * @param Event $event
     * @return void|null
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
    }

    /**
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function create()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $referer = $this->referer();
        $cartPos = strpos($referer, '/cart');
        if ($cartPos !== false) {
            $this->set('redirectUrl', substr($referer, 0, $cartPos) . '/session');
        }

        $reCaptchaSiteKey = Configure::read('google_recatpcha_settings.site_key', false);
        $reCaptchaSecret = Configure::read('google_recatpcha_settings.secret_key', false);
        $this->loadModel('ItoolCustomer.Customers');
        $customer = $this->Customers->newEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (isset($data['redirect-url'])) {
                $this->set('redirectUrl', $data['redirect-url']);
            }
            /** @var Customer $customer */
            $customer = $this->Customers->patchEntity($customer, $data);
            $captchaStatus = false;
            if ($reCaptchaSiteKey) {
                $reCaptchaResponse = isset($data['g-recaptcha-response']) ? $data['g-recaptcha-response'] : '';
                $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $reCaptchaSecret . "&response=" . $reCaptchaResponse;
                $response = json_decode(@file_get_contents($url));
                $captchaStatus = (isset($response->success)) ? $response->success : false;
            }
            if (!$captchaStatus && $reCaptchaSiteKey && $reCaptchaSecret) {
                if ($this->request->is('ajax')) {
                    $this->set('response', ['success' => false, 'message' => __('The entered Captcha is incorrect.')]);
                    $this->set('_serialize', ['response']);
                    $this->viewBuilder()->setClassName('Json');
                    return;
                }
                $this->Flash->error(__('The entered Captcha is incorrect.'));
                return $this->redirect(['action' => 'create']);
            } else {
                $customer->core_language_id = Configure::read('dealsguru.customer_core_language_id', 1);
                $customer->is_active = 0;
                $customer->is_deleted = 0;
                $customer->activate_token = $this->Customers->generateToken();
                if ($this->Customers->save($customer)) {
                    unset($customer->password_repeat);
                    $this->request->getSession()->write('ItoolCustomer.registered_email', $customer->email);
                    $this->sendRegistrationMail($customer);
                    if ($data['register_wishlist_item_id'] ?? false) {
                        $this->loadComponent('ItoolCustomer.Wishlist');
                        $this->Wishlist->addItemToWishlist($customer, $data['register_wishlist_item_id']);
                    }
                    if ($this->request->is('ajax')) {
                        $this->set('response', ['success' => true, 'email' => $customer->email]);
                        $this->set('_serialize', ['response']);
                        $this->viewBuilder()->setClassName('Json');
                        return;
                    }

                    if (isset($data['redirect-url'])) {
                        return $this->redirect($data['redirect-url']);
                    } else {
                        return $this->redirect('/');
                    }
                } else {
                    if ($this->request->is('ajax')) {
                        $this->set('response', ['success' => false, 'message' => __('The entered email is being used already.')]);
                        $this->set('_serialize', ['response']);
                        $this->viewBuilder()->setClassName('Json');
                        return;
                    }
                }

                $this->Flash->error(__('Invalid username or password, try again'));

                if (isset($data['redirect-url'])) {
                    return $this->redirect($data['redirect-url']);
                } else {
                    return $this->redirect('/');
                }
            }
            $this->set('customer', $customer);
        }

        $this->set('reCaptchaSiteKey', $reCaptchaSiteKey);
        $this->set('customer', $customer);
    }

    /**
     * @param $token
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function activate($token)
    {
        $this->loadModel('ItoolCustomer.Customers');

        $email = $this->request->getQuery('mail');

        if ($token && $this->request->is(['get'])) {
            /** @var Customer $customer */
            $customer = $this->Customers->find('all')->where([
                'activate_token' => $token,
                'email' => $email,
                'is_active' => 0
            ])->first();

            if ($customer) {
                $customer->is_active = 1;
                $customer->activate_token = null;
                $this->request->getSession()->delete('ItoolCustomer.registered_email');
                if ($this->Customers->save($customer)) {
                    $this->Auth->setUser($customer);
                    $this->Flash->success(__d('itool_customer', 'Account activated.'));

                    $this->loadComponent('ItoolCustomer.Email');
                    $this->Email->send($email, __d('itool_customer', __('Welcome to the catch universe!')), 'ItoolCustomer.registered_notification', []);

                    $this->loadComponent('ItoolCustomer.NewsletterHelper');
                    $this->NewsletterHelper->subscribeToNewsletter($email);

                    return $this->redirect(['controller' => 'Account', 'action' => 'edit', 'plugin' => 'ItoolCustomer', '?' => ['track' => 'CompleteRegistration']]);
                }
            }
        }

        return $this->redirect('/');
    }

    /**
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function resend()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $email = $this->request->getSession()->read('ItoolCustomer.registered_email');
        if ($email) {
            $this->loadModel('ItoolCustomer.Customers');
            $customer = $this->Customers->find('all')->where([
                'email' => $email,
                'is_active' => 0
            ])->first();
            if ($customer) {
                $this->sendRegistrationMail($customer);
            }

            if ($this->request->is('ajax')) {
                $this->set('response', ['success' => true, 'email' => $email]);
                $this->set('_serialize', ['response']);
                $this->viewBuilder()->setClassName('Json');
                return;
            }
        }

        if ($this->request->is('ajax')) {
            $this->set('response', ['success' => false]);
            $this->set('_serialize', ['response']);
            $this->viewBuilder()->setClassName('Json');
            return;
        }

        return $this->redirect($this->referer());
    }

    /**
     * @param $customer
     * @throws \Exception
     */
    protected function sendRegistrationMail($customer)
    {
        $this->loadComponent('ItoolCustomer.Email');

        $this->Email->send($customer->email, __d('itool_customer', __('Welcome to the catch universe!')), 'ItoolCustomer.register', [
            'token' => $customer->activate_token,
            'firstName' => $customer->first_name,
            'email' => $customer->email
        ]);

        $this->Flash->popupSuccess(__d('itool_customer', 'Welcome to the Catch universe!'), [
            'key' => 'popup-success',
            'params' => [
                'name' => $customer->first_name,
                'email' => $customer->email,
                'is_active' => $customer->is_active
            ]
        ]);
    }
}
