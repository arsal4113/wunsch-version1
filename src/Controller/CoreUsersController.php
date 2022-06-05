<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\CoreUser;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Utility\Text;

/**
 * CoreUsers Controller
 *
 * @property \App\Model\Table\CoreUsersTable $CoreUsers
 * @property \Search\Controller\Component\PrgComponent $Prg
 * @property \App\Controller\Component\SearchBoxDataComponent $SearchBoxData
 */
class CoreUsersController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    /**
     * @see \App\Controller\AppController::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CoreLanguages');
        $this->loadModel('CoreErrors');
        $this->loadComponent('SearchBoxData');
        $this->loadComponent('Login');
        $this->Auth->allow(['forgotPassword', 'resetPassword', 'login', 'activateUser']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoreSellers'],
            'order' => ['CoreUsers.id' => 'ASC']
        ];
        $this->Prg->commonProcess();
        $isActive = [
            '1' => 'Active',
            '0' => 'Inactive'
        ];
        $sellers = $this->CoreUsers->CoreSellers->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $textColumns = [
            'id' => 'Id',
            'email' => 'E-mail'
        ];
        $selectColumns = [
            'core_seller_id' => [
                $sellers,
                'Seller'
            ],
            'is_active' => [
                $isActive,
                'Is Active'
            ]
        ];
        $availableColumns = $this->SearchBoxData->setColumnArray($textColumns, $selectColumns);
        $this->set('coreUsers', $this->paginate($this->CoreUsers->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', $availableColumns);
        $this->set('_serialize', ['coreUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Core User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreUser = $this->CoreUsers->get($id, [
            'contain' => ['CoreSellers', 'CoreUserRoles']
        ]);
        $this->set('coreUser', $coreUser);
        $this->set('_serialize', ['coreUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreUser = $this->CoreUsers->newEntity();
        if ($this->request->is('post')) {
            $coreUser = $this->CoreUsers->patchEntity($coreUser, $this->request->data);
            if ($this->CoreUsers->save($coreUser)) {
                $this->Flash->success('User has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('User could not be saved. Please, try again.');
            }
        }
        $coreSellers = $this->CoreUsers->CoreSellers->find('list', ['limit' => 200]);
        $coreUserRoles = $this->CoreUsers->CoreUserRoles->find('list', ['keyField' => 'id', 'valueField' => 'code', 'limit' => 200]);
        $this->set(compact('coreUser', 'coreSellers', 'coreUserRoles'));
        $this->set('_serialize', ['coreUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreUser = $this->CoreUsers->get($id, [
            'contain' => ['CoreUserRoles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (!empty($this->request->data['cpassword'])) {
                $this->request->data['password'] = $this->request->data['cpassword'];
            }

            $passwordError = false;
            if (!empty($this->request->data['password'])) {
                if ($this->request->data['password'] != $this->request->data['rpassword']) {
                    $passwordError = true;
                }
            }

            if (!$passwordError) {
                $coreUser = $this->CoreUsers->patchEntity($coreUser, $this->request->data);
                if ($this->CoreUsers->save($coreUser)) {
                    $this->Flash->success('User has been saved.');
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error('User could not be saved. Please, try again.');
                }
            } else {
                $this->Flash->error(__('Password and password confirmation do not match. Please input your password again.'));
            }
        }

        $coreSellers = $this->CoreUsers->CoreSellers->find('list');
        $coreUserRoles = $this->CoreUsers->CoreUserRoles->find('list', ['keyField' => 'id', 'valueField' => 'code', 'limit' => 200]);
        $this->set(compact('coreUser', 'coreSellers', 'coreUserRoles'));
        $this->set('_serialize', ['coreUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreUser = $this->CoreUsers->get($id);
        if ($this->CoreUsers->delete($coreUser)) {
            $this->Flash->success('User has been deleted.');
        } else {
            $this->Flash->error('User could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param null $email
     * @return \Cake\Network\Response|null
     */
    public function login($email = null)
    {
        if (!empty($this->currentUser)) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $selectedLanguage = $this->selectedLanguageCode;

            $user = $this->Auth->identify();
            if ($user) {
                if (empty($user['is_active'])) {
                    $this->Flash->error(__('Your account is not activated yet, please activate your account.'));
                    return $this->redirect(['controller' => false, 'action' => 'activateUser', $user['email']]);
                }
                $user = $this->Login->processUserData($user);
                $this->Auth->setUser($user);
                $language = isset($this->request->data['language']) ? $this->request->data['language'] : '';
                $this->setLanguage($language);

                $event = new Event('Controller.CoreUsers.UserLoggedIn', $this, [
                    'user' => $user
                ]);
                $this->eventManager()->dispatch($event);

                $userRedirectUrl = $user['redirect_url'];

                $this->setLanguage($selectedLanguage);
                return $this->redirect($this->Auth->redirectUrl($userRedirectUrl));
            }

            $this->request->url = '/login';
            $this->Flash->error(__('Invalid username or password, please try again.'));
        }

        $coreLanguages = $this->CoreLanguages->find('list', ['keyField' => 'iso_code', 'valueField' => 'name'])->toArray();
        $coreLanguageCodes = $countries = $this->CoreLanguages->find('list', [
            'keyField' => 'id',
            'valueField' => 'iso_code'
        ])->toArray();

        $currentLanguageCode = $this->selectedLanguageCode;
        $this->set(compact('coreLanguages', 'currentLanguageCode', 'coreLanguageCodes', 'email'));

        $this->render('login', 'login');
    }

    /**
     * Set different seller id for super users
     *
     * @return \Cake\Network\Response|null
     */
    public function setSuperSellerId()
    {
        if ($this->request->is('post') && $this->Auth->user('is_super_user') == CoreUser::SUPER_USER) {
            $this->request->session()->write('Auth.User.super_user_core_seller_id', $this->request->data['super_seller_id']);
        }
        return $this->redirect($this->referer());
    }

    /**
     * Logout method
     *
     * @return \Cake\Network\Response
     */
    public function logout()
    {
        $selectedLanguage = $this->selectedLanguageCode;
        $this->request->session()->destroy();
        $this->setLanguage($selectedLanguage);
        return $this->redirect($this->Auth->logout());
    }


    /**
     * @param null $token
     * @return \Cake\Network\Response|null
     */
    public function resetPassword($token = null)
    {
        if (!empty($token)) {
            $conditions = ['reset_password_token' => $token];
            $user = $this->CoreUsers->find()
                ->where($conditions)
                ->first();
            if (empty($user) || empty($user->token_created_at) || !$this->validToken($user->token_created_at)) {
                $this->request->session()->write('login_error', 1);
                $this->request->session()->write('login_message', __('The password reset request has either expired or is invalid.'));
                $this->redirect(['controller' => 'CoreUsers', 'action' => 'login']);
            }
        } else {
            $this->Flash->error(__('You didn\'t specify any email or reset password token.'));
            $this->request->session()->write('login_error', 1);
            $this->request->session()->write('login_message', __('You didn\'t specify any email or reset password token.'));
            $this->redirect(['controller' => 'CoreUsers', 'action' => 'login']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (empty($this->request->data['new_password'])) {
                $this->Flash->error(__('Please enter new password.'));
            }

            if ($this->request->data['new_password'] != $this->request->data['confirm_password']) {
                $this->Flash->error(__('Password mismatch. Please make sure that new password & password confirmation are identical.'));
            }

            if (!empty($this->request->data['new_password']) && $this->request->data['new_password'] == $this->request->data['confirm_password']) {
                $user->password = $this->request->data['new_password'];
                $user->reset_password_token = null;
                $user->token_created_at = null;
                if ($this->CoreUsers->save($user)) {

                    $event = new Event('Controller.CoreUsers.resetPassword', $this, [
                        'user' => $user]);
                    $this->eventManager()->dispatch($event);

                    $this->request->session()->write('login_error', 0);
                    $this->Flash->success(__('Your password has been successfully changed.'));
                    $this->request->session()->write('message', __('Your password has been successfully changed.'));
                    return $this->redirect(['controller' => 'CoreUsers', 'action' => 'login']);
                }
            }
        }

        $this->render('reset_password', 'register');
    }

    /**
     * Forgot password method
     *
     */
    public function forgotPassword()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->data['email']) {
                $user = $this->CoreUsers->findByEmail($this->request->data['email'])
                    ->first();
                if (empty($user)) {
                    $this->Flash->error(__('Sorry, the email you entered ({0}) was not found.', $this->request->data['email']));
                } else {
                    if (!empty($user->is_active)) {
                        $user = $this->generatePasswordToken($user);
                        if ($this->CoreUsers->save($user)) {
                            try {
                                $event = new Event('Controller.CoreUsers.forgotPassword', $this, [
                                    'user' => $user, 'resetPasswordLink' => Router::url('/', true) . 'core_users' . DS . 'resetPassword' . DS . $user->reset_password_token]);
                                $this->eventManager()->dispatch($event);

                                $this->Flash->success(__('Password reset instructions have been sent to your email address. You have 24 hours to complete the request.'));
                            } catch (\Exception $exp) {
                                $this->CoreErrors->logError(
                                    $user->core_seller_id ?? null,
                                    'CoreUserController',
                                    'forgotPassword',
                                    $exp->getMessage()
                                );
                            }
                        }
                    } else {
                        $this->Flash->error(__('Your account is not activated yet, please activate your account.'));
                        return $this->redirect(['controller' => false, 'action' => 'activateUser', $user->email]);
                    }
                }
            } else {
                $this->Flash->error(__('Please enter your email address.'));
            }
        }
        $coreLanguages = $this->CoreLanguages->find('list', ['keyField' => 'iso_code', 'valueField' => 'name'])->toArray();
        $coreLanguageCodes = $countries = $this->CoreLanguages->find('list', [
            'keyField' => 'id',
            'valueField' => 'iso_code'
        ])->toArray();
        $currentLanguageCode = $this->selectedLanguageCode;
        $this->set(compact('coreLanguages', 'currentLanguageCode', 'coreLanguageCodes'));
        $this->render('forgot_password', 'login');
    }

    public function activate($coreUserId = null)
    {
        $this->CoreUsers->removeBehavior('Ocl');
        $this->CoreUsers->CoreSellers->removeBehavior('Ocl');

        $user = $this->CoreUsers->find()
            ->where(['CoreUsers.id' => $coreUserId])
            ->contain(['CoreSellers'])
            ->first();

        if (!empty($user)) {
            if (empty($user->is_deleted)) {
                $user->is_active = 1;
                $coreSeller = $user->core_seller;
                $coreSeller->is_active = 1;
                $user->core_seller = $coreSeller;
                if ($this->CoreUsers->save($user)) {
                    $this->Flash->success(__('User "{0}" has been successful activated.', [$user->email]), ['clear' => true]);
                } else {
                    $this->Flash->success(__('User "{0}" could\'t be activated.', [$user->email]), ['clear' => true]);
                }
            }
        }
        return $this->redirect($this->referer());
    }

    public function activateUser($email = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            if (isset($this->request->data['user_email']) && !empty($this->request->data['user_email'])) {
                $email = trim($this->request->data['user_email']);
                $user = $this->CoreUsers->find()
                    ->where(['email' => $email])
                    ->contain(['CoreSellers'])
                    ->first();
                if (empty($user)) {
                    $this->Flash->error(__('Sorry, the email you entered ({0}) was not found.', $email));
                } else {
                    if (isset($user->core_seller->is_active) && empty($user->core_seller->is_active)) {
                        do {
                            $activationToken = Text::uuid() . Text::uuid();
                            $checkToken = $this->CoreUsers->CoreSellers->find()
                                ->where(['activation_token' => $activationToken])
                                ->first();
                        } while (!empty($checkToken));

                        $coreSeller = $user->core_seller;
                        $coreSeller->activation_token = $activationToken;
                        if ($this->CoreUsers->CoreSellers->save($coreSeller)) {
                            $event = new Event('Controller.CoreSellers.resentConfirmationMail', $this, [
                                'coreSeller' => $coreSeller
                            ]);
                            $this->eventManager()->dispatch($event);

                            $this->Flash->success(__('We have sent you an email with an account activation link. Please check Your emails.'), ['clear' => true]);
                        } else {
                            $this->Flash->error('User could not be activated. Please, try again.');
                        }
                    } else {
                        $this->Flash->error(__('Your account is already active, please login.'));
                        return $this->redirect(['action' => 'login']);
                    }
                }
            } else {
                $this->Flash->error(__('Please enter your email address.'));
            }
        }
        $coreLanguages = $this->CoreLanguages->find('list', ['keyField' => 'iso_code', 'valueField' => 'name'])->toArray();
        $coreLanguageCodes = $countries = $this->CoreLanguages->find('list', [
            'keyField' => 'id',
            'valueField' => 'iso_code'
        ])->toArray();

        $currentLanguageCode = $this->selectedLanguageCode;
        $this->set(compact('coreLanguages', 'currentLanguageCode', 'coreLanguageCodes', 'email'));
        $this->render('activate_user', 'login');
    }

    public function loginAs($userId)
    {
        $user = $this->CoreUsers->find()
            ->where(['CoreUsers.id' => $userId])
            ->first();

        $selectedLanguage = $this->selectedLanguageCode;
        $user = $this->Login->processUserData($user->toArray());
        $this->Auth->setUser($user);
        $language = isset($this->request->data['language']) ? $this->request->data['language'] : '';
        $this->setLanguage($language);

        $event = new Event('Controller.CoreUsers.UserLoggedIn', $this, [
            'user' => $user
        ]);
        $this->eventManager()->dispatch($event);

        $userRedirectUrl = $user['redirect_url'];

        $this->setLanguage($selectedLanguage);
        return $this->redirect($this->Auth->redirectUrl($userRedirectUrl));
    }

    /**
     * Generate a unique hash / token.
     * @param Object User
     * @return Object User
     */
    private function generatePasswordToken($user)
    {
        if (empty($user)) {
            return null;
        }

        $hash = $this->createRandomToken();
        $user->reset_password_token = $hash;
        $user->token_created_at = date('Y-m-d H:i:s');

        return $user;
    }

    /**
     * Create random token
     *
     * @return string
     */
    private function createRandomToken()
    {
        do {
            // Generate a random string 100 chars in length.
            $token = "";
            for ($i = 0; $i < 100; $i++) {
                $d = rand(1, 100000) % 2;
                $d ? $token .= chr(rand(33, 79)) : $token .= chr(rand(80, 126));
            }
            (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;

            // Generate hash of random string
            $hash = Security::hash($token, 'sha256', true);;
            for ($i = 0; $i < 20; $i++) {
                $hash = Security::hash($hash, 'sha256', true);
            }

            $conditions = ['reset_password_token' => $hash];

            $existingToken = $this->CoreUsers->find()->where($conditions)->first();
        } while (!empty($existingToken));

        return $hash;
    }

    /**
     * Validate token created at time.
     *
     * @param String $tokenCreatedAt
     * @return Boolean
     */
    private function validToken($tokenCreatedAt)
    {
        $expired = strtotime($tokenCreatedAt) + 86400;
        $time = strtotime("now");
        if ($time < $expired) {
            return true;
        }
        return false;
    }
}
