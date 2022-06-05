<?php

namespace EbayCheckout\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EbayCheckouts Model
 *
 * @property \EbayCheckout\Model\Table\CoreSellersTable|\Cake\ORM\Association\BelongsTo $CoreSellers
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessions
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckout get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckout findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutsTable extends Table
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

        $this->setTable('ebay_checkouts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CoreSellers', [
            'foreignKey' => 'core_seller_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.CoreSellers'
        ]);
        $this->hasMany('EbayCheckoutSessions', [
            'foreignKey' => 'ebay_checkout_id',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('title');

        $validator
            ->allowEmpty('x_frame_origins');

        $validator
            ->allowEmpty('logo');

        $validator
            ->allowEmpty('main_color');

        $validator
            ->allowEmpty('second_color');

        $validator
            ->allowEmpty('font');

        $validator
            ->allowEmpty('font_color');

        $validator
            ->allowEmpty('background_image');

        $validator
            ->allowEmpty('background_image_position');

        $validator
            ->allowEmpty('background_color');

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
}
