<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;

/**
 * Clock cell
 */
class ClockCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Add clock to your dashboard.
     *
     * @param integer $columnWidth Bootstrap column width (1-12)
     * @return void
     */
    public function display($columnWidth)
    {
        $this->set(compact('columnWidth'));
    }
}
