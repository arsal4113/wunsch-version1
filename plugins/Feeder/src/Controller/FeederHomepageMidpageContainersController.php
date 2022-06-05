<?php
namespace Feeder\Controller;

use Cake\Core\Configure;
use Feeder\Controller\AppController;

/**
 * FeederHomepageMidpageContainers Controller
 *
 * @property \Feeder\Model\Table\FeederHomepageMidpageContainersTable $FeederHomepageMidpageContainers
 *
 * @method \Feeder\Model\Entity\FeederHomepageMidpageContainer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederHomepageMidpageContainersController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    protected $images = [
        'image_desktop' => 'feeder_homepage_midpage_containers' . DS . 'image' . DS,
        'image_tablet' => 'feeder_homepage_midpage_containers' . DS . 'image' . DS,
        'image_mobile' => 'feeder_homepage_midpage_containers' . DS . 'image' . DS,
        'video_desktop_mp4' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
        'video_tablet_mp4' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
        'video_mobile_mp4' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
        'video_desktop_webm' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
        'video_tablet_webm' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
        'video_mobile_webm' => 'feeder_homepage_midpage_containers' . DS . 'video' . DS,
    ];


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeederHomepages']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->FeederHomepageMidpageContainers->getSchema()->columns();

        $this->set('feederHomepageMidpageContainers', $this->paginate($this->FeederHomepageMidpageContainers->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederHomepageMidpageContainers']);
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Homepage Midpage Container id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->get($id, [
            'contain' => ['FeederHomepages']
        ]);
        $this->set('feederHomepageMidpageContainer', $feederHomepageMidpageContainer);
        $this->set('_serialize', ['feederHomepageMidpageContainer']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->newEntity();
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
                $this->Flash->error(__('The image could not be uploaded. Please, try again.'));
            }

            $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->patchEntity($feederHomepageMidpageContainer, $data);
            if ($this->FeederHomepageMidpageContainers->save($feederHomepageMidpageContainer)) {
                $this->Flash->success(__('The feeder homepage midpage container has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder homepage midpage container could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederHomepageMidpageContainer'));
        $this->set('_serialize', ['feederHomepageMidpageContainer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Homepage Midpage Container id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->get($id, [
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
                $this->Flash->error(__('The image could not be uploaded. Please, try again.'));
            }

            foreach (explode(',', $data['removed_media']) as $removedMedium) {
                $removedMedium && $data[$removedMedium] = '';
            }
            $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->patchEntity($feederHomepageMidpageContainer, $data);
            if ($this->FeederHomepageMidpageContainers->save($feederHomepageMidpageContainer)) {
                $this->Flash->success(__('The feeder homepage midpage container has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder homepage midpage container could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederHomepageMidpageContainer'));
        $this->set('_serialize', ['feederHomepageMidpageContainer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Homepage Midpage Container id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederHomepageMidpageContainer = $this->FeederHomepageMidpageContainers->get($id);
        if ($this->FeederHomepageMidpageContainers->delete($feederHomepageMidpageContainer)) {
            $this->Flash->success(__('The feeder homepage midpage container has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder homepage midpage container could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
