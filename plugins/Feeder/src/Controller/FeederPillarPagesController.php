<?php

namespace Feeder\Controller;

use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Feeder\Controller\AppController;
use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;
use Feeder\Model\Entity\FeederPillarPage;

/**
 * FeederPillarPages Controller
 *
 * @property \Feeder\Model\Table\FeederPillarPagesTable $FeederPillarPages
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederPillarPage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederPillarPagesController extends AppController
{
    protected $images = [
        'first_block_image' => 'feeder_pillar_pages' . DS . 'image' . DS,
        'second_block_image' => 'feeder_pillar_pages' . DS . 'image' . DS,
        'third_block_image' => 'feeder_pillar_pages' . DS . 'image' . DS,
        'guide_image' => 'feeder_pillar_pages' . DS . 'image' . DS,
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'order' => [
                'id' => 'desc',
            ]
        ];

        $availableColumns = ['title_tag', 'url_path', 'meta_tag'];

        $feederPillarPages = $this->FeederPillarPages->find('searchable', $this->request->getQueryParams());

        $feederPillarPages = $this->paginate($feederPillarPages);

        $this->set(compact('feederPillarPages', 'availableColumns'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Pillar Page id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederPillarPage = $this->FeederPillarPages->get($id, [
            'contain' => []
        ]);

        $this->set('feederPillarPage', $feederPillarPage);
    }

    public function uploadImage()
    {
        if ($this->request->is('post')) {
            $this->viewBuilder()->setLayout('ajax');
            try {
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), ['image' => 'feeder_pillar_pages' . DS . 'image' . DS], Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), ['image' => 'feeder_pillar_pages' . DS . 'image' . DS]);
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
        $feederPillarPage = $this->FeederPillarPages->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $json = json_decode($data['block_configuration']);
            if($json && $data['block_configuration'] != $json){
                try {
                    $feederPillarPage->setDirty('uploaded_image_size', true);
                    if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                        $this->loadComponent('Feeder.GoogleCloudUploader');
                        $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                    } else {
                        $this->loadComponent('Feeder.ImageUploader');
                        $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                    }
                } catch (\Exception $exp) {
                    $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
                }
                $feederPillarPage = $this->FeederPillarPages->patchEntity($feederPillarPage, $data);
                if ($this->FeederPillarPages->save($feederPillarPage)) {
                    $this->Flash->success(__('The feeder pillar page has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The feeder pillar page could not be saved. Please, try again.'));
            }else{
                $this->Flash->error(__('There was a problem with the block configuration.'));
            }
        }
        $feederCategories = $this->FeederCategories->find('list', ['limit' => 1000]);
        $soldItemCategories = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckoutSessionItems')->getSoldItemsCategories();
        $this->set(compact('feederPillarPage', 'feederCategories', 'soldItemCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Pillar Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederPillarPage = $this->FeederPillarPages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $json = json_decode($data['block_configuration']);
            if($json && $data['block_configuration'] != $json){
                try {
                    $feederPillarPage->setDirty('uploaded_image_size', true);
                    if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                        $this->loadComponent('Feeder.GoogleCloudUploader');
                        $data = $this->GoogleCloudUploader->handleBrowserUpload($data, $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                    } else {
                        $this->loadComponent('Feeder.ImageUploader');
                        $data = $this->ImageUploader->handleImageUpload($data, $this->images);
                    }
                } catch (\Exception $exp) {
                    $this->Flash->error(__('The feeder category image could not be uploaded. Please, try again.'));
                }
                $feederPillarPage = $this->FeederPillarPages->patchEntity($feederPillarPage, $data);
                if ($this->FeederPillarPages->save($feederPillarPage)) {
                    $this->Flash->success(__('The feeder pillar page has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The feeder pillar page could not be saved. Please, try again.'));
            }else{
                $this->Flash->error(__('There was a problem with the block configuration.'));
            }
        }
        $feederCategories = $this->FeederCategories->find('list', ['limit' => 1000]);
        $soldItemCategories = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckoutSessionItems')->getSoldItemsCategories();
        $this->set(compact('feederPillarPage', 'feederCategories', 'soldItemCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Pillar Page id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function copy($id = null)
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederPillarPage = $this->FeederPillarPages->get($id, [
                'contain' => []
            ]);
            $newFeederPillarPage = $this->FeederPillarPages->newEntity($feederPillarPage->toArray());
            if ($this->FeederPillarPages->save($newFeederPillarPage)) {
                $this->Flash->success(__('The feeder pillar page has been copied.'));
            } else {
                $this->Flash->error(__('The feeder pillar page could not be copied.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Pillar Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederPillarPage = $this->FeederPillarPages->get($id);
        if ($this->FeederPillarPages->delete($feederPillarPage)) {
            $this->Flash->success(__('The feeder pillar page has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder pillar page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function download()
    {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $filename = TMP . 'feeder_categories_export_' . Time::now()->i18nFormat('dd.MM.yyyy') . '.csv';
            $this->loadComponent('CsvHandler');
            $handle = $this->CsvHandler->openHandle($filename, "w");
            $headers = [
                __('Id'),
                __('Url Path'),
                __('Title Tag'),
                __('Meta Description'),
                __('Guide Headline'),
                __('Robots Tag'),
                __('Facebook OG Url'),
                __('Facebook OG Title'),
                __('Facebook OG Description'),
                __('H1'),
                __('H2'),
            ];
            $this->CsvHandler->writeCsvLine($headers, $handle, count($headers), ";");

            $limit = 500;
            $page = 1;


            do {
                $feederPillarPages = $this->FeederPillarPages->find()
                    ->orderDesc('id')
                    ->page($page++, $limit);

                /** @var FeederPillarPage $feederPillarPage */
                foreach ($feederPillarPages as $feederPillarPage) {
                    $data = json_decode($feederPillarPage->block_configuration, true);

                    $h1s = [];
                    $h2s = [];
                    foreach ($data ?? [] as $block) {
                        foreach ($block ?? [] as $field) {
                            if (is_string($field)) {
                                $parts = [];
                                preg_match_all('/<[hH]1>(.*)<\/[hH]1>/', $field, $parts);
                                $h1s = array_merge($h1s, $parts[1]);
                                preg_match_all('/<[hH]2>(.*)<\/[hH]2>/', $field, $parts);
                                $h2s = array_merge($h2s, $parts[1]);
                            }
                        }
                    }

                    $line = [
                        $feederPillarPage->id,
                        $feederPillarPage->url_path,
                        $feederPillarPage->title_tag,
                        $feederPillarPage->meta_tag,
                        $feederPillarPage->guide_headline,
                        $feederPillarPage->robots_tag,
                        $feederPillarPage->facebook_og_url,
                        $feederPillarPage->facebook_og_title,
                        $feederPillarPage->facebook_og_description,
                        join(',', $h1s),
                        join(',', $h2s)
                    ];
                    $this->CsvHandler->writeCsvLine($line, $handle, count($line), ";");
                }
            } while (count($feederPillarPages->toArray()) == $limit);

            return $this->response->withFile($filename, ['download' => true]);
        }
    }
}
