<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;

/**
 * Quote cell
 */
class QuoteCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Add quote to your dashboard
     *
     * @param integer $columnWidth Bootstrap column width (1-12)
     * @param string $quote Quote text
     * @param string $quoteAuthor Quote author
     */
    public function display($columnWidth, $quote, $quoteAuthor)
    {
        $this->set(compact('columnWidth', 'quote', 'quoteAuthor'));
    }
}
