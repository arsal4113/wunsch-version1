<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * DashboardConfigurations Controller
 *
 * @property \Dashboard\Model\Table\DashboardConfigurationsTable $DashboardConfigurations
 * @property \App\Model\Table\CoreSellerTypesTable $CoreSellerTypes
 * @property \App\Model\Table\CoreSellersTable $CoreSellers
 * @property \App\Model\Table\CoreUsersTable $CoreUsers
 * @property \Search\Controller\Component\PrgComponent $Prg
 * @property \Dashboard\Controller\Component\CellCollectorComponent $CellCollector
 */
class DashboardConfigurationsController extends AppController
{

    /**
    * @var array
    *
    */
    public $components = ['Search.Prg', 'Dashboard.CellCollector'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'order' => ['DashboardConfigurations.sort_order' => 'ASC'],
            'contain' => ['CoreSellerTypes', 'CoreSellers', 'CoreUsers']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->DashboardConfigurations->schema()->columns();

        $this->set('dashboardConfigurations', $this->paginate($this->DashboardConfigurations->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['dashboardConfigurations']);
    }

    /**
     * View method
     *
     * @param string|null $id Dashboard Configuration id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dashboardConfiguration = $this->DashboardConfigurations->get($id, [
            'contain' => ['CoreSellerTypes', 'CoreSellers', 'CoreUsers']
        ]);
        $this->set('dashboardConfiguration', $dashboardConfiguration);
        $this->set('_serialize', ['dashboardConfiguration']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('CoreSellerTypes');
        $this->loadModel('CoreSellers');
        $this->loadModel('CoreUsers');

        $dashboardConfiguration = $this->DashboardConfigurations->newEntity();
        if ($this->request->is('post')) {
            $dashboardConfiguration = $this->DashboardConfigurations->patchEntity($dashboardConfiguration, $this->request->data);
            if ($this->DashboardConfigurations->save($dashboardConfiguration)) {
                $this->Flash->success(__('Dashboard configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Dashboard configuration could not be saved. Please, try again.'));
            }
        }

        $availableCells = $this->CellCollector->getAllAvailableCells();
        $cells = $this->CellCollector->getCellNameList($availableCells);
        $coreSellerTypes = $this->CoreSellerTypes->find('list', ['limit' => 200]);
        $coreSellers = $this->CoreSellers->find('list', ['limit' => 200]);
        $coreUsers = $this->CoreUsers->find('list', ['keyField' => 'id', 'valueField' => 'email', 'limit' => 200]);
        $this->set(compact('dashboardConfiguration', 'coreSellerTypes', 'coreSellers', 'coreUsers', 'cells'));
        $this->set('_serialize', ['dashboardConfiguration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dashboard Configuration id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('CoreSellerTypes');
        $this->loadModel('CoreSellers');
        $this->loadModel('CoreUsers');

        $dashboardConfiguration = $this->DashboardConfigurations->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dashboardConfiguration = $this->DashboardConfigurations->patchEntity($dashboardConfiguration, $this->request->data);
            if ($this->DashboardConfigurations->save($dashboardConfiguration)) {
                $this->Flash->success(__('Dashboard configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Dashboard configuration could not be saved. Please, try again.'));
            }
        }

        $availableCells = $this->CellCollector->getAllAvailableCells();
        $cells = $this->CellCollector->getCellNameList($availableCells);
        $coreSellerTypes = $this->CoreSellerTypes->find('list', ['limit' => 200]);
        $coreSellers = $this->CoreSellers->find('list', ['limit' => 200]);
        $coreUsers = $this->CoreUsers->find('list', ['keyField' => 'id', 'valueField' => 'email', 'limit' => 200]);
        $this->set(compact('dashboardConfiguration', 'coreSellerTypes', 'coreSellers', 'coreUsers', 'cells'));
        $this->set('_serialize', ['dashboardConfiguration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dashboard Configuration id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dashboardConfiguration = $this->DashboardConfigurations->get($id);
        if ($this->DashboardConfigurations->delete($dashboardConfiguration)) {
            $this->Flash->success(__('Dashboard configuration has been deleted.'));
        } else {
            $this->Flash->error(__('Dashboard configuration could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get cell parameters
     *
     * @param $cellName
     */
    public function getCellParameters($cellName = null)
    {
        $parameters = '';
        $docComment = '';
        if(!empty($cellName)) {
            $availableCells = $this->CellCollector->getAllAvailableCells();
            if(isset($availableCells[$cellName]['parameters'])) {
                $parameters = $availableCells[$cellName]['parameters'];
                $docComment = $availableCells[$cellName]['docComment'];
            }
        }

        $this->set('parameters', $parameters);
        $this->set('docComment', $docComment);
        $this->render('get_cell_parameters', 'ajax');
    }
}
