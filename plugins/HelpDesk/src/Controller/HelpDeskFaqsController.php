<?php

namespace HelpDesk\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Cake\Core\Configure;
use Cake\ORM\Query;
use HelpDesk\Model\Entity\HelpDeskCategory;
use HelpDesk\Model\Table\HelpDeskCategoriesTable;

/**
 * HelpDeskFaqs Controller
 *
 * @property \HelpDesk\Model\Table\HelpDeskFaqsTable $HelpDeskFaqs
 * @property CoreConfigurationsTable $CoreConfigurations
 * @property HelpDeskCategoriesTable $HelpDeskCategories
 *
 * @property \Feeder\Model\Table\FeederHomepagesTable $FeederHomepages
 * @property \Feeder\Controller\Component\ImageUploaderComponent $ImageUploader
 * @property \Feeder\Controller\Component\GoogleCloudUploaderComponent $GoogleCloudUploader
 *
 * @method \HelpDesk\Model\Entity\HelpDeskFaq[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HelpDeskFaqsController extends AppController
{
    /**
     * @var HelpDeskCategory $helpDeskCategory
     */
    public $helpDeskCategory;

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    protected $images = [
        'image' => 'help_desk_faqs' . DS . 'image' . DS
    ];
    const CONFIG_GROUP = 'HelpDeskFaqs';
    const HEADER_IMAGE_CONFIG_PATH = 'header/image';

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadModel('CoreConfigurations');
        $this->loadModel('HelpDesk.HelpDeskCategories');

        $this->Prg->commonProcess();

        $availableColumns = $this->HelpDeskFaqs->getSchema()->columns();

        $coreSellerId = $this->Auth->user('core_seller_id');
        $headerImage = $this->CoreConfigurations->loadSellerConfiguration($coreSellerId, self::CONFIG_GROUP . '/' . self::HEADER_IMAGE_CONFIG_PATH, null);

        /** @var HelpDeskCategory $helpDeskCategory */
        $categoryList = $this->HelpDeskCategories->find('list', ['valueField' => 'category', 'limit' => 200]);
        $categoryNames = $categoryList->toArray();

        $this->set('helpDeskFaqs', $this->paginate($this->HelpDeskFaqs->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['helpDeskFaqs']);
        $this->set('headerImage', $headerImage);
        $this->set('categoryNames', $categoryNames);
    }

    /**
     * View method
     *
     * @param string|null $id Help Desk Faq id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $helpDeskFaq = $this->HelpDeskFaqs->get($id, [
            'contain' => []
        ]);
        $this->set('helpDeskFaq', $helpDeskFaq);
        $this->set('_serialize', ['helpDeskFaq']);

        $this->loadModel('HelpDesk.HelpDeskCategories');
        /** @var HelpDeskCategory $helpDeskCategory */
        $categoryList = $this->HelpDeskCategories->find('list', ['valueField' => 'category', 'limit' => 200]);
        $categoryNames = $categoryList->toArray();
        $this->set('categoryNames', $categoryNames);
    }

    /**
     * Add method
     *
     *  @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $helpDeskFaq = $this->HelpDeskFaqs->newEntity();
        if ($this->request->is('post')) {
            $helpDeskFaq = $this->HelpDeskFaqs->patchEntity($helpDeskFaq, $data = $this->request->getData());
            if ($this->HelpDeskFaqs->save($helpDeskFaq)) {
                $this->Flash->success(__('The help desk FAQ has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The help desk FAQ could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('helpDeskFaq'));
        $this->set('_serialize', ['helpDeskFaq']);

        $this->loadModel('HelpDesk.HelpDeskCategories');
        /** @var HelpDeskCategory $helpDeskCategory */
        $categoryNames = $this->HelpDeskCategories->find('list', ['valueField' => 'category', 'limit' => 200]);
        $this->set(compact('helpDeskCategories' , 'categoryNames'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Help Desk Faq id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $helpDeskFaq = $this->HelpDeskFaqs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $helpDeskFaq = $this->HelpDeskFaqs->patchEntity($helpDeskFaq, $data = $this->request->getData());
            if ($this->HelpDeskFaqs->save($helpDeskFaq)) {
                $this->Flash->success(__('The help desk FAQ has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The help desk FAQ could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('helpDeskFaq'));
        $this->set('_serialize', ['helpDeskFaq']);

        $this->loadModel('HelpDesk.HelpDeskCategories');
        /** @var HelpDeskCategory $helpDeskCategory */
        $categoryNames = $this->HelpDeskCategories->find('list', ['valueField' => 'category', 'limit' => 200]);
        $this->set(compact('helpDeskCategories' , 'categoryNames'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Help Desk Faq id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $helpDeskFaq = $this->HelpDeskFaqs->get($id);
        if ($this->HelpDeskFaqs->delete($helpDeskFaq)) {
            $this->Flash->success(__('The help desk FAQ has been deleted.'));
        } else {
            $this->Flash->error(__('The help desk FAQ could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * upload Header Image
     */
    public function uploadHeaderImage()
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
                $this->Flash->error(__('The help desk header image could not be uploaded. Please, try again.'));
            }
            $this->loadModel('CoreConfigurations');
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

            if ($this->CoreConfigurations->save($headerImage)) {;
                $this->Flash->success(__('The help desk has been saved.'));
            } else {
                $this->Flash->error(__('The help desk could not be saved. Please, try again.'));
            }
        }
        $this->redirect(['action' => 'index']);
    }
}
