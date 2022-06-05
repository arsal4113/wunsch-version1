<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Inflector;

/**
 * CoreUserRoles Controller
 *
 * @property \App\Model\Table\CoreUserRolesTable $CoreUserRoles
 */
class CoreUserRolesController extends AppController
{

    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

	/**
	 * (non-PHPdoc)
	 * @see \App\Controller\AppController::initialize()
	 */
	public function initialize() {
		parent::initialize();
		$this->loadComponent('Dashgum.SimpleSeach');
        $this->loadComponent('SearchBoxData');
	}
    
    /**
     * CakePHP beforeFilter
     *
     * @see \Cake\Controller\Controller::beforeFilter()
     */
    public function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoreSellers'],
            'order' => ['CoreUserRoles.id' => 'ASC']
        ];
        $this->Prg->commonProcess();
        $sellers = $this->CoreUserRoles->CoreSellers->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ])->toArray();
        $textColumns = [
            'id' => 'Id',
            'code' => 'Code',
            'name' => 'Name'
        ];
        $selectColumns = [
            'core_seller_id' => [
                $sellers,
                'Seller'
            ]
        ];
        $availableColumns = $this->SearchBoxData->setColumnArray($textColumns, $selectColumns);
        $this->set('coreUserRoles', $this->paginate($this->CoreUserRoles->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', $availableColumns);
        $this->set('_serialize', ['coreUserRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Core User Role id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreUserRole = $this->CoreUserRoles->get($id, [
            'contain' => ['CoreSellers', 'CoreUsers']
        ]);
        $this->set('coreUserRole', $coreUserRole);
        $this->set('_serialize', ['coreUserRole']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreUserRole = $this->CoreUserRoles->newEntity();
        if ($this->request->is('post')) {
            $coreUserRole = $this->CoreUserRoles->patchEntity($coreUserRole, $this->request->data);
            if ($this->CoreUserRoles->save($coreUserRole)) {
                $this->Flash->success('User role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('User role could not be saved. Please, try again.');
            }
        }
        $coreSellers = $this->CoreUserRoles->CoreSellers->find('list', ['limit' => 200]);
        $coreUsers = $this->CoreUserRoles->CoreUsers->find('list', ['keyField' => 'id', 'valueField' => 'email', 'limit' => 200]);
        $this->set(compact('coreUserRole', 'coreSellers', 'coreUsers'));
        $this->set('_serialize', ['coreUserRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core User Role id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreUserRole = $this->CoreUserRoles->get($id, [
            'contain' => ['CoreUsers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreUserRole = $this->CoreUserRoles->patchEntity($coreUserRole, $this->request->data);
            if ($this->CoreUserRoles->save($coreUserRole)) {
                $this->Flash->success('User role has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('User role could not be saved. Please, try again.');
            }
        }
        $coreSellers = $this->CoreUserRoles->CoreSellers->find('list', ['limit' => 200]);
        $coreUsers = $this->CoreUserRoles->CoreUsers->find('list', ['keyField' => 'id', 'valueField' => 'email', 'limit' => 200]);
        $this->set(compact('coreUserRole', 'coreSellers', 'coreUsers'));
        $this->set('_serialize', ['coreUserRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core User Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreUserRole = $this->CoreUserRoles->get($id, ['contain' => ['CoreUsers']]);
        
        if(!empty($coreUserRole->core_users)) {
        	$this->Flash->error('You cannot delete this user role. There are user accounts connected to this user role.');
        	return $this->redirect(['action' => 'index']);
        }
        
        if ($this->CoreUserRoles->delete($coreUserRole)) {
            $this->Flash->success('User role has been deleted.');
        } else {
            $this->Flash->error('User role could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
