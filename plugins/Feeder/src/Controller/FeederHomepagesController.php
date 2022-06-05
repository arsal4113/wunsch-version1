<?php

namespace Feeder\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Cache\Cache;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Cake\Core\Configure;
use Feeder\Controller\Component\ImageUploaderComponent;
use Feeder\Model\Table\FeederHomepagesTable;

/**
 * FeederHomepages Controller
 *
 * @property FeederHomepagesTable $FeederHomepages
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederHomepage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederHomepagesController extends AppController
{
    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];
    protected $images = [
        'main_logo' => 'feeder_homepages' . DS . 'image' . DS,
        'time_logo' => 'feeder_homepages' . DS . 'image' . DS,
        'big_banner_image' => 'feeder_homepages' . DS . 'image' . DS,
        'first_small_banner_image' => 'feeder_homepages' . DS . 'image' . DS,
        'second_small_banner_image' => 'feeder_homepages' . DS . 'image' . DS,
        'third_small_banner_image' => 'feeder_homepages' . DS . 'image' . DS,
        'fourth_small_banner_image' => 'feeder_homepages' . DS . 'image' . DS,
    ];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeederCategories']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->FeederHomepages->getSchema()->columns();

        $this->set('feederHomepages', $this->paginate($this->FeederHomepages->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederHomepages']);
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Homepage id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederHomepage = $this->FeederHomepages->get($id, [
            'contain' => ['FeederCategories']
        ]);
        $this->set('feederHomepage', $feederHomepage);
        $this->set('_serialize', ['feederHomepage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederHomepage = $this->FeederHomepages->newEntity();
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
            $feederHomepage = $this->FeederHomepages->patchEntity($feederHomepage, $data);
            if ($this->FeederHomepages->save($feederHomepage)) {
                $this->Flash->success(__('The feeder homepage has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder homepage could not be saved. Please, try again.'));
            }
        }
        $feederCategories = $this->FeederHomepages->FeederCategories->find('treeList', ['limit' => 200]);
        $this->set(compact('feederHomepage', 'feederCategories'));
        $this->set('_serialize', ['feederHomepage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Homepage id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederHomepage = $this->FeederHomepages->get($id, [
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
            $feederHomepage = $this->FeederHomepages->patchEntity($feederHomepage, $data);
            if ($this->FeederHomepages->save($feederHomepage)) {
                $this->Flash->success(__('The feeder homepage has been saved.'));
                Cache::delete(FeederHomepagesTable::LOGO_CACHE_KEY);
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder homepage could not be saved. Please, try again.'));
            }
        }
        $feederCategories = $this->FeederHomepages->FeederCategories->find('treeList', ['limit' => 200]);
        $this->set(compact('feederHomepage', 'feederCategories'));
        $this->set('_serialize', ['feederHomepage']);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function configure()
    {
        $id = 1;
        try {
            $feederHomepage = $this->FeederHomepages->get($id, [
                'contain' => ['FeederHomepageMidpageContainers']
            ]);
        } catch (RecordNotFoundException $e) {
            $feederHomepage = $this->FeederHomepages->newEntity();
            $feederHomepage->id = $id;
        }
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
                $this->Flash->error(__('The homepage image could not be uploaded. Please, try again.'));
            }

            $feederHomepage = $this->FeederHomepages->patchEntity($feederHomepage, $data);

            if ($this->FeederHomepages->save($feederHomepage)) {
                $this->FeederHomepages->FeederHomepageMidpageContainers->updateAll(['homepage_id' => $id], ['id' => $data['feeder_homepage_midpage_container_id']]);
                $this->FeederHomepages->FeederHomepageMidpageContainers->updateAll(['homepage_id' => null], ['homepage_id' => $id, 'id IS NOT' => $data['feeder_homepage_midpage_container_id'] ?: 0]);
                $this->Flash->success(__('The feeder homepage has been saved.'));
                return $this->redirect(['action' => 'configure']);
            } else {
                $this->Flash->error(__('The feeder homepage could not be saved. Please, try again.'));
            }
        }
        $feederCategories = $this->FeederHomepages->FeederCategories->find('treeList', ['limit' => 200]);
        $feederHomepageMidpageContainers = $this->FeederHomepages->FeederHomepageMidpageContainers->find('list', ['limit' => 200]);
        $this->set(compact('feederHomepage', 'feederCategories', 'feederHomepageMidpageContainers'));
        $this->set('_serialize', ['feederHomepage']);

        $metaDescription = $this->request->getData('meta_description');
        $this->set('metaDescription', $metaDescription);
        $this->set('_serialize', ['metaDescription']);
        $titleTag = $this->request->getData('title_tag');
        $this->set('titleTag', $titleTag);
        $this->set('_serialize', ['titleTag']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Homepage id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederHomepage = $this->FeederHomepages->get($id);
        if ($this->FeederHomepages->delete($feederHomepage)) {
            $this->Flash->success(__('The feeder homepage has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder homepage could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
