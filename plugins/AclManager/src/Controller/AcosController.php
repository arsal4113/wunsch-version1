<?php
namespace AclManager\Controller;

use AclManager\Controller\AppController;
use Acl\AclExtras;
use Cake\Cache\Cache;

/**
 * Acos Controller
 *
 * @property \AclManager\Model\Table\AcosTable $Acos
 */
class AcosController extends AppController
{
    /**
     * Syncronize controllers and actions (ACOS)
     * 
     * @return Ambigous <void, \Cake\Network\Response>
     */
    public function syncControllersActions()
    {
    	$this->autoRender = false;
        Cache::clear(false, 'acl_permissions');
    	$aclExtras = new AclExtras();
    	
    	$params = [
    		'help' => false,
    		'verbose' => false,
    		'quiet' => false
    	];
    	
    	$aclExtras->startup($this);
    	$aclExtras->acoSync($params);
    	$this->Flash->success('ACOs have been syncronized.', ['clear' => true]);
    	
    	return $this->redirect(['controller' => 'Aros', 'action' => 'index', 'plugin' => 'AclManager', 'admin' => false]);
    }
}
