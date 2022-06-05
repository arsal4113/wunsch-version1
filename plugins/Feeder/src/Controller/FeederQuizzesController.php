<?php
namespace Feeder\Controller;

use Feeder\Controller\AppController;
use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederQuizzes Controller
 *
 * @property \Feeder\Model\Table\FeederQuizzesTable $FeederQuizzes
 * @property \Feeder\Model\Table\FeederQuizResultsTable $FeederQuizResults
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederQuiz[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederQuizzesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $feederQuizzes = $this->paginate($this->FeederQuizzes);

        $this->set(compact('feederQuizzes'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Quiz id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederQuiz = $this->FeederQuizzes->get($id, [
            'contain' => []
        ]);

        $this->set('feederQuiz', $feederQuiz);
    }

    public function uploadImage()
    {
        if ($this->request->is('post')) {
            $this->viewBuilder()->setLayout('ajax');
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), ['image' => 'feeder_quizzes' . DS . 'image' . DS], Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), ['image' => 'feeder_quizzes' . DS . 'image' . DS]);

                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }
            $this->set('imageUrl', $data['image']);
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederQuiz = $this->FeederQuizzes->newEntity();
        if ($this->request->is('post')) {
            $feederQuiz = $this->FeederQuizzes->patchEntity($feederQuiz, $this->request->getData());
            if ($this->FeederQuizzes->save($feederQuiz)) {
                $this->Flash->success(__('The feeder quiz has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder quiz could not be saved. Please, try again.'));
        }
        $this->loadModel('Feeder.FeederQuizResults');
        $feederQuizResults = $this->FeederQuizResults->find('list', ['limit' => 200]);
        $this->set(compact('feederQuiz', 'feederQuizResults'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Quiz id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederQuiz = $this->FeederQuizzes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederQuiz = $this->FeederQuizzes->patchEntity($feederQuiz, $this->request->getData());
            if ($this->FeederQuizzes->save($feederQuiz)) {
                $this->Flash->success(__('The feeder quiz has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder quiz could not be saved. Please, try again.'));
        }
        $this->loadModel('Feeder.FeederQuizResults');
        $feederQuizResults = $this->FeederQuizResults->find('list', ['limit' => 200]);
        $this->set(compact('feederQuiz', 'feederQuizResults'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Quiz id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederQuiz = $this->FeederQuizzes->get($id);
        if ($this->FeederQuizzes->delete($feederQuiz)) {
            $this->Flash->success(__('The feeder quiz has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder quiz could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
