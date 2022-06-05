<?php
namespace Dashboard\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Plugin;

/**
 * CellCollector component
 *
 * @property \App\Controller\Component\FileHandlerComponent $FileHandler
 */
class CellCollectorComponent extends Component
{

    public $components = ['FileHandler'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * Get all available cells
     *
     * @return array
     */
    public function getAllAvailableCells()
    {
        $path = Plugin::path('Dashboard') . 'src' . DS . 'View' . DS . 'Cell' . DS;
        $files = $this->FileHandler->getFileList($path, '.php');

        $cells = [];
        if(!empty($files)) {
            foreach($files as $file) {
                $cellName = str_replace(".php", "", $file);
                if(class_exists('\\Dashboard\\View\\Cell\\' . $cellName)) {
                    $cellClass = '\\Dashboard\\View\\Cell\\' . $cellName;
                    $class = new \ReflectionClass($cellClass);
                    $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
                    if(!empty($methods)) {
                        foreach($methods as $method) {
                            if($method->class == str_replace("\\Dashboard", "Dashboard", $cellClass)) {

                                $r = new \ReflectionMethod($cellClass, $method->name);
                                $params = $r->getParameters();

                                $cellParameters = [];
                                if(!empty($params)) {
                                    foreach($params as $param) {
                                        $cellParameters[] = $param->name;
                                    }

                                    $cellParameters = json_encode($cellParameters);
                                }

                                $docComment = $r->getDocComment();

                                $cell = 'Dashboard.' . str_replace("Cell", "", $cellName) . "::" . $method->name;
                                $cells[$cell] = [
                                    'name' => $cell,
                                    'parameters' => $cellParameters,
                                    'docComment' => $docComment
                                ];
                            }
                        }
                    }
                }
            }
        }

        return $cells;
    }

    /**
     * Get cell name list
     *
     * @param $cells
     * @return array
     */
    public function getCellNameList($cells)
    {
        $cellNames = [];
        if($cells) {
            foreach($cells as $cell) {
                $cellNames[$cell['name']] = $cell['name'];
            }
        }

        return $cellNames;
    }
}
