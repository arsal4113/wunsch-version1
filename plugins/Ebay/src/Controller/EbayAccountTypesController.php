<?php
namespace Ebay\Controller;

use Ebay\Controller\AppController;

/**
 * EbayAccountTypes Controller
 *
 * @property \Ebay\Model\Table\EbayAccountTypesTable $EbayAccountTypes
 */
class EbayAccountTypesController extends AppController
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

        $unusedSearchColumns = ['login_url'];
        $availableColumns = $this->EbayAccountTypes->schema()->columns();
        $availableColumns = array_diff($availableColumns, $unusedSearchColumns);

        $this->set('ebayAccountTypes', $this->paginate($this->EbayAccountTypes->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['ebayAccountTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Account Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayAccountType = $this->EbayAccountTypes->get($id, [
            'contain' => ['EbayAccounts.EbayCredentials', 'EbayAccounts.CoreSellers', 'EbayCredentials']
        ]);
        $this->set('ebayAccountType', $ebayAccountType);
        $this->set('_serialize', ['ebayAccountType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebayAccountType = $this->EbayAccountTypes->newEntity();
        if ($this->request->is('post')) {
            $ebayAccountType = $this->EbayAccountTypes->patchEntity($ebayAccountType, $this->request->data);
            if ($this->EbayAccountTypes->save($ebayAccountType)) {
                $this->Flash->success(__('eBay account type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay account type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ebayAccountType'));
        $this->set('_serialize', ['ebayAccountType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Account Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebayAccountType = $this->EbayAccountTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebayAccountType = $this->EbayAccountTypes->patchEntity($ebayAccountType, $this->request->data);
            if ($this->EbayAccountTypes->save($ebayAccountType)) {
                $this->Flash->success(__('eBay account type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay account type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ebayAccountType'));
        $this->set('_serialize', ['ebayAccountType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Account Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebayAccountType = $this->EbayAccountTypes->get($id);
        if ($this->EbayAccountTypes->delete($ebayAccountType)) {
            $this->Flash->success(__('eBay account type has been deleted.'));
        } else {
            $this->Flash->error(__('eBay account type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}