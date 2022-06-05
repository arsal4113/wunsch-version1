<?php
namespace ItoolCustomer\Model\Table;

use ArrayObject;
use Cake\Database\Schema\TableSchema;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SocialProfiles Model
 *
 * @property \ItoolCustomer\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \ItoolCustomer\Model\Entity\SocialProfile get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\SocialProfile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SocialProfilesTable extends Table
{
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
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
        'provider' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'created' => [
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

        $this->setTable('social_profiles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('Customers', [
            'foreignKey' => 'user_id',
            'className' => 'ItoolCustomer.Customers'
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
            ->requirePresence('access_token', 'create')
            ->notEmpty('access_token');

        $validator
            ->scalar('identifier')
            ->maxLength('identifier', 255)
            ->requirePresence('identifier', 'create')
            ->notEmpty('identifier');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->allowEmpty('username');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->allowEmpty('last_name');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 255)
            ->allowEmpty('full_name');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('birth_date')
            ->maxLength('birth_date', 255)
            ->allowEmpty('birth_date');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->allowEmpty('gender');

        $validator
            ->scalar('picture_url')
            ->maxLength('picture_url', 255)
            ->allowEmpty('picture_url');

        $validator
            ->boolean('email_verified')
            ->requirePresence('email_verified', 'create')
            ->notEmpty('email_verified');

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
        return $rules;
    }

    /**
     * Set custom type of "access_token" column.
     *
     * @param \Cake\Database\Schema\TableSchema $schema The table definition fetched from database.
     *
     * @return \Cake\Database\Schema\TableSchema
     */
    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('access_token', 'socialauth.serialize');

        return $schema;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['picture_url'])) {
            $data['picture_url'] = substr($data['picture_url'], 0, 255);
        }
    }
}
