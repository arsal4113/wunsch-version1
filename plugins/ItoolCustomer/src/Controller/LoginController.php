<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 31.08.18
 * Time: 10:51
 */

namespace ItoolCustomer\Controller;

use App\Application;
use Cake\Event\Event;
use ItoolCustomer\Controller\Component\EmailComponent;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Controller\Component\LoginComponent;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * Class LoginController
 * @package ItoolCustomer\Controller
 * @property CustomersTable $Customers
 * @property EmailComponent $Email
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 */
class LoginController extends AppController
{
    /**
     * @param Event $event
     * @return void|null
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        //$this->set('orangeMessage', false);
        $this->set('feederHomepage', $this->loadModel('Feeder.FeederHomepages')->get(1));
    }

    /**
     *
     */
    public function navigation ()
    {
        $this->viewBuilder()->setLayout('ajax');
        $customer = $this->Auth->user();
        $this->set('customer', $customer);
    }

    /**
     * @param null $redirect
     * @return \Cake\Http\Response|void|null
     */
    public function login($redirect = null)
    {
        if (!empty($this->Auth->user('id'))) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        if ($this->request->is('post')) {
            $post = $this->request->getData(); // to let use another redirect if needed..
            $redirectUrl = (isset($post['redirect-url']) && !empty($post['redirect-url']))
                         ? $post['redirect-url']
                         : $this->Auth->redirectUrl();

            $user = $this->Auth->identify();
            if ($user) {
                $this->loadModel('ItoolCustomer.Customers');
                $customer = $this->Customers->find()
                    ->where([
                        'Customers.id' => $user['id'],
                        'Customers.is_deleted' => false
                    ])
                    ->contain([
                        'CoreLanguages'
                    ])
                    ->first();
                if (!empty($customer)) {
                    /** @var $customer Customer */
                    if ($customer->is_active) {
                        $this->loadModel('ItoolCustomer.CustomerWishlistItems');
                        $wishlistItemsCount = $this->CustomerWishlistItems->find('all')->where(['customer_id' => $customer->id])->count();
                        $customer->wishlist_items_count = $wishlistItemsCount;
                        $this->Auth->setUser($customer);
                        $event = new Event('ItoolCustomer.Controller.Customers.CustomerLoggedIn', $this, [
                            'customer' => $customer
                        ]);
                        $this->getEventManager()->dispatch($event);

                        if ($this->request->is('ajax')) {
                            $this->set('response', [
                                'success' => true,
                                'user_id' => $customer->id,
                                'user_name' => $customer->first_name,
                                'wishlistItemCount' => $wishlistItemsCount,
                                'redirectAfterLogin' => $redirectUrl
                            ]);
                            $this->set('_serialize', ['response']);
                            $this->viewBuilder()->setClassName('Json');
                            return;
                        }

                        if (isset($post['checkout'])) {
                            $this->loadModel('ItoolCustomer.CustomerAddresses');
                            /** @var CustomerAddress $customerAddress */
                            $customerAddress = $this->CustomerAddresses->find()
                                ->where([
                                    'customer_id' => $customer->id
                                ])->contain('CoreCountries')
                                ->cache(Application::USER_CACHE_KEY_CUSTOMER_ADDRESS . $this->getRequest()->getSession()->id())
                                ->first();
                            $shippingAddress = [];
                            $shippingAddressProvided = false;
                            if ($customerAddress) {
                                $shippingAddress['address_line_1'] = $customerAddress->street_line_1;
                                $shippingAddress['address_line_2'] = $customerAddress->street_line_2;
                                $shippingAddress['postal_code'] = $customerAddress->postal_code;
                                $shippingAddress['city'] = $customerAddress->city;
                                $shippingAddress['country'] = strtoupper($customerAddress->core_country->iso_code);
                                $shippingAddress['state_or_province'] = $customerAddress->state;
                                $shippingAddress['phone_number'] = $customerAddress->phone_number;
                                $shippingAddress['recipient'] = $customerAddress->first_name .  ' ' . $customerAddress->last_name;
                                $shippingAddress['email'] = $customer->email;
                                $shippingAddress['email_confirm'] = $customer->email;
                                $shippingAddress['first_name'] = $customerAddress->first_name;
                                $shippingAddress['last_name'] = $customerAddress->last_name;
                                $shippingAddressProvided = !empty($shippingAddress['first_name'])
                                    && !empty($shippingAddress['last_name'])
                                    && !empty($shippingAddress['address_line_1'])
                                    && !empty($shippingAddress['postal_code'])
                                    && !empty($shippingAddress['city'])
                                    && !empty($shippingAddress['state_or_province'])
                                    && !empty($shippingAddress['email']);
                            }
                            $response = [
                                'success' => true,
                                'userName' => $customer->first_name,
                                'shippingAddressProvided' => $shippingAddressProvided,
                                'shippingAddress' => $shippingAddress
                            ];
                            return $this->response->withType("application/json")->withStringBody(json_encode($response));
                        }

                        $this->request->getSession()->write('Pandata.just_logged', $customer->id); // because of WD-1242

                        return $this->redirect($redirectUrl);
                    } else {
                        $this->request->getSession()->write('ItoolCustomer.registered_email', $customer->email);

                        if ($this->request->is('ajax')) {
                            $this->set('response', ['success' => false, 'message' => __('Invalid username or password, try again'), 'email' => $customer->email]);
                            $this->set('_serialize', ['response']);
                            $this->viewBuilder()->setClassName('Json');
                            return;
                        }

                        if (isset($post['react'])) {
                            $response = [
                                'success' => false,
                                'message' => 'Invalid username or password, try again'
                            ];
                            return $this->response->withType("application/json")->withStringBody(json_encode($response));
                        }

                        return $this->redirect(['controller' => 'Registration', 'action' => 'resend', 'plugin' => 'ItoolCustomer']);
                    }
                }
            } else {
                if ($this->request->is('ajax')) {
                    $this->set('response', ['success' => false, 'message' => __('Invalid username or password, try again')]);
                    $this->set('_serialize', ['response']);
                    $this->viewBuilder()->setClassName('Json');
                    return;
                }

                if (isset($post['checkout'])) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid username or password, try again'
                    ];
                    return $this->response->withType("application/json")->withStringBody(json_encode($response));
                }

                $this->Flash->error(__('Invalid username or password, try again'), ['key' => 'login_messages']);
                $this->redirect($this->referer());
            }
        }

        $this->set('redirect', isset($redirect) ? '/feeder/interests': null);
    }

    /**
     *
     */
    public function logout()
    {
        if ($this->Auth->logout()) {
            $this->Flash->success(__d('itool_customer', ''), [
                'key' => 'logout-message'
            ]);
        }
        $this->redirect('/');
    }

    public function success()
    {

    }

    public function failure()
    {

    }

    public function resetPassword()
    {

    }

    /**
     * @throws \Exception
     */
    public function resetPasswordSubmitted()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }

        $email = false;
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            if (!empty($data['email'])) {
                $email = $data['email'];
                $this->loadModel('ItoolCustomer.Customers');
                /** @var Customer $customer */
                $customer = $this->Customers->find('all')->where(['email' => $email])->first();
                if ($customer) {
                    $token = $this->Customers->generateResetToken($customer);
                    if ($token) {
                        $this->loadComponent('ItoolCustomer.Email');
                        $this->Email->send($email, __d('itool_customer', 'Reset password'), 'ItoolCustomer.reset_password',
                            ['token' => $token, 'firstName' => $customer->first_name]);
                        if ($this->request->is('ajax')) {
                            $this->set('response', ['success' => true, 'email' => $email]);
                            $this->set('_serialize', ['response']);
                            $this->viewBuilder()->setClassName('Json');
                            return;
                        }
                    }
                }
                if ($this->request->is('ajax')) {
                    $this->set('response', ['success' => false, 'message' => __('Sorry, the email you entered was not found.')]);
                    $this->set('_serialize', ['response']);
                    $this->viewBuilder()->setClassName('Json');
                    return;
                }
            }
        }

        if (!$email) {

            if ($this->request->is('ajax')) {
                $this->set('response', ['success' => false, 'message' => __('Please enter a valid email address.')]);
                $this->set('_serialize', ['response']);
                $this->viewBuilder()->setClassName('Json');
                return;
            }

            $this->redirect(['action' => 'resetPassword']);
        }
        $this->set('email', $email);
    }

    /**
     * @param $token
     * @return \Cake\Http\Response|null
     */
    public function resetPasswordChange($token)
    {
        $this->loadModel('ItoolCustomer.Customers');
        if ($token && $this->request->is(['post', 'put'])) {
            $customer = $this->Customers->find('all')->where(['reset_token' => $token, 'reset_timeout >' => time()])->first();
            if ($customer) {
                $customer = $this->Customers->patchEntity($customer, $this->request->getData(),
                    ['validate' => 'resetPassword']);
                $customer->reset_timeout = null;
                $customer->reset_token = null;
                if ($this->Customers->save($customer)) {
                    $this->Flash->success(__d('itool_customer', ''), [
                        'key' => 'reset-password-message'
                    ]);
                    $this->redirect('/');
                }

            } else {
                $this->Flash->error(__d('itool_customer', "There's no customer with such a mail address!"));
                return $this->redirect([
                    'controller' => 'Login',
                    'action' => 'login',
                    'plugin' => 'ItoolCustomer'
                ]);
            }
        } else {
            $customer = $this->Customers->newEntity();
        }
        $this->set('customer', $customer);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function changePassword()
    {
        $customer = $this->Auth->user();
        if (!$customer && !$customer->id ?? false) {
            return $this->redirect($this->Auth->getConfig('loginAction'));
        }

        if ($this->request->is(['post', 'put'])) {
            $this->loadModel('ItoolCustomer.Customers');
            $customer = $this->Customers->patchEntity($customer, $this->request->getData(),
                ['validate' => 'changePassword']);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__d('itool_customer', 'Password changed'));
                return $this->redirect([
                    'controller' => 'Account',
                    'action' => 'edit',
                    'plugin' => 'ItoolCustomer'
                ]);
            } else {
                $this->Flash->error(__('Password could not be changed'));
            }
        }
        $this->set('customer', $customer);
    }
}
