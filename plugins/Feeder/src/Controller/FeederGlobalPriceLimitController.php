<?php

namespace Feeder\Controller;

/**
 * FeederGlobalPriceLimit Controller
 *
 * @property \Feeder\Model\Table\FeederGlobalPriceLimitTable $FeederGlobalPriceLimit
 *
 * @method \Feeder\Model\Entity\FeederGlobalPriceLimit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederGlobalPriceLimitController extends AppController
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

        $availableColumns = $this->FeederGlobalPriceLimit->getSchema()->columns();

        $this->set('feederGlobalPriceLimit', $this->paginate($this->FeederGlobalPriceLimit->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['feederGlobalPriceLimit']);
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Global Price Limit id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->get($id, [
            'contain' => []
        ]);
        $this->set('feederGlobalPriceLimit', $feederGlobalPriceLimit);
        $this->set('_serialize', ['feederGlobalPriceLimit']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->newEntity();
        if ($this->request->is('post')) {
            $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->patchEntity($feederGlobalPriceLimit, $this->request->data);
            if ($this->FeederGlobalPriceLimit->save($feederGlobalPriceLimit)) {
                $this->Flash->success(__('The feeder global price limit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder global price limit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederGlobalPriceLimit'));
        $this->set('_serialize', ['feederGlobalPriceLimit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Global Price Limit id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->patchEntity($feederGlobalPriceLimit, $this->request->data);
            if ($this->FeederGlobalPriceLimit->save($feederGlobalPriceLimit)) {
                $this->Flash->success(__('The feeder global price limit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The feeder global price limit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederGlobalPriceLimit'));
        $this->set('_serialize', ['feederGlobalPriceLimit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Global Price Limit id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->get($id);
        if ($this->FeederGlobalPriceLimit->delete($feederGlobalPriceLimit)) {
            $this->Flash->success(__('The feeder global price limit has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder global price limit could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * @return \Cake\Http\Response|null
     */
    public function choose()
    {
        $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->get(1, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederGlobalPriceLimit = $this->FeederGlobalPriceLimit->patchEntity($feederGlobalPriceLimit, $this->request->getData());
            if ($this->FeederGlobalPriceLimit->save($feederGlobalPriceLimit)) {
                $this->Flash->success(__('The feeder global price limit has been saved.'));
                return $this->redirect(['action' => 'choose']);
            } else {
                $this->Flash->error(__('The feeder global price limit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('feederGlobalPriceLimit'));
        $this->set('_serialize', ['feederGlobalPriceLimit']);
    }
}
