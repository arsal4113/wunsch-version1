<?php

namespace Feeder\Controller;

use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederGuides Controller
 *
 * @property \Feeder\Model\Table\FeederGuidesTable $FeederGuides
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederGuide[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederGuidesController extends AppController
{
    protected $images = [
        'animation_image' => 'feeder_guides' . DS . 'image' . DS,
        'first_background_image' => 'feeder_guides' . DS . 'image' . DS,
        'second_background_image' => 'feeder_guides' . DS . 'image' . DS,
        'optional_url_image' => 'feeder_guides' . DS . 'image' . DS,
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $feederGuides = $this->paginate($this->FeederGuides);

        $this->set(compact('feederGuides'));
    }


    /**
     * View method
     *
     * @param string|null $id Feeder Guide id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederGuide = $this->FeederGuides->get($id, [
            'contain' => ['FeederCategories']
        ]);

        $this->set('feederGuide', $feederGuide);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederGuide = $this->FeederGuides->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if (!empty($data['background_color']) && strpos($data['background_color'], '#') === false) {
                $data['background_color'] = '#' . $data['background_color'];
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
                $this->Flash->error(__('A Guide Image could not be uploaded. Please, try again.'));
            }
            $feederGuide = $this->FeederGuides->patchEntity($feederGuide, $data);
            if ($this->FeederGuides->save($feederGuide)) {
                $this->Flash->success(__('The feeder guide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder guide could not be saved. Please, try again.'));
        }
        $feederCategories = $this->FeederGuides->FeederCategories->find('list', ['limit' => 1000]);
        $feederPillarPages = $this->FeederGuides->FeederPillarPages->find('list', ['limit' => 200]);
        $this->set(compact('feederGuide', 'feederCategories', 'feederPillarPages'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Feeder Guide id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederGuide = $this->FeederGuides->get($id, [
            'contain' => ['FeederCategories']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if (!empty($data['background_color']) && strpos($data['background_color'], '#') === false) {
                $data['background_color'] = '#' . $data['background_color'];
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
                $this->Flash->error(__('A Guide image could not be uploaded. Please, try again.'));
            }
            $feederGuide = $this->FeederGuides->patchEntity($feederGuide, $data);
            if ($this->FeederGuides->save($feederGuide)) {
                $this->Flash->success(__('The feeder guide has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder guide could not be saved. Please, try again.'));
        }
        $feederCategories = $this->FeederGuides->FeederCategories->find('list', ['limit' => 1000]);
        $feederPillarPages = $this->FeederGuides->FeederPillarPages->find('list', ['limit' => 200]);
        $this->set(compact('feederGuide', 'feederCategories', 'feederPillarPages'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Feeder Guide id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederGuide = $this->FeederGuides->get($id);
        if ($this->FeederGuides->delete($feederGuide)) {
            $this->Flash->success(__('The feeder guide has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder guide could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
