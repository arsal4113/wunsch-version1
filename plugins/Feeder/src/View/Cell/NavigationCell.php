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
class NavigationCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     *
     * Default display method.
     *
     * @param null $search
     * @param bool $customerSegmentSelected
     */
    public function display($search = null, $customerSegmentSelected = false)
    {
        $this->loadModel('Feeder.FeederCategories');

        $this->FeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ChildFeederCategories->addBehavior('Feeder.TimeRange');
        $this->FeederCategories->ParentFeederCategories->addBehavior('Feeder.TimeRange');

        $id = null;

        $idParam = ($this->request->getParam('controller') == 'Browse')
            ? $this->request->getParam('pass', null)
            : null;

        if (is_array($idParam) && isset($idParam[0]) && is_numeric($idParam[0])) {
            $id = trim($idParam[0]);
        }
        $this->set('id', $id);
        $this->set('search', $search);
        $this->set('customerSegment', $this->FeederCategories->getCustomerSegment($id));
        $this->set('customerSegmentSelected', $customerSegmentSelected);

        $cacheKeyCatId = 'nav_cell_cat_id_';

        if (is_numeric($id)) {
            $category = $this->FeederCategories->find()
                ->where(['id' => $id])
                ->cache($cacheKeyCatId . $id, Application::MEDIUM_TERM_CACHE)
                ->first();

            if (!empty($category)) {
                while (is_numeric($category->parent_id)) {
                    $category = $this->FeederCategories->find()
                        ->where(['id' => $category->parent_id])
                        ->cache($cacheKeyCatId . $category->parent_id, Application::MEDIUM_TERM_CACHE)
                        ->first();
                }

                $feederCategories = $this->FeederCategories->getChildCategories($category->id);
            }
        } else {
            $feederCategories = $this->FeederCategories
                ->find()
                ->contain(['ChildFeederCategories'])
                ->where(['FeederCategories.use_in_search = ' => 1])
                ->orderAsc('sort_order')
                ->cache('searchable_categories', Application::MEDIUM_TERM_CACHE)
                ->all()
                ->toArray();
        }

        if (isset($feederCategories) && is_array($feederCategories)) {
            foreach ($feederCategories as $key => $object) {
                $feederCategories[$key]->sub_categories = $this->FeederCategories
                    ->find()
                    ->contain(['ChildFeederCategories'])
                    ->where(['FeederCategories.parent_id =' => $object->id])
                    ->orderAsc('sort_order')
                    ->cache('feeder_cat_by_parent_id_' . $object->id, Application::MEDIUM_TERM_CACHE)
                    ->all();
            }
            $this->set('feederCategories', $feederCategories);
        }
    }
}
