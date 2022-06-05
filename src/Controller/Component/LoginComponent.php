<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Cache\Cache;

/**
 * Class LoginComponent
 *
 * @package App\Controller\Component
 * @property \AclManager\Controller\Component\AclReflectorComponent $AclReflector
 */
class LoginComponent extends Component
{

    /**
     * @var array
     */
    public $components = ['AclManager.AclReflector'];

    /**
     * Initialize method
     *
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->controller = $this->_registry->getController();
        $this->controller->loadModel('CoreUsers');
    }

    /**
     * Process user data
     *
     * @param $user
     * @return mixed
     */
    public function processUserData($user)
    {
        if ($user && $user['is_active']) {

            $userData = $this->controller->CoreUsers->find()->where([
                'CoreUsers.id' => $user['id']
            ])
            ->contain(['CoreSellers.CoreSellerTypes', 'CoreUserRoles'])
            ->first();

            if(!empty($userData)) {
                $user['core_seller_name'] = $userData->core_seller->name;
                $user['core_user_roles'] = $this->controller->CoreUsers->getUserRoleIds($user['id']);

                $permissionKey = 'permissions_user_role';
                foreach ($user['core_user_roles'] as $userRoleId) {
                    $permissionKey .= '_' . $userRoleId;
                }

                $permissions = Cache::read($permissionKey, 'acl_permissions');
                if (empty($permissions)) {
                    $actions = $this->AclReflector->getAllActions();
                    $methods = $this->AclReflector->formatActionsForTemplate($actions);
                    $permissions = [];
                    if (!empty($methods)) {
                        foreach ($methods as $plugin => $controllers) {
                            foreach ($controllers as $controllerName => $actions) {
                                foreach ($actions as $actionData) {
                                    $actionName = $controllerName . "/" . $actionData['name'];
                                    if ($plugin != 'Core') {
                                        $actionName = $plugin . "/" . $controllerName . "/" . $actionData['name'];
                                    }

                                    foreach ($user['core_user_roles'] as $coreUserRole) {
                                        if (!isset($permissions[$actionName]) || $permissions[$actionName] === false) {
                                            $permissions[$actionName] = $this->controller->Acl->check(['CoreUserRoles' => ['id' => $coreUserRole]], $actionName);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    Cache::write($permissionKey, $permissions, 'acl_permissions');
                }
                $user['permissions'] = $permissions;
                $user['core_user_id'] = $user['id'];
                if(isset($userData->core_seller->core_seller_type)) {
                    $user['core_seller_type_id'] = $userData->core_seller->core_seller_type->id;
                    $user['core_seller_type'] = $userData->core_seller->core_seller_type->code;
                }
            }
        }
        return $user;
    }
}