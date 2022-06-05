<?php
namespace Ebay\Controller;

use Ebay\Controller\AppController;

/**
 * EbaySites Controller
 *
 * @property \Ebay\Model\Table\EbaySitesTable $EbaySites
 */
class EbaySitesController extends AppController
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
            'contain' => ['CoreCurrencies']
        ];

        $this->Prg->commonProcess();

        $availableColumns = $this->EbaySites->schema()->columns();

        $this->set('ebaySites', $this->paginate($this->EbaySites->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['ebaySites']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Site id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebaySite = $this->EbaySites->get($id, [
            'contain' => ['EbayAccounts.EbayAccountTypes', 'EbayAccounts.EbayCredentials', 'EbayAccounts.CoreSellers', 'CoreCurrencies']
        ]);
        $this->set('ebaySite', $ebaySite);
        $this->set('_serialize', ['ebaySite']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebaySite = $this->EbaySites->newEntity();
        if ($this->request->is('post')) {
            $ebaySite = $this->EbaySites->patchEntity($ebaySite, $this->request->data);
            if ($this->EbaySites->save($ebaySite)) {
                $this->Flash->success(__('eBay site has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay site could not be saved. Please, try again.'));
            }
        }
        $ebayAccounts = $this->EbaySites->EbayAccounts->find('list', ['limit' => 200]);
        $coreCurrencies = $this->EbaySites->CoreCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('ebaySite', 'ebayAccounts', 'coreCurrencies'));
        $this->set('_serialize', ['ebaySite']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Site id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebaySite = $this->EbaySites->get($id, [
            'contain' => ['EbayAccounts']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebaySite = $this->EbaySites->patchEntity($ebaySite, $this->request->data);
            if ($this->EbaySites->save($ebaySite)) {
                $this->Flash->success(__('eBay site has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay site could not be saved. Please, try again.'));
            }
        }
        $ebayAccounts = $this->EbaySites->EbayAccounts->find('list', ['limit' => 200]);
        $coreCurrencies = $this->EbaySites->CoreCurrencies->find('list', ['limit' => 200]);
        $this->set(compact('ebaySite', 'ebayAccounts', 'coreCurrencies'));
        $this->set('_serialize', ['ebaySite']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Site id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebaySite = $this->EbaySites->get($id);
        if ($this->EbaySites->delete($ebaySite)) {
            $this->Flash->success(__('eBay site has been deleted.'));
        } else {
            $this->Flash->error(__('eBay site could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
