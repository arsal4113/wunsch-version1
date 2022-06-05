<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreCustomerAddresses Controller
 *
 * @property \App\Model\Table\CoreCustomerAddressesTable $CoreCustomerAddresses
 */
class CoreCustomerAddressesController extends AppController
{

    /**
     * Get current customer addresses
     *
     * @param $coreCustomerId
     */
    public function customerAddresses($coreCustomerId)
    {
        $this->viewBuilder()->layout('ajax');
        $conditions = [
            'CoreCustomerAddresses' . '.core_customer_id' => $coreCustomerId
        ];

        $addresses = $this->CoreCustomerAddresses->find()->where($conditions)->contain(['CoreCustomers'])->all();
        $this->set('addresses', $addresses);
    }

    /**
     * Add method
     *
     * @param $coreCustomerId
     */
    public function add($coreCustomerId)
    {
        $this->loadModel('CoreCountries');
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
        }

        $countryCodes = $this->CoreCountries->find('list', ['limit' => 200, 'keyField' => 'iso_code', 'valueField' => 'name'])->toArray();
        $coreCustomerAddress = $this->CoreCustomerAddresses->newEntity();
        $coreCustomer = $this->CoreCustomerAddresses->CoreCustomers->get($coreCustomerId);
        if ($this->request->is('post')) {
            $this->request->data['CoreCustomerAddresses']['country_name'] = $countryCodes[$this->request->data['CoreCustomerAddresses']['country_code']];
            $coreCustomerAddress = $this->CoreCustomerAddresses->patchEntity($coreCustomerAddress, $this->request->data);
            if ($this->CoreCustomerAddresses->save($coreCustomerAddress)) {
                $this->Flash->success('Customer address has been saved.');
            } else {
                $this->Flash->error('Customer address could not be saved. Please, try again.');
            }
        }

        $this->set(compact('coreCustomerAddress', 'coreCustomer', 'countryCodes'));
        $this->set('_serialize', ['coreCustomerAddress']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Customer Address id.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($coreCustomerId, $id = null)
    {
        $this->loadModel('CoreCountries');
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
        }

        $coreCustomerAddress = $this->CoreCustomerAddresses->get($id, [
            'contain' => []
        ]);

        $countryCodes = $this->CoreCountries->find('list', ['limit' => 200, 'keyField' => 'iso_code', 'valueField' => 'name'])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['CoreCustomerAddresses']['country_name'] = $countryCodes[$this->request->data['CoreCustomerAddresses']['country_code']];
            $coreCustomerAddress = $this->CoreCustomerAddresses->patchEntity($coreCustomerAddress, $this->request->data);
            if ($this->CoreCustomerAddresses->save($coreCustomerAddress)) {
                $this->Flash->success('Customer address has been modified.');
            } else {
                $this->Flash->error('Customer address could not be modified. Please, try again.');
            }
        }

        $this->set(compact('coreCustomerAddress', 'coreCustomerId', 'countryCodes'));
        $this->set('_serialize', ['coreCustomerAddress']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Customer Address id.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($coreCustomerId, $id = null)
    {
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
        }

        $this->request->allowMethod(['get', 'post', 'delete']);
        $coreCustomerAddress = $this->CoreCustomerAddresses->get($id);
        if ($this->CoreCustomerAddresses->delete($coreCustomerAddress)) {
            $this->Flash->success('Customer address has been deleted.');
        } else {
            $this->Flash->error('Customer address could not be deleted. Please, try again.');
        }
    }
}
