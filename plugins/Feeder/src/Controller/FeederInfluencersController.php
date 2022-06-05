<?php
namespace Feeder\Controller;

use Cake\Core\Configure;
use Feeder\Controller\AppController;
use Feeder\Controller\Component\GoogleCloudUploaderComponent;
use Feeder\Controller\Component\ImageUploaderComponent;

/**
 * FeederInfluencers Controller
 *
 * @property \Feeder\Model\Table\FeederInfluencersTable $FeederInfluencers
 * @property ImageUploaderComponent $ImageUploader
 * @property GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \Feeder\Model\Entity\FeederInfluencer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederInfluencersController extends AppController
{
    protected $images = [
        'area_3_image' => 'feeder_influencers' . DS . 'image' . DS,
        'area_3_video' => 'feeder_influencers' . DS . 'video' . DS,
        'area_5_image_1' => 'feeder_influencers' . DS . 'image' . DS,
        'area_5_image_2' => 'feeder_influencers' . DS . 'image' . DS,
        'area_5_image_3' => 'feeder_influencers' . DS . 'image' . DS,
        'area_5_image_4' => 'feeder_influencers' . DS . 'image' . DS,
        'area_5_image_5' => 'feeder_influencers' . DS . 'image' . DS,
        'area_5_image_6' => 'feeder_influencers' . DS . 'image' . DS,
        'area_6_image_1' => 'feeder_influencers' . DS . 'image' . DS,
        'area_6_image_2' => 'feeder_influencers' . DS . 'image' . DS,
        'area_6_image_3' => 'feeder_influencers' . DS . 'image' . DS,
        'area_8_image' => 'feeder_influencers' . DS . 'image' . DS,
        'area_9_image' => 'feeder_influencers' . DS . 'image' . DS,
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Area8Worlds', 'Area9Worlds'],
        ];
        $feederInfluencers = $this->paginate($this->FeederInfluencers);

        $this->set(compact('feederInfluencers'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Influencer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederInfluencer = $this->FeederInfluencers->get($id, [
            'contain' => ['Area8Worlds', 'Area9Worlds', 'FeederInfluencerMiniCategories'],
        ]);

        $this->set('feederInfluencer', $feederInfluencer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederInfluencer = $this->FeederInfluencers->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            foreach ($data as $key => $value) {
                if (isset($value['tmp_name']) && empty($value['tmp_name']) && strpos($data['removed_media'] ?? '', $key) !== false) {
                    $feederInfluencer->{$key} = null;
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

            $feederInfluencer = $this->FeederInfluencers->patchEntity($feederInfluencer, $data);
            if ($this->FeederInfluencers->save($feederInfluencer)) {
                $this->Flash->success(__('The feeder influencer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder influencer could not be saved. Please, try again.'));
        }
        $area8Worlds = $this->FeederInfluencers->Area8Worlds->find('list', ['limit' => 1000]);
        $area9Worlds = $this->FeederInfluencers->Area9Worlds->find('list', ['limit' => 1000]);
        $this->set(compact('feederInfluencer', 'area8Worlds', 'area9Worlds'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Influencer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederInfluencer = $this->FeederInfluencers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            foreach ($data as $key => $value) {
                if (isset($value['tmp_name']) && empty($value['tmp_name']) && strpos($data['removed_media'] ?? '', $key) !== false) {
                    $feederInfluencer->{$key} = null;
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

            $feederInfluencer = $this->FeederInfluencers->patchEntity($feederInfluencer, $data);
            if ($this->FeederInfluencers->save($feederInfluencer)) {
                $this->Flash->success(__('The feeder influencer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder influencer could not be saved. Please, try again.'));
        }
        $area8Worlds = $this->FeederInfluencers->Area8Worlds->find('list', ['limit' => 1000]);
        $area9Worlds = $this->FeederInfluencers->Area9Worlds->find('list', ['limit' => 1000]);
        $this->set(compact('feederInfluencer', 'area8Worlds', 'area9Worlds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Influencer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederInfluencer = $this->FeederInfluencers->get($id);
        if ($this->FeederInfluencers->delete($feederInfluencer)) {
            $this->Flash->success(__('The feeder influencer has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder influencer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
