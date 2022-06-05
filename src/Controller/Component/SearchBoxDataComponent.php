<?php
namespace App\Controller\Component;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\Utility\Inflector;

class SearchBoxDataComponent extends Component {

    /**
     *
     * Return array with all information for a Search Box in View
     * @param Array $textColumns
     * @param Array $selectColumns
     * @param Array $dateTimeColumns
     *
     * @return Array $columnArray
     */
    public function setColumnArray($textColumns = [], $selectColumns = [], $dateTimeColumns = [])
    {
        $columnArray = [];
        foreach ($textColumns as $key => $column) {
            $columnArray[$key] = [
                'name' => $key,
                'label' => $column,
                'type' => 'text',
                'options' => [],
                'id' => ''
            ];
        }
        foreach ($selectColumns as $key => $column) {
            $columnArray[$key] = [
                'name' => $key,
                'label' => $selectColumns[$key]['1'],
                'type' => 'select',
                'options' => $selectColumns[$key]['0'],
                'id' => ''
            ];
        }
        foreach ($dateTimeColumns as $key => $column) {
            $columnArray[$key] = [
                'name' => $key,
                'label' => $column,
                'type' => 'text',
                'options' => [],
                'id' => 'date-time-picker'
            ];
        }
        return $columnArray;
    }
}