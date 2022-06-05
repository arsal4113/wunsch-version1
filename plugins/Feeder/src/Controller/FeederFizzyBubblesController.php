<?php

namespace Feeder\Controller;

use Cake\Core\Configure;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;
use Feeder\Model\Table\FeederFizzyBubblesTable;

/**
 * FeederFizzyBubbles Controller
 *
 * @property FeederFizzyBubblesTable $FeederFizzyBubbles
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederFizzyBubble[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederFizzyBubblesController extends AppController
{
    protected $images = [
        'image_src' => 'feeder_fizzy_bubbles' . DS . 'image' . DS
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $feederFizzyBubbles = $this->paginate($this->FeederFizzyBubbles);

        $this->set(compact('feederFizzyBubbles'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Fizzy Bubble id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederFizzyBubble = $this->FeederFizzyBubbles->get($id, [
            'contain' => []
        ]);

        $this->set('feederFizzyBubble', $feederFizzyBubble);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederFizzyBubble = $this->FeederFizzyBubbles->newEntity();
        if ($this->request->is('post')) {
            try {
                $feederFizzyBubble->setDirty('uploaded_image_size', true);
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The fizzy bubble image could not be uploaded. Please, try again.'));
            }

            $feederFizzyBubble = $this->FeederFizzyBubbles->patchEntity($feederFizzyBubble, $data);
            if ($this->FeederFizzyBubbles->save($feederFizzyBubble)) {
                $this->Flash->success(__('The feeder fizzy bubble has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder fizzy bubble could not be saved. Please, try again.'));
        }
        $this->set(compact('feederFizzyBubble'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Fizzy Bubble id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederFizzyBubble = $this->FeederFizzyBubbles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $feederFizzyBubble->setDirty('uploaded_image_size', true);
                if (Configure::read('google_cloud.cloud_storage.is_active', false)) {
                    $this->loadComponent('Feeder.GoogleCloudUploader');
                    $data = $this->GoogleCloudUploader->handleBrowserUpload($this->request->getData(), $this->images, Configure::read('google_cloud.cloud_storage.bucket_name', 'default'));
                } else {
                    $this->loadComponent('Feeder.ImageUploader');
                    $data = $this->ImageUploader->handleImageUpload($this->request->getData(), $this->images);
                }
            } catch (\Exception $exp) {
                $this->Flash->error(__('The fizzy bubble image could not be uploaded. Please, try again.'));
            }

            $feederFizzyBubble = $this->FeederFizzyBubbles->patchEntity($feederFizzyBubble, $data);
            if ($this->FeederFizzyBubbles->save($feederFizzyBubble)) {
                $this->Flash->success(__('The feeder fizzy bubble has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder fizzy bubble could not be saved. Please, try again.'));
        }
        $this->set(compact('feederFizzyBubble'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Fizzy Bubble id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederFizzyBubble = $this->FeederFizzyBubbles->get($id);
        if ($this->FeederFizzyBubbles->delete($feederFizzyBubble)) {
            $this->Flash->success(__('The feeder fizzy bubble has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder fizzy bubble could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
