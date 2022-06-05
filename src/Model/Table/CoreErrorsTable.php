<?php
namespace App\Model\Table;

use App\Model\Entity\CoreError;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreErrors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 */
class CoreErrorsTable extends Table
{

    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'core_seller_id' => [
            'type' => 'value'
        ],
        'type' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'sub_code' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'message' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'rlogid' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'ebay_checkout_session_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'foreign_key' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'foreign_model' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
        'created' => [
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

        $this->table('core_errors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->requirePresence('sub_code', 'create')
            ->notEmpty('sub_code');

        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->scalar('rlogid')
            ->maxLength('rlogid', 256)
            ->allowEmptyString('rlogid');

        $validator
            ->scalar('ebay_checkout_session_id')
            ->maxLength('ebay_checkout_session_id', 256)
            ->allowEmptyString('ebay_checkout_session_id');

        $validator
            ->allowEmpty('foreign_key');

        $validator
            ->allowEmpty('foreign_model');

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
        $rules->add($rules->existsIn(['core_seller_id'], 'CoreSellers'));
        return $rules;
    }

    /**
     * Log error
     *
     * @param null|integer $coreSellerId
     * @param $code
     * @param $subCode
     * @param $message
     * @param null $foreignKey
     * @param null $foreignModel
     * @param string $type
     * @param null|string $rlogid
     * @param null|string $ebayCheckoutSessionId
     * @return bool|\Cake\Datasource\EntityInterface|mixed
     */
    public function logError(
        $coreSellerId = null,
        $code,
        $subCode,
        $message,
        $foreignKey = null,
        $foreignModel = null,
        $type = 'Error',
        $rlogid = null,
        $ebayCheckoutSessionId = null
    )
    {
        $errorEntity = $this->newEntity();
        $errorEntity->set('core_seller_id', $coreSellerId);
        $errorEntity->set('code', $code);
        $errorEntity->set('sub_code', $subCode);
        $errorEntity->set('message', $message);
        $errorEntity->set('type', $type);
        $errorEntity->set('foreign_key', $foreignKey);
        $errorEntity->set('foreign_model', $foreignModel);
        $errorEntity->set('rlogid', $rlogid);
        $errorEntity->set('ebay_checkout_session_id', $ebayCheckoutSessionId);

        return $this->save($errorEntity);
    }
}
