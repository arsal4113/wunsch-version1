<?php

namespace VisitManager\Controller;

/**
 * ProductVisits Controller
 *
 * @property \VisitManager\Model\Table\ProductVisitsTable $ProductVisits
 *
 * @method \VisitManager\Model\Entity\ProductVisit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductVisitsController extends AppController
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

        $availableColumns = $this->ProductVisits->getSchema()->columns();

        $this->set('productVisits', $this->paginate($this->ProductVisits->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['productVisits']);
    }

    /**
     * View method
     *
     * @param string|null $id Product Visit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productVisit = $this->ProductVisits->get($id, [
            'contain' => []
        ]);
        $this->set('productVisit', $productVisit);
        $this->set('_serialize', ['productVisit']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productVisit = $this->ProductVisits->newEntity();
        if ($this->request->is('post')) {
            $productVisit = $this->ProductVisits->patchEntity($productVisit, $this->request->getData());
            if ($this->ProductVisits->save($productVisit)) {
                $this->Flash->success(__('The product visit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product visit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productVisit'));
        $this->set('_serialize', ['productVisit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Visit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productVisit = $this->ProductVisits->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productVisit = $this->ProductVisits->patchEntity($productVisit, $this->request->getData());
            if ($this->ProductVisits->save($productVisit)) {
                $this->Flash->success(__('The product visit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The product visit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productVisit'));
        $this->set('_serialize', ['productVisit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Visit id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productVisit = $this->ProductVisits->get($id);
        if ($this->ProductVisits->delete($productVisit)) {
            $this->Flash->success(__('The product visit has been deleted.'));
        } else {
            $this->Flash->error(__('The product visit could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
