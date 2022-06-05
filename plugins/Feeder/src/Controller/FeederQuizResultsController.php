<?php
namespace Feeder\Controller;

use Feeder\Controller\AppController;
use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederQuizResults Controller
 *
 * @property \Feeder\Model\Table\FeederQuizResultsTable $FeederQuizResults
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederQuizResult[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederQuizResultsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $feederQuizResults = $this->paginate($this->FeederQuizResults);

        $this->set(compact('feederQuizResults'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Quiz Result id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederQuizResult = $this->FeederQuizResults->get($id, [
            'contain' => []
        ]);

        $this->set('feederQuizResult', $feederQuizResult);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederQuizResult = $this->FeederQuizResults->newEntity();
        if ($this->request->is('post')) {
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), ['image_src' => 'feeder_quiz_results' . DS . 'image' . DS], Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), ['image_src' => 'feeder_quiz_results' . DS . 'image' . DS]);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The feeder quiz result image could not be uploaded. Please, try again.'));
            }
            $feederQuizResult = $this->FeederQuizResults->patchEntity($feederQuizResult, $data);
            if ($this->FeederQuizResults->save($feederQuizResult)) {
                $this->Flash->success(__('The feeder quiz result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder quiz result could not be saved. Please, try again.'));
        }
        $this->set(compact('feederQuizResult'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Quiz Result id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederQuizResult = $this->FeederQuizResults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), ['image_src' => 'feeder_quiz_results' . DS . 'image' . DS], Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), ['image_src' => 'feeder_quiz_results' . DS . 'image' . DS]);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The feeder quiz result image could not be uploaded. Please, try again.'));
            }
            $feederQuizResult = $this->FeederQuizResults->patchEntity($feederQuizResult, $data);
            if ($this->FeederQuizResults->save($feederQuizResult)) {
                $this->Flash->success(__('The feeder quiz result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder quiz result could not be saved. Please, try again.'));
        }
        $this->set(compact('feederQuizResult'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Quiz Result id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederQuizResult = $this->FeederQuizResults->get($id);
        if ($this->FeederQuizResults->delete($feederQuizResult)) {
            $this->Flash->success(__('The feeder quiz result has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder quiz result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
