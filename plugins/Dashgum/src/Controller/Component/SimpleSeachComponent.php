<?php
namespace Dashgum\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * SimpleSeach component
 */
class SimpleSeachComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    /**
     * 
     * @param object $model 		Table to be searched
     * @param string $seachParam 	Column to be searched
     * @param string $searchValue	Value to be searched
     * @return multitype:string
     */
    public function buildSeachConditions($model, $seachParam, $searchValue)
    {
    	$paramData = $model->schema()->column($seachParam);
    	switch($paramData['type']) {
    		case "integer":
    			$condition = [$model->alias() . '.' . $seachParam => $searchValue];
    			break;
    		default:
    			$condition = [$model->alias() . '.' . $seachParam . ' LIKE' => '%' . $searchValue . '%'];
    			break;
    	}
    	
    	return $condition;
    }
}
