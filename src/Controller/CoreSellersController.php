<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Cake\Event\Event;

/**
 * CoreSellers Controller
 *
 * @property \App\Model\Table\CoreSellersTable $CoreSellers
 * @property \App\Model\Table\CoreUsersTable $CoreUsers
 * @property \App\Model\Table\CoreConfigurationsTable $CoreConfigurations
 * @property \App\Model\Table\CoreCountriesTable $CoreCountries
 * @property \App\Model\Table\CoreErrorsTable $CoreErrors
 * @property \App\Controller\Component\LoginComponent $Login
 * @property \Search\Controller\Component\PrgComponent $Prg
 * @property \App\Controller\Component\SearchBoxDataComponent $SearchBoxData
 */
class CoreSellersController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    /**
     * Initialize method
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['register', 'registration_successful', 'activateAccount']);
        $this->loadComponent('Csrf');
        $this->loadComponent('Login');
        if(php_sapi_name() != 'cli') {
            $this->loadComponent('CakeCaptcha.Captcha', [
                'captchaConfig' => 'RegisterPageCaptcha'
            ]);
        }
        $this->loadModel('CoreErrors');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadComponent('SearchBoxData');
        $this->paginate = [
            'contain' => ['CoreLanguages', 'CoreCountries', 'CoreSellerTypes'],
            'order' => ['CoreSellers.id' => 'ASC']
        ];
        $this->Prg->commonProcess();
        $isActive = [
            '1' => __('Active'),
            '0' => __('Inactive')
        ];
        $languages = $this->CoreSellers->CoreLanguages->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
        $countries = $this->CoreSellers->CoreCountries->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
        $textColumns = [
            'id' => 'Id',
            'code' => 'Code',
            'name' => 'Name'
        ];
        $selectColumns = [
            'core_language_id' => [
                $languages,
                'Language'
            ],
            'core_country_id' => [
                $countries,
                'Country'
            ],
            'is_active' => [
                $isActive,
                'Is Active'
            ]
        ];
        $availableColumns = $this->SearchBoxData->setColumnArray($textColumns, $selectColumns);
        $this->set('coreSellers', $this->paginate($this->CoreSellers->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', $availableColumns);
        $this->set('_serialize', ['coreSellers']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Seller id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreSeller = $this->CoreSellers->get($id, [
            'contain' => [
                'CoreLanguages',
                'CoreCountries',
                'CoreUserRoles',
                'CoreUsers',
                'CoreSellerTypes'
            ]
        ]);
        $this->set('coreSeller', $coreSeller);
        $this->set('_serialize', ['coreSeller']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreSeller = $this->CoreSellers->newEntity();
        if ($this->request->is('post')) {
            $coreSeller = $this->CoreSellers->patchEntity($coreSeller, $this->request->getData());
            if ($this->CoreSellers->save($coreSeller)) {
                $this->Flash->success(__('Seller has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Seller could not be saved. Please, try again.'));
            }
        }
        $coreLanguages = $this->CoreSellers->CoreLanguages->find('list', ['limit' => 200]);
        $coreCountries = $this->CoreSellers->CoreCountries->find('list', ['limit' => 200]);
        $coreSellerTypes = $this->CoreSellers->CoreSellerTypes->find('list', ['limit' => 200]);
        $this->set(compact('coreSeller', 'coreLanguages', 'coreCountries', 'coreSellerTypes'));
        $this->set('_serialize', ['coreSeller']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Seller id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreSeller = $this->CoreSellers->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreSeller = $this->CoreSellers->patchEntity($coreSeller, $this->request->getData());
            if ($this->CoreSellers->save($coreSeller)) {
                $this->Flash->success(__('Seller has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Seller could not be saved. Please, try again.'));
            }
        }
        $coreLanguages = $this->CoreSellers->CoreLanguages->find('list', ['limit' => 200]);
        $coreCountries = $this->CoreSellers->CoreCountries->find('list', ['limit' => 200]);
        $coreSellerTypes = $this->CoreSellers->CoreSellerTypes->find('list', ['limit' => 200]);
        $this->set(compact('coreSeller', 'coreLanguages', 'coreCountries', 'coreSellerTypes'));
        $this->set('_serialize', ['coreSeller']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Seller id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreSeller = $this->CoreSellers->get($id);
        if ($this->CoreSellers->delete($coreSeller)) {
            $this->Flash->success(__('Seller has been deleted.'));
        } else {
            $this->Flash->error(__('Seller could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Register method for Ebay Template users
     * First step for eBay Template customers
     *
     * Check if seller and user exist in database
     * Create seller and user for the passed data
     *
     * @param string $coreSellerTypeCode    Seller type can be either free, basic or premium.
     * @return \Cake\Network\Response
     * @throws \Exception
     */
    public function register($coreSellerTypeCode = 'free')
    {
        $useRegisterCaptcha = Configure::check('useRegisterCaptcha') ? Configure::read('useRegisterCaptcha') : false;
        $userIsChinese = strtolower(substr($this->request->env('HTTP_ACCEPT_LANGUAGE'), 0, 2)) == 'zh';
        $reCaptchaSiteKey = '';
        if ($useRegisterCaptcha) {
            $reCaptchaSiteKey = Configure::check('google_recatpcha_settings.site_key') ? Configure::read('google_recatpcha_settings.site_key') : '';
        }

        if ($this->request->is(['post', 'put'])) {
            $postData = $this->request->getData();
            if ($useRegisterCaptcha) {
                if ($userIsChinese) {
                    $captchaStatus = captcha_validate($this->request->data['botdetect_captcha']);
                    unset($this->request->data['botdetect_captcha']);
                } else {
                    $reCaptchaSecret = Configure::check('google_recatpcha_settings.secret_key') ? Configure::read('google_recatpcha_settings.secret_key') : '';
                    $reCaptchaResponse = isset($postData['g-recaptcha-response']) ? $postData['g-recaptcha-response'] : '';
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $reCaptchaSecret . "&response=" . $reCaptchaResponse;
                    $response = json_decode(@file_get_contents($url));
                    $captchaStatus = (isset($response->success)) ? $response->success : false;
                }

                if (!$captchaStatus) {
                    $this->Flash->error(__("Please check the captcha box."));
                    return $this->redirect(['action' => 'register']);
                }
            }

            $coreSeller = $this->CoreSellers->newEntity($postData, ['validate' => 'register']);
            if ($coreSeller->errors()) {
                if (isset($coreSeller->errors()['email'])) {
                    $this->Flash->mail_exists(__('An account with this email already exists.'));
                } else $this->Flash->error(__('Registration could not be completed.'));

            } else {
                $this->loadModel('CoreConfigurations');

                $defaultSellerTypeCode = $this->CoreConfigurations->loadSellerConfiguration(null, 'Core/Register/default_core_seller_type');
                $coreSellerType = $this->CoreSellers->CoreSellerTypes->find()->where(['code' => $defaultSellerTypeCode])->first();

                $firstName = $postData['first_name'];
                $lastName = $postData['last_name'];
                $language = $this->CoreSellers->CoreLanguages->find()->where(['iso_code' => $this->selectedLanguageCode])->first();
                $country = $this->CoreSellers->CoreCountries->find()->first();
                $coreSeller->code = Inflector::camelize($firstName . ' ' . $lastName);
                $coreSeller->name = $firstName . ' ' . $lastName;
                $coreSeller->core_language_id = !empty($language) ? $language->id : 0;
                $coreSeller->core_country_id = !empty($country) ? $country->id : 0;
                $coreSeller->core_seller_type_id = !empty($coreSellerType) ? $coreSellerType->id : 0;
                $coreUserRoleId = !empty($coreSellerType) ? $coreSellerType->core_user_role_id : 0;
                $coreSeller->is_active = false;

                do {
                    $activationToken = Text::uuid() . Text::uuid();
                    $checkToken = $this->CoreSellers->find()
                        ->where(['activation_token' => $activationToken])
                        ->first();
                } while (!empty($checkToken));

                $coreSeller->activation_token = $activationToken;

                // Change redirect URL based on selected core seller type code
                $redirectUrl = !empty($coreSellerType) ? $coreSellerType->redirect_url . "/" . $coreSellerTypeCode : '';

                $userData = [
                    'email' => $coreSeller->email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => $coreSeller->password,
                    'is_active' => 0,
                    'redirect_url' => $redirectUrl,
                    'core_user_roles' => [
                        '_ids' => [$coreUserRoleId]
                    ]
                ];

                $this->CoreUsers->CoreUserRoles->removeBehavior('Ocl');
                $coreUser = $this->CoreUsers->newEntity($userData, ['validate' => 'register']);
                $coreSeller->core_users = [$coreUser];

                try {
                    $event = new Event('Controller.CoreSellers.beforeRegistration', $this, [
                        'coreSeller' => $coreSeller
                    ]);
                    $this->eventManager()->dispatch($event);

                    if(empty($event->getResult()['coreSeller'])) {
                        $coreSeller = $event->getResult()['coreSeller'];
                    }

                    $this->CoreSellers->saveOrFail($coreSeller);

                    $event = new Event('Controller.CoreSellers.afterRegistration', $this, [
                        'coreSeller' => $coreSeller
                    ]);
                    $this->eventManager()->dispatch($event);
                    $this->Flash->success(__('We have sent you an email with an account activation link. Please check Your emails.'), ['clear' => true]);
                    return $this->render('registration_successful', 'registration_successful');
                } catch (\Exception $exp) {
                    $this->Flash->error(__('Registration could not be completed.'));
                    $this->CoreErrors->logError(
                        $coreSeller->id ?? null,
                        'CoreSellerController',
                        'register',
                        $exp->getMessage()
                    );
                }
            }
        } else {
            $coreSeller = $this->CoreSellers->newEntity();
        }

        $currentLanguageCode = $this->selectedLanguageCode;
        $this->set(compact('coreSeller', 'currentLanguageCode', 'useRegisterCaptcha', 'reCaptchaSiteKey', 'userIsChinese'));
        $this->render('register', 'register');
    }

    /**
     * Takes the ISO code of an existing in "core_countries" table country
     * Gives it's ID back
     *
     * @deprecated
     * @param $iso
     * @return mixed
     * @throws Exception
     */
    public function getCountryId($iso)
    {
        $country = $this->CoreCountries->find('all')->where(['iso_code' => $iso])->first();
        if (!$country) {
            throw new Exception(__("Given country ISO code ' {0} ' wasn't found", $iso));
        }
        return $country->id;
    }

    /**
     * Activate account method
     *
     * @param null $activationToken
     * @param null $email
     * @return \Cake\Network\Response|null
     */
    public function activateAccount($activationToken = null, $email = null)
    {
        if (!empty($activationToken)) {
            $coreSeller = $this->CoreSellers->find()
                ->where([
                    'activation_token' => $activationToken,
                    'is_active' => 0
                ])
                ->first();

            if (!empty($coreSeller)) {
                $user = $this->CoreUsers->find()
                    ->where([
                        'CoreUsers.core_seller_id' => $coreSeller->id,
                        'CoreUsers.email' => $email
                    ])
                    ->first();
                if(!empty($user)) {
                    $coreSeller->is_active = 1;
                    $user->is_active = 1;
                    $coreSeller->activation_token = '';

                    if ($this->CoreSellers->save($coreSeller) && $this->CoreUsers->save($user)) {
                        $this->Flash->success(__("Your account was successfully activated! Please login."));
                        return $this->redirect(['controller' => 'CoreUsers', 'action' => 'login', $email]);
                    }
                }
            } elseif (!empty($email)) {
                $user = $this->CoreUsers->find()
                    ->where([
                        'CoreUsers.email' => $email
                    ])
                    ->first();
                if (!empty($user) && $user->is_active) {
                    $this->Flash->success(__("Your account is already active, please login."));
                    return $this->redirect(['controller' => 'CoreUsers', 'action' => 'login', $email]);
                }
            }
        }
        $this->render(__FUNCTION__, 'activation_failed');
    }
}
