<?php
/**
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace AclManager\Auth;

use Cake\Network\Request;
use Acl\Auth\BaseAuthorize;
use Cake\ORM\TableRegistry;

/**
 * An authorization adapter for AuthComponent. Provides the ability to authorize using the AclComponent,
 * If AclComponent is not already loaded it will be loaded using the Controller's ComponentRegistry.
 *
 * @see AuthComponent::$authenticate
 * @see AclComponent::check()
 */
class ActionsMultiAuthorize extends BaseAuthorize
{

    /**
     * Authorize a user using the AclComponent.
     *
     * @param array $user The user to authorize
     * @param \Cake\Network\Request $request The request needing authorization.
     * @return bool
     */
    public function authorize($user, Request $request)
    {
    	if($request->params['action'] == 'login' || $request->params['action'] == 'logout') {
    		return true;	 
    	}
    	
        $Acl = $this->_registry->load('Acl');
        $UserRoles = TableRegistry::get('CoreUserRoles');
        $result = false;
        foreach($user['core_user_roles'] as $role) {
        	$role = [$UserRoles->alias() => ['id' => $role]];
        	if($Acl->check($role, $this->action($request))) {
        		$result = true;
        	}
        }
        return $result;
    }
}
