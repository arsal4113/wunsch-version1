<?php
namespace AclManager\Model\Table;

use AclManager\Model\Entity\Aco;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Behavior\TreeBehavior;

/**
 * Acos Model
 */
class AcosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('acos');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Tree');
        $this->belongsTo('ParentAcos', [
            'className' => 'AclManager.Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAcos', [
            'className' => 'AclManager.Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Aros', [
            'foreignKey' => 'aco_id',
            'targetForeignKey' => 'aro_id',
            'joinTable' => 'aros_acos',
            'className' => 'AclManager.Aros'
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
            ->allowEmpty('id', 'create')
            ->add('parent_id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('parent_id')
            ->allowEmpty('model')
            ->add('foreign_key', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('foreign_key')
            ->allowEmpty('alias')
            ->add('lft', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('lft')
            ->add('rght', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('rght');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAcos'));
        return $rules;
    }
}
