<?php
namespace AclManager\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;
use Cake\Core\Plugin;
use Cake\Utility\Text;

/**
 * AclReflector component
 */
class AclReflectorComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Get all actions
     *
     * @return multitype:
     */
    public function getAllActions()
    {
    	$coreControllersActions = $this->getAllCoreControllersActions();
    	$pluginControllersActions = $this->getAllPluginsControllersActions();

    	return array_merge($coreControllersActions, $pluginControllersActions);
    }

    /**
     * Get all core controllers actions
     *
     * @return multitype:string
     */
    public function getAllCoreControllersActions()
    {
    	$controllers = $this->getAllCoreControllers();
    	$controllersActions = [];
    	foreach($controllers as $controller) {
    		$controllerClassName = $controller['name'];
    		$namespacedClassName = $controller['namespaced'];
    		$ctrlCleanedMethods = $this->getControllerActions($controllerClassName, $namespacedClassName);

    		foreach($ctrlCleanedMethods as $action) {
    			$controllersActions[] = $controller['name'] . '/' . $action;
    		}
    	}

    	sort($controllersActions);

    	return $controllersActions;
    }

    /**
     * Get all core controllers
     *
     * @return multitype:multitype:string Ambigous <multitype:, multitype:string >
     */
    public function getAllCoreControllers()
    {
    	$controllers = [];

    	$folder = new Folder();

    	$didCD = $folder->cd(APP . 'Controller');
    	if(!empty($didCD)) {
    		$files = $folder->findRecursive('.*Controller\.php');
    		if(!empty($files)) {
    			foreach($files as $fileName) {
    				$file = basename($fileName);
    				$controllerClassName = Inflector::camelize(substr($file, 0, strlen($file) - strlen('.php')));

    				$controllers[] = [
    					'file' => $fileName,
    					'name' => substr($controllerClassName, 0, strlen($controllerClassName) - strlen('Controller')),
    					'namespaced' => '\App\Controller\\' . $controllerClassName
    				];
    			}
    		}
    	}

    	sort($controllers);

    	return $controllers;
    }

    /**
     * Get all plugins controllers actions
     *
     * @param string $filterDefaultController
     * @return multitype:string
     */
    public function getAllPluginsControllersActions($filterDefaultController = false)
    {
    	$pluginControllers = $this->getAllPluginsControllers();

    	$pluginControllersActions = [];
    	if(!empty($pluginControllers)) {
	    	foreach($pluginControllers as $pluginController) {
	    		$pluginName     = $this->getPluginName($pluginController['name']);
	    		$controllerName = $this->getPluginControllerName($pluginController['name']);

	    		if(!$filterDefaultController || $pluginName != $controllerName) {
	    			$controllerClassName = $controllerName . 'Controller';
	    			$ctrlCleanedMethods = $this->getControllerActions($controllerClassName, $pluginController['namespaced']);
	    			foreach($ctrlCleanedMethods as $action) {
	    				$pluginControllersActions[] = $pluginName . '/' . $controllerName . '/' . $action;
	    			}
	    		}
	    	}
    	}

    	sort($pluginControllersActions);

    	return $pluginControllersActions;
    }

    /**
     * Get all plugin controllers
     *
     * @param string $filterDefaultController
     * @return multitype:multitype:string Ambigous <multitype:, multitype:string >
     */
    public function getAllPluginsControllers($filterDefaultController = false)
    {
    	$pluginPaths = $this->getAllPluginsPaths();
    	$pluginsControllers = [];
    	$folder = new Folder();

    	// Loop through the plugins
    	if(!empty($pluginPaths)) {
    		foreach($pluginPaths as $pluginPath) {
    			if(
    			    preg_match("@" . ROOT . DS . 'plugins' . "@", $pluginPath) ||
                    preg_match("@" . ROOT . DS . 'vendor' . DS . 'iways' . DS . "@", $pluginPath) ||
                    preg_match("@" . ROOT . DS . 'vendor' . DS . 'i-ways' . DS . "@", $pluginPath)
                ) {
	    			$didCD = $folder->cd($pluginPath . 'src' . DS . 'Controller');
		    		if(!empty($didCD)) {
		    			$files = $folder->findRecursive('.*Controller\.php');

		    			if(strrpos($pluginPath, DS) == strlen($pluginPath) - 1) {
		    				$pluginPath = substr($pluginPath, 0, strlen($pluginPath) - 1);
		    			}

		    			$pluginName = substr($pluginPath, strrpos($pluginPath, DS) + 1);

		    			foreach($files as $fileName) {
		    				$file = basename($fileName);

		    				// Get the controller name
		    				$controllerClassName = Inflector::camelize(substr($file, 0, strlen($file) - strlen('.php')));

		    				$camelCasePluginName = Inflector::camelize(str_replace('-', '_', $pluginName));

		    				if(!$filterDefaultController || $camelCasePluginName . 'Controller' != $controllerClassName) {
		    					if (!preg_match('/^'. $camelCasePluginName . 'App/', $controllerClassName)) {
		    						$pluginsControllers[] = [
		    							'file' => $fileName,
		    							'name' => $camelCasePluginName . "/" . substr($controllerClassName, 0, strlen($controllerClassName) - strlen('Controller')),
		    							'namespaced' => '\\' . $camelCasePluginName . "\\Controller\\" . $controllerClassName
		    						];
		    					}
		    				}
		    			}
		    		}
    			}
    		}
    	}

    	sort($pluginsControllers);

    	return $pluginsControllers;
    }

    /**
     * Get plugin list
     *
     * @return multitype:
     */
    public function getPluginList()
    {
    	$loadedPlugins = $this->getAllPluginsPaths();
    	$plugins = [];
    	foreach($loadedPlugins as $plugin) {
    		if(preg_match("@" . ROOT . DS . 'plugins' . "@", $plugin)) {
    			if(strrpos($plugin, DS) == strlen($plugin) - 1) {
    				$plugin = substr($plugin, 0, strlen($plugin) - 1);
    			}

    			$pluginName = substr($plugin, strrpos($plugin, DS) + 1);
    			$plugins[$pluginName] = $pluginName;
    		} elseif (preg_match("@" . ROOT . DS . 'vendor' . DS . 'iways' . DS. "@", $plugin) ||
                preg_match("@" . ROOT . DS . 'vendor' . DS . 'i-ways' . DS. "@", $plugin)) {
                if (strrpos($plugin, DS) == strlen($plugin) - 1) {
                    $plugin = substr($plugin, 0, strlen($plugin) - 1);
                }
                $pluginName = substr($plugin, strrpos($plugin, DS) + 1);
                $pluginName = Inflector::camelize(str_replace('-', '_', $pluginName));
                $plugins[$pluginName] = $pluginName;
            }
    	}
    	$plugins = array_merge(['Core' => 'Core'], $plugins);

    	return $plugins;
    }


    /**
     * Get all plugin paths
     *
     * @return multitype:string
     */
    public function getAllPluginsPaths()
    {
    	$pluginNames = Plugin::loaded();
    	$pluginPaths = [];
    	if(!empty($pluginNames)) {
    		foreach($pluginNames as $pluginName) {
    			$pluginPaths[] = Plugin::path($pluginName);
    		}
    	}

    	return $pluginPaths;
    }

    /**
     * Return the methods of a given class name.
     * Depending on the $filter_base_methods parameter, it can return the parent methods.
     *
     * @param string $controllerClassname (eg: 'AppController')
     * @param string $namespacedClassName (eg: '\App\Controller\AppController')
     * @param boolean $filterBaseMethods
     */
    public function getControllerActions($controllerClassname, $namespacedClassName, $filterBaseMethods = true)
    {
    	$controllerClassname = $this->getControllerClassname($controllerClassname);
    	$methods = get_class_methods(new $namespacedClassName());
    	if(isset($methods) && !empty($methods)) {
    		if($filterBaseMethods) {
    			$baseMethods = get_class_methods('Cake\Controller\Controller');

    			$ctrlCleanedMethods = [];
    			foreach($methods as $method) {
    				if(!in_array($method, $baseMethods) && strpos($method, '_') !== 0) {
    					$ctrlCleanedMethods[] = $method;
    				}
    			}

    			return $ctrlCleanedMethods;
    		}
    		else
    		{
    			return $methods;
    		}
    	}
    	else
    	{
    		return [];
    	}
    }

    /**
     * Get controller class name
     *
     * @param string $controllerName
     * @return string
     */
    public function getControllerClassname($controllerName)
    {
    	if(strrpos($controllerName, 'Controller') !== strlen($controllerName) - strlen('Controller')) {
    		if(stripos($controllerName, '/') === false) {
    			$controllerClassname = $controllerName . 'Controller';
    		} else {
    			$controllerClassname = substr($controllerName, strripos($controllerName, '/') + 1) . 'Controller';
    		}

    		return $controllerClassname;
    	} else {
    		return $controllerName;
    	}
    }

    /**
     * Get plugin name
     *
     * @param string $ctrlName
     * @return \Cake\Utility\mixed|boolean
     */
    public function getPluginName($ctrlName = null)
    {
    	$arr = Text::tokenize($ctrlName, '/');
    	if (count($arr) == 2) {
    		return $arr[0];
    	} else {
    		return false;
    	}
    }

    /**
     * Get plugin controller name
     *
     * @param string $ctrlName
     * @return \Cake\Utility\mixed|boolean
     */
    public function getPluginControllerName($ctrlName = null)
    {
    	$arr = Text::tokenize($ctrlName, '/');
    	if (count($arr) == 2) {
    		return $arr[1];
    	} else {
    		return false;
    	}
    }

    /**
     * Format actions for template
     *
     * @param array $actions
     * @return Ambigous <multitype:, multitype:unknown , multitype:Ambigous <unknown, \Cake\Utility\mixed> >
     */
    public function formatActionsForTemplate($actions)
    {
    	$methods = [];
    	if(!empty($actions)) {
    		foreach($actions as $key => $action) {
    			$arr = Text::tokenize($action, '/');
    			if (count($arr) == 2) {
    				$pluginName = null;
    				$controllerName = $arr[0];
    				$action = $arr[1];
    			} elseif(count($arr) == 3) {
    				$pluginName = $arr[0];
    				$controllerName = $arr[1];
    				$action = $arr[2];
    			}

    			if($controllerName == 'App') {
    				unset($actions[$key]);
    			} else {
    				if(isset($pluginName)) {
    					$methods[$pluginName][$controllerName][] = array('name' => $action);
    				} else {
    					$methods['Core'][$controllerName][] = array('name' => $action);
    				}
    			}
    		}
    	}

    	return $methods;
    }
}
