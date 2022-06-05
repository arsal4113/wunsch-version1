<?php

namespace ItoolCustomer\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 *
 * CatchEbayCategoryMapping component
 */
class CatchEbayCategoryMappingComponent extends Component
{

    protected $catchCategoryIds = [];

    /**
     * @param $ebayCheckoutSessionItem
     * @return array
     */
    public function getCatchCategoryFromEbayCategoryPath($ebayCheckoutSessionItem)
    {
        $this->catchCategoryIds = [];
        $feederCategoriesTable = TableRegistry::get('Feeder.FeederCategories');
        $ebayCategoriesTable = TableRegistry::get('Ebay.EbayCategories');

        if(!empty($ebayCheckoutSessionItem)) {
            $ebayCategoryFullPath = $ebayCategoriesTable->getFullCategoryTreeWithIds($ebayCheckoutSessionItem->ebay_category_path);

            if(!empty($ebayCategoryFullPath)) {
                $ebayCategories = explode('>>', $ebayCategoryFullPath);

                foreach($ebayCategories as $categoryId)
                {
                    $item_id = ($ebayCheckoutSessionItem->ebay_item_id === null) ? null : $ebayCheckoutSessionItem->ebay_item_id;

                    if($item_id !== null)
                    {
                        $item_id = preg_match('/v1|/', $ebayCheckoutSessionItem->ebay_item_id) ? explode('|', $ebayCheckoutSessionItem->ebay_item_id)[1] : $ebayCheckoutSessionItem->ebay_item_id;
                        $item_id = '%' . $item_id . '%';
                    }

                    $feederCategories = $feederCategoriesTable->find('list', [
                        'keyField' => 'id',
                        'valueField' => 'id'
                    ])->find('all', [
                        'conditions' => [
                            'OR' => [
                                'FeederCategories.ebay_category_id LIKE' => '%'. $categoryId .'%',
                                'FeederCategories.item_id LIKE' => $item_id
                            ],
                            'AND' => [
                                'FeederCategories.price_from <=' => $ebayCheckoutSessionItem->base_price_value,
                                'FeederCategories.price_to >=' => $ebayCheckoutSessionItem->base_price_value
                            ]
                        ]
                    ])->toArray();

                    $this->catchCategoryIds = array_merge($feederCategories, $this->catchCategoryIds);
                }
            }
        }
        return $this->catchCategoryIds;
    }
}
