<?php
namespace Feeder\Controller;

use Cake\Core\Configure;
use Feeder\Controller\AppController;

/**
 * FeederInfluencerMiniCategories Controller
 *
 * @property \Feeder\Model\Table\FeederInfluencerMiniCategoriesTable $FeederInfluencerMiniCategories
 *
 * @method \Feeder\Model\Entity\FeederInfluencerMiniCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederInfluencerMiniCategoriesController extends AppController
{
    protected $images = [
        'image' => 'feeder_influencers_mini_categories' . DS . 'image' . DS,
    ];
    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeederInfluencers']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->FeederInfluencerMiniCategories->getSchema()->columns();

        $this->set('feederInfluencerMiniCategories', $this->paginate($this->FeederInfluencerMiniCategories->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederInfluencerMiniCategories']);
    }


    /**
     * View method
     *
     * @param string|null $id Feeder Influencer Mini Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->get($id, [
            'contain' => ['FeederInfluencers']
        ]);
        $this->set('feederInfluencerMiniCategory', $feederInfluencerMiniCategory);
        $this->set('_serialize', ['feederInfluencerMiniCategory']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            foreach ($data as $key => $value) {
                if (isset($value['tmp_name']) && empty($value['tmp_name']) && strpos($data['removed_media'] ?? '', $key) !== false) {
                    $feederInfluencerMiniCategory->{$key} = null;
                }
            }

            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The video could not be uploaded. Please, try again.'));
            }

            $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->patchEntity($feederInfluencerMiniCategory, $data);
            if ($this->FeederInfluencerMiniCategories->save($feederInfluencerMiniCategory)) {
                $this->Flash->success(__('The feeder influencer mini category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder influencer mini category could not be saved. Please, try again.'));
            }
        }
        $feederInfluencers = $this->FeederInfluencerMiniCategories->FeederInfluencers->find('list', ['limit' => 200]);
        $this->set(compact('feederInfluencerMiniCategory', 'feederInfluencers'));
        $this->set('_serialize', ['feederInfluencerMiniCategory']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Feeder Influencer Mini Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            foreach ($data as $key => $value) {
                if (isset($value['tmp_name']) && empty($value['tmp_name']) && strpos($data['removed_media'] ?? '', $key) !== false) {
                    $feederInfluencerMiniCategory->{$key} = null;
                }
            }

            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The video could not be uploaded. Please, try again.'));
            }

            $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->patchEntity($feederInfluencerMiniCategory, $data);
            if ($this->FeederInfluencerMiniCategories->save($feederInfluencerMiniCategory)) {
                $this->Flash->success(__('The feeder influencer mini category has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder influencer mini category could not be saved. Please, try again.'));
            }
        }
        $feederInfluencers = $this->FeederInfluencerMiniCategories->FeederInfluencers->find('list', ['limit' => 200]);
        $this->set(compact('feederInfluencerMiniCategory', 'feederInfluencers'));
        $this->set('_serialize', ['feederInfluencerMiniCategory']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Feeder Influencer Mini Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederInfluencerMiniCategory = $this->FeederInfluencerMiniCategories->get($id);
        if ($this->FeederInfluencerMiniCategories->delete($feederInfluencerMiniCategory)) {
            $this->Flash->success(__('The feeder influencer mini category has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder influencer mini category could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
