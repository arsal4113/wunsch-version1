<?php

namespace HelpDesk\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Cake\Core\Configure;
use HelpDesk\Controller\AppController;

/**
 * HelpDeskCategories Controller
 *
 * @property \HelpDesk\Model\Table\HelpDeskCategoriesTable $HelpDeskCategories
 * @property CoreConfigurationsTable $CoreConfigurations
 *
 * @method \HelpDesk\Model\Entity\HelpDeskCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HelpDeskCategoriesController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];
    const CONFIG_GROUP = 'HelpDeskCategories';
    const HEADER_IMAGE_CONFIG_PATH = 'header/image';

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->HelpDeskCategories->getSchema()->columns();

        $this->set('helpDeskCategories', $this->paginate($this->HelpDeskCategories->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['helpDeskCategories']);

    }

    /**
     * View method
     *
     * @param string|null $id Help Desk Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $helpDeskCategory = $this->HelpDeskCategories->get($id, [
            'contain' => []
        ]);
        $this->set('helpDeskCategory', $helpDeskCategory);
        $this->set('_serialize', ['helpDeskCategory']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $helpDeskCategory = $this->HelpDeskCategories->newEntity();
        if ($this->request->is('post')) {
            $helpDeskCategory = $this->HelpDeskCategories->patchEntity($helpDeskCategory, $data = $this->request->getData());
            if ($this->HelpDeskCategories->save($helpDeskCategory)) {
                $this->Flash->success(__('The help desk FAQ has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The help desk FAQ could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('helpDeskCategory'));
        $this->set('_serialize', ['helpDeskCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Help Desk Category id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $helpDeskCategory = $this->HelpDeskCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $helpDeskCategory = $this->HelpDeskCategories->patchEntity($helpDeskCategory, $data = $this->request->getData());
            if ($this->HelpDeskCategories->save($helpDeskCategory)) {
                $this->Flash->success(__('The help desk FAQ has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The help desk FAQ could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('helpDeskCategory'));
        $this->set('_serialize', ['helpDeskCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Help Desk Category id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $helpDeskCategory = $this->HelpDeskCategories->get($id);
        if ($this->HelpDeskCategories->delete($helpDeskCategory)) {
            $this->Flash->success(__('The help desk FAQ has been deleted.'));
        } else {
            $this->Flash->error(__('The help desk FAQ could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
