<?php

namespace Feeder\Controller;

use Cake\Cache\Cache;
use Cake\Datasource\Exception\RecordNotFoundException;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\AppController;
use Cake\Core\Configure;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederHomepageBanners Controller
 *
 * @property \Feeder\Model\Table\FeederHomepageBannersTable $FeederHomepageBanners
 *
 * @method \Feeder\Model\Entity\FeederHomepageBanner[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederHomepageBannersController extends AppController
{
    public $components = ['Search.Prg'];
    protected $images = [
        'banner_image' => 'feeder_homepage_banners' . DS . 'image' . DS,
        'banner_bp_lg' => 'feeder_homepage_banners' . DS . 'image' . DS,
        'banner_bp_md' => 'feeder_homepage_banners' . DS . 'image' . DS,
        'banner_bp_sm' => 'feeder_homepage_banners' . DS . 'image' . DS,
        'banner_bp_xs' => 'feeder_homepage_banners' . DS . 'image' . DS
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
        if ($this->FeederHomepageBanners->hasBehavior('TimeRange')) {
            $this->FeederHomepageBanners->removeBehavior('TimeRange');
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeederHomepages']
        ];

        $feederHomepageBanners = $this->paginate($this->FeederHomepageBanners);

        $this->set(compact('feederHomepageBanners'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Homepage Banner id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederHomepageBanner = $this->FeederHomepageBanners->get($id, [
            'contain' => ['FeederHomepages']
        ]);

        $this->set('feederHomepageBanner', $feederHomepageBanner);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederHomepageBanner = $this->FeederHomepageBanners->newEntity();
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

            $feederHomepageBanner = $this->FeederHomepageBanners->patchEntity($feederHomepageBanner, $data);/*$this->request->getData()*/
            if ($this->FeederHomepageBanners->save($feederHomepageBanner)) {
                $this->Flash->success(__('The feeder homepage banner has been saved.'));
                Cache::clear();
                return $this->redirect(['action' => 'index']);
            }else {
                $this->Flash->error(__('The feeder homepage banner could not be saved. Please, try again.'));
            }
        }
        $feederHomepages = $this->FeederHomepageBanners->FeederHomepages->find('list', ['limit' => 200]);
        $this->set(compact('feederHomepageBanner', 'feederHomepages'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Homepage Banner id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederHomepageBanner = $this->FeederHomepageBanners->get($id, [
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
                $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
            }

            $feederHomepageBanner = $this->FeederHomepageBanners->patchEntity($feederHomepageBanner, $data); /*$this->request->getData()*/
            if ($this->FeederHomepageBanners->save($feederHomepageBanner)) {
                $this->Flash->success(__('The feeder homepage banner has been saved.'));
                Cache::clear();
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder homepage banner could not be saved. Please, try again.'));
        }
        $feederHomepages = $this->FeederHomepageBanners->FeederHomepages->find('list', ['limit' => 200]);
        $this->set(compact('feederHomepageBanner', 'feederHomepages'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Homepage Banner id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederHomepageBanner = $this->FeederHomepageBanners->get($id);
        if ($this->FeederHomepageBanners->delete($feederHomepageBanner)) {
            $this->Flash->success(__('The feeder homepage banner has been deleted.'));
            Cache::clear();
        } else {
            $this->Flash->error(__('The feeder homepage banner could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
