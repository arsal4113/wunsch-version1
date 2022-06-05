<?php

namespace Feeder\View\Cell;

use Cake\View\Cell;
use Feeder\Model\Table\FeederCategoriesTable;

/**
 * Category cell
 *
 * @property FeederCategoriesTable $FeederCategories
 */
class CategoryCell extends Cell
{
    const BANNER_PRODUCTS_FACTOR = 30;
    const BANNER_SMALL_POSITION = 16;
    const BANNER_LARGE_POSITION = 6;
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
     * @param $id
     * @param array $wishlistItems
     */
    public function display($id, $wishlistItems = [])
    {
        $this->loadModel('Feeder.FeederCategories');

        $categoryWithItems = $this->FeederCategories->getFeederCategoryWithItems($id, $this->request);

        $items = $categoryWithItems['items'] ?? [];
        $feederCategory = $categoryWithItems['feeder_category'] ?? null;
        $customerSegmentSelected = $categoryWithItems['customer_segment_selected'] ?? null;
        $itemCount = $categoryWithItems['item_count'] ?? $feederCategory->banner_products_factor ?? null;
        $bannerPage = $categoryWithItems['banner_page'] ?? null;
        $smallBannerSlots = $categoryWithItems['small_banner_slots'] ?? [];
        $smallShownBanners = $categoryWithItems['small_shown_banners'] ?? [];
        $largeBannerSlots = $categoryWithItems['large_banner_slots'] ?? [];
        $largeShownBanners = $categoryWithItems['large_shown_banners'] ?? [];
        $filter = $categoryWithItems['filter'] ?? [];

        $ajax = false;
        if ($this->request->is('ajax')) {
            $ajax = true;
        }
        $this->set('ajax', $ajax);
        $this->set('wishlistItems', $wishlistItems);
        $this->set('feederCategory', $feederCategory);
        $this->set('customerSegmentSelected', $customerSegmentSelected);
        $this->set('under', $filter['under']);
        $this->set('upper', $filter['upper']);
        $this->set('itemCount', $itemCount);
        $this->set('banner_page', $bannerPage);
        $this->set('smallBannerSlots', $smallBannerSlots);
        $this->set('smallShownBanners', $smallShownBanners);
        $this->set('largeBannerSlots', $largeBannerSlots);
        $this->set('page', $filter['page']);
        $this->set('filter', $filter);
        $this->set('largeShownBanners', $largeShownBanners);
        $this->set('search', $filter['search']);
        if (isset($items)) {
            $this->set('items', $items);
        } else {
            $this->set('items', []);
            $this->set('error', true);
        }
    }
}