<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreCurrencies Controller
 *
 * @property \App\Model\Table\CoreCurrenciesTable $CoreCurrencies
 */
class CoreCurrenciesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('coreCurrencies', $this->paginate($this->CoreCurrencies));
        $this->set('_serialize', ['coreCurrencies']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Currency id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreCurrency = $this->CoreCurrencies->get($id, [
            'contain' => []
        ]);
        $this->set('coreCurrency', $coreCurrency);
        $this->set('_serialize', ['coreCurrency']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreCurrency = $this->CoreCurrencies->newEntity();
        if ($this->request->is('post')) {
            $coreCurrency = $this->CoreCurrencies->patchEntity($coreCurrency, $this->request->data);
            if ($this->CoreCurrencies->save($coreCurrency)) {
                $this->Flash->success('The core currency has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The core currency could not be saved. Please, try again.');
            }
        }
        $this->set(compact('coreCurrency'));
        $this->set('_serialize', ['coreCurrency']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Currency id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreCurrency = $this->CoreCurrencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreCurrency = $this->CoreCurrencies->patchEntity($coreCurrency, $this->request->data);
            if ($this->CoreCurrencies->save($coreCurrency)) {
                $this->Flash->success('The core currency has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The core currency could not be saved. Please, try again.');
            }
        }
        $this->set(compact('coreCurrency'));
        $this->set('_serialize', ['coreCurrency']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Currency id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreCurrency = $this->CoreCurrencies->get($id);
        if ($this->CoreCurrencies->delete($coreCurrency)) {
            $this->Flash->success('The core currency has been deleted.');
        } else {
            $this->Flash->error('The core currency could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
