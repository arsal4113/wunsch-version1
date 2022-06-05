<?php

namespace Feeder\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Feeder\Controller\AppController;
use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederInterests Controller
 *
 * @property \Feeder\Model\Table\FeederInterestsTable $FeederInterests
 * @property CoreConfigurationsTable $CoreConfigurations
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederInterest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederInterestsController extends AppController
{
    protected $images = [
        'image' => 'feeder_interests' . DS . 'image' . DS
    ];

    const CONFIG_GROUP = 'FeederInterests';
    const META_TITLE_CONFIG_PATH = 'interests/metaTitle';
    const META_DESCRIPTION_CONFIG_PATH = 'interests/metaDescription';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $feederInterests = $this->paginate($this->FeederInterests);

        $this->loadModel('CoreConfigurations');
        $coreSellerId = $this->Auth->user('core_seller_id');
        $metaTitle = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::META_TITLE_CONFIG_PATH, '');
        $metaDescription = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::META_DESCRIPTION_CONFIG_PATH, '');
        $this->set('metaTitle', $metaTitle);
        $this->set('metaDescription', $metaDescription);
        $this->set(compact('feederInterests'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder interest id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederInterest = $this->FeederInterests->get($id, [
            'contain' => ['CustomerGenders']
        ]);

        $this->set('feederInterest', $feederInterest);
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederInterest = $this->FeederInterests->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!$data['image-removed']) {
                try {
                    if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                        $this->loadComponent('Feeder.GoogleCloudUploader');
                        $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                    } else {
                        $this->loadComponent('Feeder.ImageUploader');
                        $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                    }
                } catch (\Exception $exp) {
                    $this->Flash->error(__('The feeder interest image could not be uploaded. Please, try again.'));
                }
            } else {
                $data['image'] = null;
            }
            $feederInterest = $this->FeederInterests->patchEntity($feederInterest, $data);
            if ($this->FeederInterests->save($feederInterest)) {
                $this->Flash->success(__('The feeder interest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder interest could not be saved. Please, try again.'));
        }
        $feederInterestSubcategories = $this->FeederInterests->FeederInterestSubcategories->find('list', ['limit' => 200]);
        $customerGenders = $this->FeederInterests->CustomerGenders->find('list', ['keyField' => 'id', 'valueField' => 'gender']);
        $this->set(compact('feederInterest', 'customerGenders', 'feederInterestSubcategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Interest id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederInterest = $this->FeederInterests->get($id, [
            'contain' => ['FeederInterestSubcategories', 'CustomerGenders']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (!$data['image-removed']) {
                try {
                    if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                        $this->loadComponent('Feeder.GoogleCloudUploader');
                        $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                    } else {
                        $this->loadComponent('Feeder.ImageUploader');
                        $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                    }
                } catch (\Exception $exp) {
                    $this->Flash->error(__('The feeder interest image could not be uploaded. Please, try again.'));
                }
            } else {
                $data['image'] = null;
            }
            $feederInterest = $this->FeederInterests->patchEntity($feederInterest, $data);

            if ($this->FeederInterests->save($feederInterest)) {
                $this->Flash->success(__('The feeder interest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder interest could not be saved. Please, try again.'));
        }
        $feederInterestSubcategories = $this->FeederInterests->FeederInterestSubcategories->find('list', ['limit' => 200]);
        $customerGenders = $this->FeederInterests->CustomerGenders->find('list', ['keyField' => 'id', 'valueField' => 'gender']);
        $this->set(compact('feederInterest', 'feederInterestSubcategories', 'customerGenders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder interest id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederInterest = $this->FeederInterests->get($id);
        if ($this->FeederInterests->delete($feederInterest)) {
            $this->Flash->success(__('The feeder interest has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder interest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
