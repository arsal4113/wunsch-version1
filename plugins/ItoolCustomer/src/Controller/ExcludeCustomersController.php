<?php

namespace ItoolCustomer\Controller;

/**
 * ExcludeCustomers Controller
 *
 * @property \ItoolCustomer\Model\Table\ExcludeCustomersTable $ExcludeCustomers
 *
 * @method \ItoolCustomer\Model\Entity\ExcludeCustomer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExcludeCustomersController extends \App\Controller\AppController
{

    public function uploadCustomersFile()
    {
        if ($this->request->is('post') && $_POST["csv_file"] === 'submit') {

            /* Check if uploaded file is in csv format or not */
            $allowedFileTypes = ['text/csv', 'text/plain', 'text/x-csv', 'application/vnd.ms-excel', 'application/csv', 'application/x-csv', 'text/comma-separated-values', 'text/x-comma-separated-values', 'text/tab-separated-values', 'application/octet-stream'];

            if (!(in_array($this->request->getData(['file'])['type'], $allowedFileTypes))) {
                $this->Flash->error(__('Uploaded file is not in csv format'));
                return $this->redirect($this->referer());
            }

            $handle = fopen($this->request->getData(['file'])['tmp_name'], 'r+');
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 0 && strlen($data[0]) > 0) {
                    $excludeCustomer = $this->ExcludeCustomers->newEntity();
                    $excludeCustomer->email = $data[0]; //Email
                    $excludeCustomer->uploaded_user_identifier = $this->Auth->user()['id'];
                    $this->ExcludeCustomers->save($excludeCustomer);
                }
                $row++;
            }
            $this->Flash->success(__('The File is uploaded successfully.'));
            $this->redirect($this->referer());
        }
    }
}
