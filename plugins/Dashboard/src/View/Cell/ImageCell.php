<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;

/**
 * Image cell
 */
class ImageCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Add image to your dashboard
     *
     * @param integer $columnWidth Bootstrap column width (1-12)
     * @param string $imageUrl URL of the image
     * @param string $imageCaption Caption of the image
     */
    public function display($columnWidth, $imageUrl, $imageCaption)
    {
        $this->set(compact('columnWidth', 'imageUrl', 'imageCaption'));
    }
}
