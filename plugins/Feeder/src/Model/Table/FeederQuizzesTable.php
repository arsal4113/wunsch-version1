<?php
namespace Feeder\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeederQuizzes Model
 *
 * @method \Feeder\Model\Entity\FeederQuiz get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederQuiz findOrCreate($search, callable $callback = null, $options = [])
 */
class FeederQuizzesTable extends Table
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

        $this->setTable('feeder_quizzes');
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
            ->scalar('url_path')
            ->maxLength('url_path', 1024)
            ->allowEmptyString('url_path');

        $validator
            ->scalar('meta_description')
            ->maxLength('meta_description', 1020)
            ->allowEmptyString('meta_description');

        $validator
            ->scalar('title_tag')
            ->maxLength('title_tag', 200)
            ->allowEmptyString('title_tag');

        $validator
            ->scalar('description')
            ->maxLength('description', 1020)
            ->allowEmptyString('description');

        $validator
            ->scalar('question_config')
            ->maxLength('question_config', 16777215)
            ->allowEmptyString('question_config');

        return $validator;
    }

    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederQuizzes.afterSave', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }

    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $event = new Event('Model.FeederQuizzes.afterDelete', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }
}
