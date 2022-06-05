<?php
namespace Feeder\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederQuizResults Model
 *
 * @method \Feeder\Model\Entity\FeederQuizResult get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuizResult findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederQuizResultsTable extends Table
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

        $this->setTable('feeder_quiz_results');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 510)
            ->allowEmptyString('name');

        $validator
            ->scalar('quiz_description')
            ->maxLength('quiz_description', 1020)
            ->allowEmptyString('quiz_description');

        $validator
            ->scalar('headline')
            ->maxLength('headline', 510)
            ->allowEmptyString('headline');

        $validator
            ->scalar('explanation')
            ->maxLength('explanation', 1020)
            ->allowEmptyString('explanation');

        $validator
            ->scalar('button_text')
            ->maxLength('button_text', 510)
            ->allowEmptyString('button_text');

        $validator
            ->scalar('button_link')
            ->maxLength('button_link', 510)
            ->allowEmptyString('button_link');

        $validator
            ->scalar('image_src')
            ->maxLength('image_src', 510)
            ->allowEmptyFile('image_src');

        return $validator;
    }
}
