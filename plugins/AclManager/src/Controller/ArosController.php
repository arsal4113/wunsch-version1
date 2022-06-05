<?php
namespace AclManager\Controller;

use AclManager\Controller\AppController;
use Cake\Cache\Cache;
use Cake\Utility\Text;
use Cake\Event\Event;
/**
 * Aros Controller
 *
 * @property \AclManager\Model\Table\ArosTable $Aros
 */
class ArosController extends AppController
{
	
	/**
	 * (non-PHPdoc)
	 * @see \App\Controller\AppController::initialize()
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('AclManager.AclReflector');
		$this->loadModel('CoreUserRoles');
        $this->Security->config('unlockedActions', ['setPermission']);
	}

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	// Basic filter
    	$conditions = ['CoreUserRoles.id' => 1];
    	$selectedPlugin = '';
    	if($this->request->is('post')) {
    		if(!empty($this->request->data['core_user_role_id'])) {
    			$conditions = ['CoreUserRoles.id' => $this->request->data['core_user_role_id']];
    		}
    		
    		if(!empty($this->request->data['plugin'])) {
    			$selectedPlugin = $this->request->data['plugin'];
    		}
    	}



    	
    	$actions = $this->AclReflector->getAllActions();

    	$methods = $this->AclReflector->formatActionsForTemplate($actions);
    	
    	if(!empty($selectedPlugin)) {
    		$filteredMethods[$selectedPlugin] = isset($methods[$selectedPlugin]) ? $methods[$selectedPlugin] : [];
    	} else {
    		$filteredMethods['Core'] = $methods['Core'];
    	}

    	$coreUserRoles = $this->CoreUserRoles->find()->where([$conditions])->all();


    	$permissions = $this->getPermissions($filteredMethods, $coreUserRoles);
		//debug($permissions);
    	
    	$plugins = $this->AclReflector->getPluginList();

    	$coreUserRoleList = $this->CoreUserRoles->find('list', ['keyField' => 'id', 'valueField' => 'code']);


		$this->set('methods', $filteredMethods);    	
    	$this->set(compact('coreUserRoles', 'coreUserRoleList', 'plugins', 'permissions'));
    }
    
    /**
     * Get permissions
     * 
     * @param array $methods
     * @param CoreUserRole $coreUserRoles
     * @return multitype:
     */
    private function getPermissions($methods, $coreUserRoles)
    {
    	$permissions = [];
    	if(!empty($methods)) {
    		foreach($methods as $plugin => $controllers) {
    			foreach($controllers as $controllerName => $actions) {
    				foreach($actions as $actionData) {
    					$actionName = $controllerName . "/" . $actionData['name'];
    					if($plugin != 'Core') {
    						$actionName = $plugin . "/" . $controllerName . "/" . $actionData['name'];
    					}
    		    
    					foreach($coreUserRoles as $coreUserRole) {
    						$permissions[$coreUserRole->id][$actionName] = $this->Acl->check(['CoreUserRoles' => ['id' => $coreUserRole->id]], $actionName);
    					}
    				}
    			}
    		}
    	}
    	
    	return $permissions;
    }
    
    /**
     * Set permission
     * 
     */
    public function setPermission()
    {
    	$this->autoRender = false;

    	if($this->request->is('post')) {
            Cache::clear(false, 'acl_permissions');
    		if($this->request->data['permission'] == 1) {
    			$this->Acl->allow(['CoreUserRoles' => ['id' => $this->request->data['userRoleId']]], $this->request->data['action']);
				$this->log('Erlaubnis erteilt');
    		}
			if($this->request->data['permission'] == 0) {
    			$this->Acl->deny(['CoreUserRoles' => ['id' => $this->request->data['userRoleId']]], $this->request->data['action']);
				$this->log('Erlaubnis entzogen');
    		}
    	}
    }

	//Returns an Array with the method&action paths. e.g. "CoreCancelReasons/add"
	public function buildMethodPathArrayHelper($methodName){

		$selectedPlugin = $methodName;
		$actions = $this->AclReflector->getAllActions();

		$methods = $this->AclReflector->formatActionsForTemplate($actions);
		$filteredMethods[$selectedPlugin] = isset($methods[$selectedPlugin]) ? $methods[$selectedPlugin] : [];

		$availableMethods = $filteredMethods[$selectedPlugin];

		$methodAndActionArray = array();

		foreach ($availableMethods as $availableMethod => $methodName){
			$stringOne = $availableMethod;
				foreach ($methodName as $function){
					foreach ($function as $name){
						$stringTwo = $name;
						$stringsCombined = $stringOne.'/'.$stringTwo;
						array_push($methodAndActionArray, $stringsCombined);
					}
				}
		}
		return $methodAndActionArray;

	}

    /**
     * Set plugin permissions
     *
     * @return \Cake\Network\Response|null
     */
	public function setPluginPermission()
	{
        if(isset($this->request->data['plugin_name'])) {
            $selectedPlugin = $this->request->data['plugin_name'];
            $arrayOfMethods = $this->buildMethodPathArrayHelper($selectedPlugin);

            $this->autoRender = false;

            if($this->request->is('post')) {
                Cache::clear(false, 'acl_permissions');
                if($this->request->data['action'] == 0) {
                    foreach ($arrayOfMethods as $method){
                        $this->Acl->allow(['CoreUserRoles' => ['id' => $this->request->data['user_role_id']]], $method);
                    }
                    return $this->redirect(['action' => 'index']);
                }
                if($this->request->data['action'] == 1) {
                    foreach ($arrayOfMethods as $method){
                        $this->Acl->deny(['CoreUserRoles' => ['id' => $this->request->data['user_role_id']]], $method);
                    }
                    return $this->redirect(['action' => 'index']);
                }
            }
        } else {
            return $this->redirect(['action' => 'index']);
        }
	}

}
