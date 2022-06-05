<?php

namespace Feeder\Controller;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Http\Response;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederHeroItems Controller
 *
 * @property \Feeder\Model\Table\FeederHeroItemsTable $FeederHeroItems
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederHeroItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederHeroItemsController extends AppController
{
    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];
    protected $images = [
        'image' => 'feeder_hero_items' . DS . 'image' . DS,
        'webm' => 'feeder_hero_items' . DS . 'webm' . DS,
        'mp4' => 'feeder_hero_items' . DS . 'mp4' . DS,
    ];

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
        /**
         * Remove TimeRange behavior to enable the disabled categories in backend
         */
        if ($this->FeederHeroItems->hasBehavior('TimeRange')) {
            $this->FeederHeroItems->removeBehavior('TimeRange');
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CustomerGenders'],
            'order' => [
                'FeederHeroItems.id' => 'desc'
            ]
        ];

        $this->Prg->commonProcess();

        $availableColumns = $this->FeederHeroItems->getSchema()->columns();

        $this->set('feederHeroItems', $this->paginate($this->FeederHeroItems->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederHeroItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Hero Item id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederHeroItem = $this->FeederHeroItems->get($id, [
            'contain' => ['FeederCategories.CoreCountries', 'CustomerGenders']
        ]);
        $this->set('feederHeroItem', $feederHeroItem);
        $this->set('_serialize', ['feederHeroItem']);
    }

    /**
     * Add method
     *
     * @return Response Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederHeroItem = $this->FeederHeroItems->newEntity();
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
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }
            $feederHeroItem = $this->FeederHeroItems->patchEntity($feederHeroItem, $data);
            if ($this->FeederHeroItems->save($feederHeroItem)) {
                $this->Flash->success(__('The feeder hero item has been saved.'));
                Cache::clearGroup(Configure::read('dealsguru.cache.browse', 'default'),
                    Configure::read('dealsguru.cache.browse', 'default'));
                return $this->redirect(['action' => 'index']);
            } else {
                debug($feederHeroItem->getErrors());
                $this->Flash->error(__('The feeder hero item could not be saved. Please, try again.'));
            }
        }
        $feederCategories = $this->FeederHeroItems->FeederCategories->find('list', ['limit' => 2000]);
        $customerGenders = $this->FeederHeroItems->CustomerGenders->find('list', ['keyField' => 'id', 'valueField' => 'gender']);
        $this->set(compact('feederHeroItem', 'feederCategories', 'customerGenders'));
        $this->set('_serialize', ['feederHeroItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Hero Item id.
     * @return Response Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederHeroItem = $this->FeederHeroItems->get($id, [
            'contain' => ['FeederCategories', 'CustomerGenders']
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
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }
            $feederHeroItem = $this->FeederHeroItems->patchEntity($feederHeroItem, $data);
            if ($this->FeederHeroItems->save($feederHeroItem)) {
                $this->Flash->success(__('The feeder hero item has been saved.'));
                Cache::clearGroup(Configure::read('dealsguru.cache.browse', 'default'),
                    Configure::read('dealsguru.cache.browse', 'default'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder hero item could not be saved. Please, try again.'));
            }
        }
        $feederCategories = $this->FeederHeroItems->FeederCategories->find('list', ['limit' => 2000]);
        $customerGenders = $this->FeederHeroItems->CustomerGenders->find('list', ['keyField' => 'id', 'valueField' => 'gender']);
        $this->set(compact('feederHeroItem', 'feederCategories', 'customerGenders'));
        $this->set('_serialize', ['feederHeroItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Hero Item id.
     * @return Response Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederHeroItem = $this->FeederHeroItems->get($id);
        if ($this->FeederHeroItems->delete($feederHeroItem)) {
            $this->Flash->success(__('The feeder hero item has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder hero item could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
