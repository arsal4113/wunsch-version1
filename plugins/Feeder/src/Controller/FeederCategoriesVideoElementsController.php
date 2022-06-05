<?php
namespace Feeder\Controller;

use Feeder\Controller\AppController;
use Cake\Core\Configure;

/**
 * FeederCategoriesVideoElements Controller
 *
 * @property \Feeder\Model\Table\FeederCategoriesVideoElementsTable $FeederCategoriesVideoElements
 *
 * @method \Feeder\Model\Entity\FeederCategoriesVideoElement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederCategoriesVideoElementsController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    protected $images = [
        'video_mp4' => 'feeder_categories_video_elements' . DS . 'video' . DS,
        'video_webm' => 'feeder_categories_video_elements' . DS . 'video' . DS,
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->FeederCategoriesVideoElements->getSchema()->columns();

        $this->set('feederCategoriesVideoElements', $this->paginate($this->FeederCategoriesVideoElements->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederCategoriesVideoElements']);
    }


    /**
     * View method
     *
     * @param string|null $id Feeder Categories Video Element id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->get($id, [
            'contain' => []
        ]);
        $this->set('feederCategoriesVideoElement', $feederCategoriesVideoElement);
        $this->set('_serialize', ['feederCategoriesVideoElement']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->newEntity();
        if ($this->request->is('post')) {
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The video could not be uploaded. Please, try again.'));
            }

            $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->patchEntity($feederCategoriesVideoElement, $data);
            if ($this->FeederCategoriesVideoElements->save($feederCategoriesVideoElement)) {
                $this->Flash->success(__('The feeder categories video element has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder categories video element could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederCategoriesVideoElement'));
        $this->set('_serialize', ['feederCategoriesVideoElement']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Feeder Categories Video Element id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The video could not be uploaded. Please, try again.'));
            }

            foreach (explode(',', $data['removed_media']) as $removedMedium) {
                $removedMedium && $data[$removedMedium] = '';
            }
            $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->patchEntity($feederCategoriesVideoElement, $data);
            if ($this->FeederCategoriesVideoElements->save($feederCategoriesVideoElement)) {
                $this->Flash->success(__('The feeder categories video element has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder categories video element could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederCategoriesVideoElement'));
        $this->set('_serialize', ['feederCategoriesVideoElement']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Feeder Categories Video Element id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederCategoriesVideoElement = $this->FeederCategoriesVideoElements->get($id);
        if ($this->FeederCategoriesVideoElements->delete($feederCategoriesVideoElement)) {
            $this->Flash->success(__('The feeder categories video element has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder categories video element could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
