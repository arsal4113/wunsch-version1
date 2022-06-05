<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CoreErrorNotificationProfiles Controller
 *
 * @property \App\Model\Table\CoreErrorNotificationProfilesTable $CoreErrorNotificationProfiles
 */
class CoreErrorNotificationProfilesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadComponent('Dashgum.SimpleSeach');
        $this->paginate = [
            'contain' => ['CoreSellers']
        ];
        if ($this->request->is('post')) {
            if(!empty($this->request->data['search_value']) && !empty($this->request->data['search_param'])) {
                $condition = $this->SimpleSeach->buildSeachConditions(
                    $this->CoreErrorNotificationProfiles, $this->request->data['search_param'], $this->request->data['search_value']
                );
                $this->paginate['conditions'] = $condition;
            }
        }
        $this->set('availableColumns', $this->CoreErrorNotificationProfiles->schema()->columns());
        $this->set('coreErrorNotificationProfiles', $this->paginate($this->CoreErrorNotificationProfiles));
        $this->set('_serialize', ['coreErrorNotificationProfiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Core Error Notification Profile id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->get($id, [
            'contain' => ['CoreSellers']
        ]);
        $this->set('coreErrorNotificationProfile', $coreErrorNotificationProfile);
        $this->set('_serialize', ['coreErrorNotificationProfile']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->newEntity();
        if ($this->request->is('post')) {
            $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->patchEntity($coreErrorNotificationProfile, $this->request->data);
            if ($this->CoreErrorNotificationProfiles->save($coreErrorNotificationProfile)) {
                $this->Flash->success(__('The core error notification profile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core error notification profile could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreErrorNotificationProfiles->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('coreErrorNotificationProfile', 'coreSellers'));
        $this->set('_serialize', ['coreErrorNotificationProfile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Error Notification Profile id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->patchEntity($coreErrorNotificationProfile, $this->request->data);
            if ($this->CoreErrorNotificationProfiles->save($coreErrorNotificationProfile)) {
                $this->Flash->success(__('The core error notification profile has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The core error notification profile could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreErrorNotificationProfiles->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('coreErrorNotificationProfile', 'coreSellers'));
        $this->set('_serialize', ['coreErrorNotificationProfile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Error Notification Profile id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreErrorNotificationProfile = $this->CoreErrorNotificationProfiles->get($id);
        if ($this->CoreErrorNotificationProfiles->delete($coreErrorNotificationProfile)) {
            $this->Flash->success(__('The core error notification profile has been deleted.'));
        } else {
            $this->Flash->error(__('The core error notification profile could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
