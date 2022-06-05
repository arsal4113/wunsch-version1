<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreSellerTypes Controller
 *
 * @property \App\Model\Table\CoreSellerTypesTable $CoreSellerTypes
 */
class CoreSellerTypesController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->CoreSellerTypes->schema()->columns();

        $this->set('coreSellerTypes', $this->paginate($this->CoreSellerTypes->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['coreSellerTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Seller Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreSellerType = $this->CoreSellerTypes->get($id, [
            'contain' => ['CoreSellers', 'CoreUserRoles']
        ]);
        $this->set('coreSellerType', $coreSellerType);
        $this->set('_serialize', ['coreSellerType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreSellerType = $this->CoreSellerTypes->newEntity();
        if ($this->request->is('post')) {
            $coreSellerType = $this->CoreSellerTypes->patchEntity($coreSellerType, $this->request->data);
            if ($this->CoreSellerTypes->save($coreSellerType)) {
                $this->Flash->success(__('The core seller type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core seller type could not be saved. Please, try again.'));
            }
        }
        $coreUserRoles = $this->CoreSellerTypes->CoreUserRoles->find('list');
        $this->set(compact('coreSellerType', 'coreUserRoles'));
        $this->set('_serialize', ['coreSellerType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Seller Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreSellerType = $this->CoreSellerTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreSellerType = $this->CoreSellerTypes->patchEntity($coreSellerType, $this->request->data);
            if ($this->CoreSellerTypes->save($coreSellerType)) {
                $this->Flash->success(__('The core seller type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core seller type could not be saved. Please, try again.'));
            }
        }
        $coreUserRoles = $this->CoreSellerTypes->CoreUserRoles->find('list');
        $this->set(compact('coreSellerType', 'coreUserRoles'));
        $this->set('_serialize', ['coreSellerType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Seller Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreSellerType = $this->CoreSellerTypes->get($id);
        if ($this->CoreSellerTypes->delete($coreSellerType)) {
            $this->Flash->success(__('The core seller type has been deleted.'));
        } else {
            $this->Flash->error(__('The core seller type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
