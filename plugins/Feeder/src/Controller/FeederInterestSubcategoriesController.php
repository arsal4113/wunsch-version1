<?php

namespace Feeder\Controller;

use Feeder\Controller\AppController;

/**
 * FeederInterestSubcategories Controller
 *
 * @property \Feeder\Model\Table\FeederInterestSubcategoriesTable $FeederInterestSubcategories
 *
 * @method \Feeder\Model\Entity\FeederInterestSubcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederInterestSubcategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $feederInterestSubcategories = $this->paginate($this->FeederInterestSubcategories);

        $this->set(compact('feederInterestSubcategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Interest Subcategory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederInterestSubcategory = $this->FeederInterestSubcategories->get($id);

        $this->set('feederInterestSubcategory', $feederInterestSubcategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederInterestSubcategory = $this->FeederInterestSubcategories->newEntity();
        if ($this->request->is('post')) {
            $feederInterestSubcategory = $this->FeederInterestSubcategories->patchEntity($feederInterestSubcategory, $this->request->getData());
            if ($this->FeederInterestSubcategories->save($feederInterestSubcategory)) {
                $this->Flash->success(__('The feeder interest subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder interest subcategory could not be saved. Please, try again.'));
        }
        $this->set(compact('feederInterestSubcategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Interest Subcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederInterestSubcategory = $this->FeederInterestSubcategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederInterestSubcategory = $this->FeederInterestSubcategories->patchEntity($feederInterestSubcategory, $this->request->getData());
            if ($this->FeederInterestSubcategories->save($feederInterestSubcategory)) {
                $this->Flash->success(__('The feeder interest subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder interest subcategory could not be saved. Please, try again.'));
        }
        $this->set(compact('feederInterestSubcategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Interest Subcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederInterestSubcategory = $this->FeederInterestSubcategories->get($id);
        if ($this->FeederInterestSubcategories->delete($feederInterestSubcategory)) {
            $this->Flash->success(__('The feeder interest subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder interest subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
