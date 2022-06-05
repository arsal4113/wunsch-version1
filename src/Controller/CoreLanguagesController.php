<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreLanguages Controller
 *
 * @property \App\Model\Table\CoreLanguagesTable $CoreLanguages
 */
class CoreLanguagesController extends AppController
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

        $availableColumns = $this->CoreLanguages->schema()->columns();

        $this->set('coreLanguages', $this->paginate($this->CoreLanguages->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['coreLanguages']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Language id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreLanguage = $this->CoreLanguages->get($id, [
            'contain' => ['CoreSellers', 'EbayAutoListerConfigurations', 'EbayDisputeExplanationNames', 'EbayDisputeReasonNames', 'EbayLaunchProfiles', 'EbayListings']
        ]);
        $this->set('coreLanguage', $coreLanguage);
        $this->set('_serialize', ['coreLanguage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreLanguage = $this->CoreLanguages->newEntity();
        if ($this->request->is('post')) {
            $coreLanguage = $this->CoreLanguages->patchEntity($coreLanguage, $this->request->data);
            if ($this->CoreLanguages->save($coreLanguage)) {
                $this->Flash->success(__('Language has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('coreLanguage'));
        $this->set('_serialize', ['coreLanguage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Language id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreLanguage = $this->CoreLanguages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreLanguage = $this->CoreLanguages->patchEntity($coreLanguage, $this->request->data);
            if ($this->CoreLanguages->save($coreLanguage)) {
                $this->Flash->success(__('Language has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Language could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('coreLanguage'));
        $this->set('_serialize', ['coreLanguage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Language id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreLanguage = $this->CoreLanguages->get($id);
        if ($this->CoreLanguages->delete($coreLanguage)) {
            $this->Flash->success(__('Language has been deleted.'));
        } else {
            $this->Flash->error(__('Language could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
