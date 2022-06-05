<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;

/**
 * HelpCenter cell
 */
class HelpCenterCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @param integer $columnWidth Bootstrap column width (1-12)
     * @param string $menus Link collection (example: [{"name":"Read Documentation","link":"https://support.i-ways.net/hc/de"},{...}])
     */
    public function showHelpLinks($columnWidth, $menus)
    {
        $this->set(compact('columnWidth', 'menus'));
    }
}