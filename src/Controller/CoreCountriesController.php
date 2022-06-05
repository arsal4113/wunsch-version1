<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreCountries Controller
 *
 * @property \App\Model\Table\CoreCountriesTable $CoreCountries
 */
class CoreCountriesController extends AppController
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

        $availableColumns = $this->CoreCountries->schema()->columns();

        $this->set('coreCountries', $this->paginate($this->CoreCountries->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['coreCountries']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Country id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreCountry = $this->CoreCountries->get($id, [
            'contain' => ['CoreSellers']
        ]);
        $this->set('coreCountry', $coreCountry);
        $this->set('_serialize', ['coreCountry']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreCountry = $this->CoreCountries->newEntity();
        if ($this->request->is('post')) {
            $coreCountry = $this->CoreCountries->patchEntity($coreCountry, $this->request->data);
            if ($this->CoreCountries->save($coreCountry)) {
                $this->Flash->success(__('Country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('coreCountry'));
        $this->set('_serialize', ['coreCountry']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Country id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreCountry = $this->CoreCountries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreCountry = $this->CoreCountries->patchEntity($coreCountry, $this->request->data);
            if ($this->CoreCountries->save($coreCountry)) {
                $this->Flash->success(__('Country has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('coreCountry'));
        $this->set('_serialize', ['coreCountry']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Country id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreCountry = $this->CoreCountries->get($id);
        if ($this->CoreCountries->delete($coreCountry)) {
            $this->Flash->success(__('Country has been deleted.'));
        } else {
            $this->Flash->error(__('Country could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}