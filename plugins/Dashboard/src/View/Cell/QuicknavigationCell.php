<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;

/**
 * Quick navigation cell
 */
class QuicknavigationCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Display quick navigation menus.
     *
     * @param integer $columnWidth Bootstrap column width (1-12)
     * @param string $labelText Quote text
     * @param string $menus Link collection (example: [{"name":"Create new User","link":"#","icon":"fa-user"},{...}])
     */
    public function display($columnWidth, $labelText, $menus)
    {
        $this->set(compact('columnWidth', 'labelText', 'menus'));
    }
}
