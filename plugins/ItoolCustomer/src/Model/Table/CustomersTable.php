<?php

namespace ItoolCustomer\Model\Table;

use App\Model\Table\CoreLanguagesTable;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Security;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;
use Feeder\Model\Table\FeederInterestSubcategoriesTable;

/**
 * Customers Model
 *
 * @property \Cake\ORM\Association\BelongsTo|CoreLanguagesTable $CoreLanguages
 * @property \Cake\ORM\Association\HasMany|EbayCheckoutSessionsTable $EbayCheckoutSessions
 * @property \Cake\ORM\Association\HasMany|CustomerAddressesTable $CustomerAddresses
 * @property \Cake\ORM\Association\HasMany|SocialProfilesTable $SocialProfiles
 * @property \Cake\ORM\Association\BelongsToMany|FeederInterestSubcategoriesTable $FeederInterestSubcategories
 * @property \ItoolCustomer\Model\Table\SocialProfilesTable|\Cake\ORM\Association\HasOne $Newsletter
 * @property \Cake\ORM\Association\HasOne|NewslettersTable $Newsletters
 *
 * @method \ItoolCustomer\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
{
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value',
        ],
        'first_name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'last_name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'email' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'modified' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('customers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');
        $this->addBehavior('SoftDelete');

        $this->belongsTo('CoreLanguages', [
            'foreignKey' => 'core_language_id',
            'joinType' => 'LEFT',
            'className' => 'CoreLanguages'
        ]);
        $this->hasMany('EbayCheckoutSessions', [
            'foreignKey' => 'customer_id',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
        ]);
        $this->hasMany('CustomerAddresses', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.CustomerAddresses'
        ]);
        $this->hasMany('SocialProfiles', [
            'foreignKey' => 'user_id',
            'className' => 'ItoolCustomer.SocialProfiles',
        ]);
        $this->hasMany('CustomerWishlistItems', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.CustomerWishlistItems',
        ]);
        $this->hasOne('Newsletter', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.Newsletters'
        ]);
        $this->hasOne('Newsletters', [
            'foreignKey' => 'customer_id',
            'className' => 'ItoolCustomer.Newsletters'
        ]);
        $this->belongsToMany('FeederInterestSubcategories', [
            'foreignKey' => 'customer_id',
            'targetForeignKey' => 'feeder_interest_subcategory_id',
            'joinTable' => 'customers_feeder_interest_subcategories',
            'className' => 'Feeder.FeederInterestSubcategories'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 200, __('Your username is too long.'))
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 200, 'Your username is too long.')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->minLength('password', 6, __('Your password needs to consist of at least 6 characters.'))
            ->maxLength('password', 200)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->scalar('password_repeat')
            ->sameAs('password_repeat', 'password', __('Your entered passwords do not match.'))
            ->requirePresence('password_repeat', 'create');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->boolean('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        return $validator;
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    public function validationChangePassword(Validator $validator)
    {

        $validator
            ->add('old_password', 'custom', [
                'rule' => function ($value, $context) {
                    $customer = $this->get($context['data']['id']);
                    if ($customer) {
                        if ((new DefaultPasswordHasher())->check($value, $customer->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message' => __('The old password does not match the current password!'),
            ])
            ->notEmptyString('old_password')
            ->requirePresence('old_password');

        $validator = $this->validationResetPassword($validator);

        return $validator;
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    public function validationResetPassword(Validator $validator)
    {
        $validator
            ->add('password', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => __('The password have to be at least 6 characters!'),
                ]
            ])
            ->add('password', [
                'match' => [
                    'rule' => ['compareWith', 'password_repeat'],
                    'message' => __('The passwords does not match!'),
                ]
            ])
            ->notEmptyString('password')
            ->requirePresence('password');

        $validator
            ->add('password_repeat', [
                'length' => [
                    'rule' => ['minLength', 6],
                    'message' => __('The password have to be at least 6 characters!'),
                ]
            ])
            ->add('password_repeat', [
                'match' => [
                    'rule' => ['compareWith', 'password'],
                    'message' => __('The passwords does not match!'),
                ]
            ])
            ->notEmptyString('password_repeat')
            ->requirePresence('password_repeat');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], __('The entered email is being used already.')));
        $rules->add($rules->existsIn(['core_language_id'], 'CoreLanguages'));

        return $rules;
    }

    /**
     * @param $customer
     * @return string
     */
    public function generateResetToken($customer)
    {
        $token = $this->generateToken();
        $customer->reset_token = $token;
        $customer->reset_timeout = time() + 600;
        $this->save($customer);
        return $token;
    }

    /**
     * @param $customer
     * @return string
     */
    public function generateActivateToken($customer)
    {
        $token = $this->generateToken();
        $customer->activate_token = $token;
        $this->save($customer);
        return $token;
    }

    /**
     * @return string
     */
    public function generateToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(300));
    }

    /**
     * @param \Cake\Datasource\EntityInterface $profile
     * @return array|\Cake\Datasource\EntityInterface|\ItoolCustomer\Model\Entity\Customer|null
     */
    public function getUser(\Cake\Datasource\EntityInterface $profile)
    {

        if ($profile->provider == 'instagram') {

            #$user = TableRegistry::getTableLocator()->get('ADmad/SocialAuth.SocialProfiles')->find()
            #    ->where(['email' => $profile->email]);
            $profile->email = $profile->identifier . '@im.com';
        }

        // Make sure here that all the required fields are actually present
        if (empty($profile->email)) {
            throw new \RuntimeException('Could not find email in social profile.');
        }

        // Check if user with same email exists. This avoids creating multiple
        // user accounts for different social identities of same user. You should
        // probably skip this check if your system doesn't enforce unique email
        // per user.
        $user = $this->find()
            ->where(['email' => $profile->email])
            ->first();

        if ($user) {
            return $user;
        }

        // Create new user account
        $user = $this->newEntity(['email' => $profile->email]);
        if (!empty($profile->first_name) && !empty($profile->last_name)) {
            $user->last_name = $profile->last_name;
            $user->first_name = $profile->first_name;
        } elseif (preg_match('/.+ .+/', $profile->full_name)) {
            $parts = explode(" ", $profile->full_name);
            $user->last_name = array_pop($parts);
            $user->first_name = implode(" ", $parts);
        } elseif (preg_match('/.+ .+/', $profile->name)) {
            $parts = explode(" ", $profile->name);
            $user->last_name = array_pop($parts);
            $user->first_name = implode(" ", $parts);
        } else {
            $user->last_name = '';
            $user->first_name = '';
        }

        $user->password_repeat = $user->password = bin2hex(Security::randomBytes(16));
        $user->is_active = 1;
        $user->is_deleted = 0;
        $user->core_language_id = 1;
        $this->save($user);

        if (!$user) {
            throw new \RuntimeException('Unable to save new user');
        }

        return $user;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        if (isset($entity->id) && is_numeric($entity->id) && isset($entity->email) && !empty($entity->email)) {
            $newsletter = $this->Newsletters->find()->where(['email' => $entity->email])->first();
            if ($newsletter && $newsletter->customer_id != $entity->id) {
                $newsletter->customer_id = $entity->id;
                $this->Newsletters->save($newsletter);
            }
        }
        return true;
    }
}
