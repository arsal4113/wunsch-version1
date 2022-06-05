<?php
namespace Ebay\Controller;

use Ebay\Controller\AppController;

/**
 * EbayAuctionTypes Controller
 *
 * @property \Ebay\Model\Table\EbayAuctionTypesTable $EbayAuctionTypes
 */
class EbayAuctionTypesController extends AppController
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

        $availableColumns = $this->EbayAuctionTypes->schema()->columns();

        $this->set('ebayAuctionTypes', $this->paginate($this->EbayAuctionTypes->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['ebayAuctionTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Auction Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayAuctionType = $this->EbayAuctionTypes->get($id, [
            'contain' => ['EbayAutoListerConfigurations', 'EbayLaunchProfiles', 'EbayListings']
        ]);
        $this->set('ebayAuctionType', $ebayAuctionType);
        $this->set('_serialize', ['ebayAuctionType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ebayAuctionType = $this->EbayAuctionTypes->newEntity();
        if ($this->request->is('post')) {
            $ebayAuctionType = $this->EbayAuctionTypes->patchEntity($ebayAuctionType, $this->request->data);
            if ($this->EbayAuctionTypes->save($ebayAuctionType)) {
                $this->Flash->success(__('eBay auction type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay auction type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ebayAuctionType'));
        $this->set('_serialize', ['ebayAuctionType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ebay Auction Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ebayAuctionType = $this->EbayAuctionTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ebayAuctionType = $this->EbayAuctionTypes->patchEntity($ebayAuctionType, $this->request->data);
            if ($this->EbayAuctionTypes->save($ebayAuctionType)) {
                $this->Flash->success(__('eBay auction type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('eBay auction type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ebayAuctionType'));
        $this->set('_serialize', ['ebayAuctionType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ebay Auction Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ebayAuctionType = $this->EbayAuctionTypes->get($id);
        if ($this->EbayAuctionTypes->delete($ebayAuctionType)) {
            $this->Flash->success(__('eBay auction type has been deleted.'));
        } else {
            $this->Flash->error(__('eBay auction type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
