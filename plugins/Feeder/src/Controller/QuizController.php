<?php

namespace Feeder\Controller;

use App\Application;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Feeder\Model\Table\FeederQuizResultsTable;
use Feeder\Model\Table\FeederQuizzesTable;

/**
 * FeederQuiz Controller
 *
 * @property FeederQuizzesTable $FeederQuizzes
 * @property FeederQuizResultsTable $FeederQuizResults
 */
class QuizController extends AppController
{
    /**
     * @throws \Exception
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'index',
        ]);
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'Feeder';
        $this->viewBuilder()->setTheme($theme);
        $this->viewBuilder()->setHelpers(['Feeder.Feeder']);
    }

    /**
     * @param null $id
     */
    public function index($id = null)
    {
        $this->loadModel('Feeder.FeederQuizzes');
        try {
            if (isset($id)) {
                $feederQuiz = $this->FeederQuizzes->find()->where(['id' => $id])->cache('quiz_' . $id, Application::SHORT_TERM_CACHE)->first();
            } else {
                $feederQuiz = $this->FeederQuizzes->find()->orderAsc('id')->cache('first_quiz', Application::SHORT_TERM_CACHE)->first();
            }
        } catch (RecordNotFoundException $e) {
            $feederQuiz = $this->FeederQuizzes->newEntity();
        }

        $feederQuiz['question_config'] = json_decode($feederQuiz['question_config']);
        $resultIds = [];
        foreach ($feederQuiz->question_config as $question) {
            foreach ($question->answers as $answer) {
                if (!in_array($answer->result, $resultIds)) {
                    array_push($resultIds, $answer->result);
                }
            }
        }
        $this->loadModel('Feeder.FeederQuizResults');
        $results = $this->FeederQuizResults->find('all', [
            'conditions' => [
                "FeederQuizResults.id IN" => $resultIds
            ]
        ])->toArray();
        $mappedResults = [];
        foreach ($results as $result) {
            $mappedResults[$result->id] = $result;
        }

        $this->set('results', $mappedResults);
        $this->set('quiz', $feederQuiz);
    }
}
