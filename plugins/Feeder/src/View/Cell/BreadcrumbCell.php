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
class BreadcrumbCell extends Cell
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
     * @param array $items
     */
    public function display($items = [])
    {
        $breadcrumbItems = [];
        $breadcrumbItems[__('Homepage')] = [
            'controller' => 'Homepage',
            'action' => 'index',
            'plugin' => 'Feeder'
        ];

        $categoryId = $this->request->getQuery('category', false);
        if ($categoryId) {
            $this->loadModel('Feeder.FeederCategories');
            $feederCategory = $this->FeederCategories->find()
                ->where(['FeederCategories.id' => $categoryId])
                ->contain(['ParentFeederCategories'])
                ->cache('breadcrumbFeederCategory' . $categoryId, Application::SHORT_TERM_CACHE)
                ->first();
            if ($feederCategory) {
                if ($feederCategory->parent_feeder_category->id ?? false) {
                    $breadcrumbItems[$feederCategory->parent_feeder_category->name] = [
                        'controller' => 'Browse',
                        'action' => 'view',
                        'plugin' => 'Feeder',
                        $feederCategory->parent_feeder_category->id
                    ];
                }
                $breadcrumbItems[$feederCategory->name] = [
                    'controller' => 'Browse',
                    'action' => 'view',
                    'plugin' => 'Feeder',
                    $feederCategory->id
                ];
            }
        }
        $breadcrumbItems += $items;
        $this->set('breadcrumbItems', $breadcrumbItems);
    }
}
