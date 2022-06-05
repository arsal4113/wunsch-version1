<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Sidebar helper
 */
class SidebarHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Remove menu point if ACL permission is false
     *
     * @param $menu
     * @param $permissions
     * @return mixed
     */
    public function removeMenu($menu, $permissions)
    {
        foreach($menu as $sortOrder => $menuData) {
            foreach($menuData['links'] as $key => $subMenu) {
                if(isset($subMenu['link'])) {
                    $controllerAction = "";
                    if (isset($subMenu['link']['prefix']) && !empty($subMenu['link']['prefix'])) {
                        $controllerAction .= $subMenu['link']['prefix'] . "/";
                    }

                    if (isset($subMenu['link']['plugin']) && !empty($subMenu['link']['plugin'])) {
                        $controllerAction .= $subMenu['link']['plugin'] . "/";
                    }

                    $controllerAction .= $subMenu['link']['controller'] . "/" . $subMenu['link']['action'];
                    if (!isset($permissions[$controllerAction]) || $permissions[$controllerAction] !== true) {
                        unset($menu[$sortOrder]['links'][$key]);
                    }
                }
            }

            if (empty($menu[$sortOrder]['links'])) {
                unset($menu[$sortOrder]);
            }
        }

        return $menu;
    }
}
