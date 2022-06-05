<?php
namespace Ebay\Controller;

use Ebay\Controller\AppController;

/**
 * EbayCredentials Controller
 *
 * @property \Ebay\Model\Table\EbayCredentialsTable $EbayCredentials
 */
class EbayCredentialsController extends AppController
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
        $this->paginate = [
            'contain' => ['EbayAccountTypes']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->EbayCredentials->schema()->columns();

        $this->set('ebayCredentials', $this->paginate($this->EbayCredentials->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['ebayCredentials']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Credential id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayCredential = $this->EbayCredentials->get($id, [
            'contain' => ['EbayAccountTypes', 'EbayAccounts.EbayAccountTypes', 'EbayAccounts.CoreSellers']
        ]);
        $this->set('ebayCredential', $ebayCredential);
        $this->set('_serialize', ['ebayCredential']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebayCredential = $this->EbayCredentials->newEntity();
        if ($this->request->is('post')) {
            $ebayCredential = $this->EbayCredentials->patchEntity($ebayCredential, $this->request->data);
            if ($this->EbayCredentials->save($ebayCredential)) {
                $this->Flash->success(__('eBay credential has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay credential could not be saved. Please, try again.'));
            }
        }
        $ebayAccountTypes = $this->EbayCredentials->EbayAccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('ebayCredential', 'ebayAccountTypes'));
        $this->set('_serialize', ['ebayCredential']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Credential id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebayCredential = $this->EbayCredentials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebayCredential = $this->EbayCredentials->patchEntity($ebayCredential, $this->request->data);
            if ($this->EbayCredentials->save($ebayCredential)) {
                $this->Flash->success(__('eBay credential has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay credential could not be saved. Please, try again.'));
            }
        }
        $ebayAccountTypes = $this->EbayCredentials->EbayAccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('ebayCredential', 'ebayAccountTypes'));
        $this->set('_serialize', ['ebayCredential']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Credential id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebayCredential = $this->EbayCredentials->get($id);
        if ($this->EbayCredentials->delete($ebayCredential)) {
            $this->Flash->success(__('eBay credential has been deleted.'));
        } else {
            $this->Flash->error(__('eBay credential could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
