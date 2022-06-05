<?php

namespace Feeder\View\Cell;

use App\Application;
use Cake\Cache\Cache;
use Cake\View\Cell;
use Feeder\Model\Table\FeederCategoriesTable;
use Feeder\Model\Table\FeederGuidesTable;

/**
 * Class MegaNaviCell
 * @package Feeder\View\Cell
 * @property FeederCategoriesTable $FeederCategories
 * @property FeederGuidesTable $FeederGuides
 */
class MegaNaviCell extends Cell
{
    /**
     * @param null $search
     * @param bool $customerSegmentSelected
     * @return array|bool|\Feeder\Model\Entity\FeederCategory
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

        $cacheKey = 'mega_navi_id_' . $id;

        $feederCategories = Cache::read($cacheKey);

        if ($feederCategories === false) {
            if (is_numeric($id)) {
                $category = $this->FeederCategories->find()
                    ->where(['id' => $id])
                    ->first();

                if (!empty($category)) {
                    $this->set('categoryName', $category->name);
                    $this->set('parentId', $category->parent_id);
                    while (is_numeric($category->parent_id)) {
                        $category = $this->FeederCategories->find()
                            ->where(['id' => $category->parent_id])
                            ->first();
                    }
                    $feederCategories = $this->FeederCategories->getChildCategories($category->id);
                }
            } else {
                $feederCategories = $this->FeederCategories
                    ->find()
                    ->contain(['ChildFeederCategories'])
                    ->where(['FeederCategories.use_in_search = ' => 1, 'FeederCategories.is_invisible = ' => 0])
                    ->orderAsc('sort_order')
                    ->all()
                    ->toArray();
            }

            if (isset($feederCategories) && is_array($feederCategories) && !empty($feederCategories)) {
                foreach ($feederCategories as $key => $object) {
                    $feederCategories[$key]->subFeederCategories = $this->FeederCategories
                        ->find()
                        ->contain(['ChildFeederCategories'])
                        ->where(['FeederCategories.parent_id =' => $object->id, 'FeederCategories.is_invisible = ' => 0])
                        ->orderAsc('sort_order')
                        ->all();
                }
            }
            Cache::write($cacheKey, $feederCategories);
        }

        $this->loadModel('Feeder.FeederGuides');
        $feederGuides = $this->FeederGuides->find()
            ->where(['use_in_navigation' => 1])
            ->orderAsc('sort_order')
            ->cache('navigated_guides')
            ->all();

        $this->set('feederCategories', $feederCategories);
        $this->set('feederGuides', $feederGuides);

        return $feederCategories;
    }

    /**
     * moreCategories
     */
    public function moreCategories()
    {
        $feederCategories = self::display();
        //$this->set('feederCategories', array_slice($feederCategories, 4)); // 8-DDD
        $this->set('feederCategories', $feederCategories);
    }
}
