<?php

namespace Feeder\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Cake\Core\Configure;

/**
 * FeederWorlds Controller
 *
 * @property \Feeder\Model\Table\FeederWorldsTable $FeederWorlds
 * @property CoreConfigurationsTable $CoreConfigurations
 *
 * @method \Feeder\Model\Entity\FeederWorld[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederWorldsController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    protected $images = [
        'image' => 'feeder_worlds' . DS . 'image' . DS
    ];

    const CONFIG_GROUP = 'FeederWorlds';
    const HEADER_IMAGE_CONFIG_PATH = 'header/image';
    const HEADLINE_CONFIG_PATH = 'worlds/headline';
    const META_TITLE_CONFIG_PATH = 'worlds/metaTitle';
    const META_DESCRIPTION_CONFIG_PATH = 'worlds/metaDescription';

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->FeederWorlds->getSchema()->columns();
        $this->loadModel('CoreConfigurations');
        $coreSellerId = $this->Auth->user('core_seller_id');
        $headerImage = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::HEADER_IMAGE_CONFIG_PATH, null);
        $headline = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::HEADLINE_CONFIG_PATH, '');
        $metaTitle = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::META_TITLE_CONFIG_PATH, '');
        $metaDescription = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::META_DESCRIPTION_CONFIG_PATH, '');
        $this->set('headerImage', $headerImage);
        $this->set('headline', $headline);
        $this->set('metaTitle', $metaTitle);
        $this->set('metaDescription', $metaDescription);
        $this->set('feederWorlds', $this->paginate($this->FeederWorlds->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederWorlds']);
    }

    /**
     * upload Header Image
     */
    public function updateWorldsInfo()
    {
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
                $this->Flash->error(__('The feeder world image could not be uploaded. Please, try again.'));
            }
            $this->loadModel('CoreConfigurations');
            if(isset($data['image'])){
                $headerImage = $this->CoreConfigurations->find()
                    ->where([
                        'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                        'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                        'CoreConfigurations.configuration_path' => self::HEADER_IMAGE_CONFIG_PATH
                    ])
                    ->first();
                if (empty($headerImage)) {
                    $headerImage = $this->CoreConfigurations->newEntity();
                    $headerImage->set('core_seller_id', $this->Auth->user('core_seller_id'));
                    $headerImage->set('configuration_group', self::CONFIG_GROUP);
                    $headerImage->set('configuration_path', self::HEADER_IMAGE_CONFIG_PATH);
                }
                $headerImage->set('configuration_value', $data['image'] ?? '');
            }

            $headline = $this->CoreConfigurations->find()
                ->where([
                    'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                    'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                    'CoreConfigurations.configuration_path' => self::HEADLINE_CONFIG_PATH
                ])
                ->first();

            if (empty($headline)) {
                $headline = $this->CoreConfigurations->newEntity();
                $headline->set('core_seller_id', $this->Auth->user('core_seller_id'));
                $headline->set('configuration_group', self::CONFIG_GROUP);
                $headline->set('configuration_path', self::HEADLINE_CONFIG_PATH);
            }
            $headline->set('configuration_value', $data['headline'] ?? '');

            $saved = true;
            if(isset($headerImage)){
                if(!$this->CoreConfigurations->save($headerImage)){
                    $saved = false;
                }
            }
            if ($saved && $this->CoreConfigurations->save($headline)) {
                $this->Flash->success(__('The feeder world has been saved.'));
            } else {
                $this->Flash->error(__('The feeder world could not be saved. Please, try again.'));
            }
        }
        $this->redirect(['action' => 'index']);
    }

    /**
     * update Meta Tags
     */
    public function updateMetaTags()
    {
        if ($this->request->is('post')) {
            $this->loadModel('CoreConfigurations');
            $data = $this->getRequest()->getData();
            if(isset($data['meta_title'])){
                $metaTitle = $this->CoreConfigurations->find()
                    ->where([
                        'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                        'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                        'CoreConfigurations.configuration_path' => self::META_TITLE_CONFIG_PATH
                    ])
                    ->first();
                if (empty($metaTitle)) {
                    $metaTitle = $this->CoreConfigurations->newEntity();
                    $metaTitle->set('core_seller_id', $this->Auth->user('core_seller_id'));
                    $metaTitle->set('configuration_group', self::CONFIG_GROUP);
                    $metaTitle->set('configuration_path', self::META_TITLE_CONFIG_PATH);
                }
                $metaTitle->set('configuration_value', $data['meta_title'] ?? '');
            }

            $metaDescription = $this->CoreConfigurations->find()
                ->where([
                    'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                    'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                    'CoreConfigurations.configuration_path' => self::META_DESCRIPTION_CONFIG_PATH
                ])
                ->first();

            if (empty($metaDescription)) {
                $metaDescription = $this->CoreConfigurations->newEntity();
                $metaDescription->set('core_seller_id', $this->Auth->user('core_seller_id'));
                $metaDescription->set('configuration_group', self::CONFIG_GROUP);
                $metaDescription->set('configuration_path', self::META_DESCRIPTION_CONFIG_PATH);
            }
            $metaDescription->set('configuration_value', $data['meta_description'] ?? '');

            $saved = true;
            if(isset($metaTitle)){
                if(!$this->CoreConfigurations->save($metaTitle)){
                    $saved = false;
                }
            }
            if ($saved && $this->CoreConfigurations->save($metaDescription)) {
                $this->Flash->success(__('The feeder world has been saved.'));
            } else {
                $this->Flash->error(__('The feeder world could not be saved. Please, try again.'));
            }
        }
        $this->redirect(['action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $id Feeder World id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederWorld = $this->FeederWorlds->get($id, [
            'contain' => []
        ]);
        $this->set('feederWorld', $feederWorld);
        $this->set('_serialize', ['feederWorld']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederWorld = $this->FeederWorlds->newEntity();
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
                $this->Flash->error(__('The feeder world image could not be uploaded. Please, try again.'));
            }
            $feederWorld = $this->FeederWorlds->patchEntity($feederWorld, $data);
            if ($this->FeederWorlds->save($feederWorld)) {
                $this->Flash->success(__('The feeder world has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder world could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederWorld'));
        $this->set('_serialize', ['feederWorld']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder World id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederWorld = $this->FeederWorlds->get($id, [
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
                $this->Flash->error(__('The feeder world image could not be uploaded. Please, try again.'));
            }
            $feederWorld = $this->FeederWorlds->patchEntity($feederWorld, $data);
            if ($this->FeederWorlds->save($feederWorld)) {
                $this->Flash->success(__('The feeder world has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder world could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederWorld'));
        $this->set('_serialize', ['feederWorld']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder World id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederWorld = $this->FeederWorlds->get($id);
        if ($this->FeederWorlds->delete($feederWorld)) {
            $this->Flash->success(__('The feeder world has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder world could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
