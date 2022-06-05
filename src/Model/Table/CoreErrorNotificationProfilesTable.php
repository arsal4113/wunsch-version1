<?php
namespace App\Model\Table;

use App\Model\Entity\CoreErrorNotificationProfile;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CoreErrorNotificationProfiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $CoreSellers
 */
class CoreErrorNotificationProfilesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('core_error_notification_profiles');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'LEFT'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('code');

        $validator
            ->allowEmpty('sub_code');

        $validator
            ->requirePresence('email_to', 'create')
            ->notEmpty('email_to');

        $validator
            ->allowEmpty('email_cc');

        $validator
            ->allowEmpty('email_bcc');

        $validator
            ->requirePresence('email_subject', 'create')
            ->notEmpty('email_subject');

        $validator
            ->add('is_active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->add('is_running', 'valid', ['rule' => 'boolean'])
            ->requirePresence('is_running', 'create')
            ->notEmpty('is_running');

        $validator
            ->add('last_run', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('last_run');

        $validator
            ->add('run_interval', 'valid', ['rule' => 'numeric'])
            ->requirePresence('run_interval', 'create')
            ->notEmpty('run_interval');

        $validator
            ->add('next_run', 'valid', ['rule' => 'datetime'])
            ->requirePresence('next_run', 'create')
            ->notEmpty('next_run');

        $validator
            ->add('max_execution_time', 'valid', ['rule' => 'numeric'])
            ->requirePresence('max_execution_time', 'create')
            ->notEmpty('max_execution_time');

        $validator
            ->add('last_alive', 'valid', ['rule' => 'datetime'])
            ->requirePresence('last_alive', 'create')
            ->notEmpty('last_alive');

        return $validator;
    }
}
