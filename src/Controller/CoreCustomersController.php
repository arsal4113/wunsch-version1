<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreCustomers Controller
 *
 * @property \App\Model\Table\CoreCustomersTable $CoreCustomers
 */
class CoreCustomersController extends AppController
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

        $this->paginate = [
            'contain' => ['CoreSellers', 'DefaultShippingAddresses', 'DefaultBillingAddresses']
        ];

        $unusedSearchColums = ['core_seller_id', 'default_shipping_address_id', 'default_billing_address_id', 'created', 'modified'];
        $availableColumns = $this->CoreCustomers->schema()->columns();
        $availableColumns = array_diff($availableColumns, $unusedSearchColums);

        $this->set('coreCustomers', $this->paginate($this->CoreCustomers->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['coreCustomers']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Customer id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreCustomer = $this->CoreCustomers->get($id, [
            'contain' => ['CoreSellers', 'DefaultShippingAddresses', 'DefaultBillingAddresses', 'CoreCustomerAddresses']
        ]);
        $this->set('coreCustomer', $coreCustomer);
        $this->set('_serialize', ['coreCustomer']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreCustomer = $this->CoreCustomers->newEntity();
        if ($this->request->is('post')) {
            $coreCustomer = $this->CoreCustomers->patchEntity($coreCustomer, $this->request->data);
            if ($this->CoreCustomers->save($coreCustomer)) {
                $this->Flash->success('Customer has been saved.');
                return $this->redirect(['action' => 'edit', $coreCustomer->id]);
            } else {
                $this->Flash->error('Customer could not be saved. Please, try again.');
            }
        }

        $coreSellers = $this->CoreCustomers->CoreSellers->find('list');
        $this->set(compact('coreCustomer', 'coreSellers'));
        $this->set('_serialize', ['coreCustomer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Customer id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreCustomer = $this->CoreCustomers->get($id, [
            'contain' => ['CoreCustomerAddresses', 'CoreUsers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreCustomer = $this->CoreCustomers->patchEntity($coreCustomer, $this->request->data);
            if ($this->CoreCustomers->save($coreCustomer)) {
                $this->Flash->success('Customer has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Customer could not be saved. Please, try again.');
            }
        }

        $coreSellers = $this->CoreCustomers->CoreSellers->find('list', ['limit' => 200]);
        $defaultShippingAddresses = $this->CoreCustomers->DefaultShippingAddresses->find('list', ['limit' => 200, 'conditions' => ['DefaultShippingAddresses.core_customer_id' => $id]]);
        $defaultBillingAddresses = $this->CoreCustomers->DefaultBillingAddresses->find('list', ['limit' => 200, 'conditions' => ['DefaultBillingAddresses.core_customer_id' => $id]]);
        $this->set(compact('coreCustomer', 'coreSellers', 'defaultShippingAddresses', 'defaultBillingAddresses'));
        $this->set('_serialize', ['coreCustomer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Customer id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreCustomer = $this->CoreCustomers->get($id);
        if ($this->CoreCustomers->delete($coreCustomer)) {
            $this->Flash->success('Customer has been deleted.');
        } else {
            $this->Flash->error('Customer could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Set standard shipping address
     *
     * @param $customerId
     * @param $addressId
     */
    public function setStandardShippingAddress($customerId, $addressId)
    {
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
        }
        $coreCustomer = $this->CoreCustomers->get($customerId);
        if($coreCustomer) {
            $coreCustomer->default_shipping_address_id = $addressId;
            $this->CoreCustomers->save($coreCustomer);
        }
    }

    /**
     * Set standard billing address
     *
     * @param $customerId
     * @param $addressId
     */
    public function setStandardBillingAddress($customerId, $addressId)
    {
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
        }
        $coreCustomer = $this->CoreCustomers->get($customerId);
        if($coreCustomer) {
            $coreCustomer->default_billing_address_id = $addressId;
            $this->CoreCustomers->save($coreCustomer);
        }
    }
}
