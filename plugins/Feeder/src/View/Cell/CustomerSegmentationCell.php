<?php

namespace Feeder\View\Cell;

use App\Application;
use Cake\View\Cell;
use Feeder\Model\Table\FeederCategoriesTable;

/**
 * Navigation cell
 *
 * @property FeederCategoriesTable $FeederCategories
 */
class CustomerSegmentationCell extends Cell
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
     * @return void
     */
    public function display()
    {
        $this->loadModel('Feeder.FeederCategories');

        $feederCategories = $this->FeederCategories->find('all')
            ->contain('ChildFeederCategories')
            ->where(['FeederCategories.parent_id IS' => null])
            ->cache('customerSegmentCellFeederCategories', Application::SHORT_TERM_CACHE)
            ->orderAsc('sort_order');

        $this->set('feederCategories', $feederCategories);
    }
}
