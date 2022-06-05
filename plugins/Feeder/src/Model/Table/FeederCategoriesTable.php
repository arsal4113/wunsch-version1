<?php

namespace Feeder\Model\Table;

use App\Application;
use App\Traits\DbCacheTrait;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Request;
use Cake\I18n\Number;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use EbayCheckout\Model\Table\EbayCheckoutSessionItemsTable;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Security\Session;
use EisSdk\Request\SearchItemsRequest;
use Feeder\Model\Entity\FeederCategory;

/**
 * FeederCategories Model
 *
 * @property \Feeder\Model\Table\FeederCategoriesTable|\Cake\ORM\Association\BelongsTo $ParentFeederCategories
 * @property \Feeder\Model\Table\FeederCategoriesTable|\Cake\ORM\Association\HasMany $ChildFeederCategories
 * @property \App\Model\Table\CoreCountriesTable|\Cake\ORM\Association\BelongsToMany $CoreCountries
 * @property \Feeder\Model\Table\FeederCategoriesVideoElementsTable|\Cake\ORM\Association\BelongsTo $FeederCategoriesVideoElements
 *
 * @method \Feeder\Model\Entity\FeederCategory get($primaryKey, $options = [])
 * @method \Feeder\Model\Entity\FeederCategory newEntity($data = null, array $options = [])
 * @method \Feeder\Model\Entity\FeederCategory[] newEntities(array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Feeder\Model\Entity\FeederCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \Feeder\Model\Entity\FeederCategory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class FeederCategoriesTable extends Table
{
    const CATEGORY_TYPE_ARTICLE_IDS = 'Article Ids';
    const CATEGORY_TYPE_EBAY_CATEGORIES = 'Ebay Categories';
    const CATEGORY_TYPE_TOP_SELLERS = 'Top Sellers';

    const TEMPLATE_TYPE_A = 'Template A';
    const TEMPLATE_TYPE_B = 'Template B';

    use DbCacheTrait;

    public $filterArgs = [
        'id' => [
            'type' => 'value'
        ],
        'name' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
    ];

    /**
     * @var FeederCategory[]
     */
    protected $customerSegments = [];

    /**
     * @var FeederCategory[]
     */
    protected $childCategories = [];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('feeder_categories');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Searchable');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree', [
            'level' => 'level'
        ]);

        $this->belongsTo('ParentFeederCategories', [
            'className' => 'Feeder.FeederCategories',
            'foreignKey' => 'parent_id'
        ]);

        $this->hasMany('ChildFeederCategories', [
            'className' => 'Feeder.FeederCategories',
            'foreignKey' => 'parent_id',
            'sort' => ['sort_order' => 'ASC']
        ]);

        $this->belongsToMany('FeederHeroItems', [
            'foreignKey' => 'feeder_category_id',
            'targetForeignKey' => 'feeder_hero_item_id',
            'joinTable' => 'feeder_categories_feeder_hero_items',
            'className' => 'Feeder.FeederHeroItems',
            'sort' => ['FeederHeroItems.sort_order' => 'ASC']
        ]);
        $this->belongsToMany('FeederGuides', [
            'foreignKey' => 'feeder_category_id',
            'targetForeignKey' => 'feeder_guide_id',
            'joinTable' => 'feeder_guides_feeder_categories',
            'className' => 'Feeder.FeederGuides'
        ]);
        $this->belongsToMany('CoreCountries', [
            'foreignKey' => 'feeder_category_id',
            'targetForeignKey' => 'core_country_id',
            'joinTable' => 'feeder_categories_core_countries'
        ]);
        $this->belongsTo('FeederCategoriesVideoElements', [
            'foreignKey' => 'feeder_categories_video_element_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 510)
            ->allowEmpty('name');

        $validator
            ->scalar('url_path')
            ->maxLength('url_path', 1000)
            ->notEmpty('url_path');

        $validator
            ->scalar('item_id')
            ->maxLength('item_id', 10000)
            ->allowEmpty('item_id');

        $validator
            ->scalar('seller_trusted_level')
            ->maxLength('seller_trusted_level', 510)
            ->allowEmpty('seller_trusted_level');

        $validator
            ->scalar('gtin')
            ->maxLength('gtin', 510)
            ->allowEmpty('gtin');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 510)
            ->allowEmpty('keywords');

        $validator
            ->scalar('exclude_keywords')
            ->maxLength('exclude_keywords', 510)
            ->allowEmpty('exclude_keywords');

        $validator
            ->scalar('ebay_category_id')
            ->maxLength('ebay_category_id', 510)
            ->allowEmpty('ebay_category_id');

        $validator
            ->scalar('seller_account_type')
            ->maxLength('seller_account_type', 510)
            ->allowEmpty('seller_account_type');

        $validator
            ->scalar('listing_type')
            ->maxLength('listing_type', 510)
            ->allowEmpty('listing_type');

        $validator
            ->scalar('items_condition')
            ->maxLength('items_condition', 510)
            ->allowEmpty('items_condition');

        $validator
            ->scalar('include_seller')
            ->maxLength('include_seller', 1020)
            ->allowEmpty('include_seller');

        $validator
            ->scalar('exclude_seller')
            ->maxLength('exclude_seller', 1020)
            ->allowEmpty('exclude_seller');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->decimal('price_from')
            ->allowEmpty('price_from');

        $validator
            ->decimal('price_to')
            ->allowEmpty('price_to');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmpty('sort_order');

        $validator
            ->dateTime('start_time')
            ->allowEmpty('start_time');

        $validator
            ->dateTime('end_time')
            ->allowEmpty('end_time');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['parent_id'], 'ParentFeederCategories'));
        return $rules;
    }

    /**
     * @param $categoryId
     * @return bool|FeederCategory
     */
    public function getCustomerSegment($categoryId)
    {
        if ($this->buildCustomerSegmentsAndChildCategories($categoryId)) {
            return $this->customerSegments[$categoryId];
        }
        return false;
    }

    /**
     * @param $categoryId
     * @return bool|FeederCategory
     */
    public function getChildCategories($categoryId)
    {
        if ($this->buildCustomerSegmentsAndChildCategories($categoryId)) {
            return $this->childCategories[$categoryId];
        }
        return false;
    }

    /**
     *
     * @param $categoryId
     * @return bool
     */
    protected function buildCustomerSegmentsAndChildCategories($categoryId)
    {
        if (!empty($this->customerSegments[$categoryId]) && !empty($this->childCategories[$categoryId])) {
            return true;
        }

        if ($categoryId === null) {
            /** @var FeederCategory $feederCategory */
            $feederCategory = $this->find('all')
                ->contain(['ChildFeederCategories'])
                ->where(['FeederCategories.parent_id IS' => null])
                ->orderAsc('sort_order')
                ->cache('buildCustomerSegmentsAndChildCategories', Application::MEDIUM_TERM_CACHE)
                ->first();
            if (!empty($feederCategory->child_feeder_categories)) {
                $this->customerSegments[$categoryId] = $feederCategory;
                $this->childCategories[$categoryId] = $feederCategory->child_feeder_categories;
            }
        } else {
            $feederCategory = $this->find('all')
                ->contain([
                    'ChildFeederCategories',
                    'ParentFeederCategories',
                    'ParentFeederCategories.ChildFeederCategories'
                ])
                ->where(['FeederCategories.id' => $categoryId])
                ->cache('buildCustomerSegmentsAndChildCategories' . $categoryId, Application::MEDIUM_TERM_CACHE)
                ->first();
            if (isset($feederCategory->child_feeder_categories[0])) {
                $this->childCategories[$categoryId] = $feederCategory->child_feeder_categories;
                $this->customerSegments[$categoryId] = $feederCategory;
            } elseif (!empty($feederCategory->parent_feeder_category->child_feeder_categories)) {
                $this->childCategories[$categoryId] = $feederCategory->parent_feeder_category->child_feeder_categories;
                $this->customerSegments[$categoryId] = $feederCategory->parent_feeder_category;
            }
        }

        if (empty($this->customerSegments[$categoryId]) || empty($this->childCategories[$categoryId])) {
            return false;
        }
        return true;
    }

    /**
     * Randomize items
     * @param $items
     * @param $itemCountToRandomize
     * @param $randomSkip
     * @return mixed
     */
    public function randomize($items, $itemCountToRandomize, $randomSkip = 0)
    {
        $noRandomArray = [];
        if ($randomSkip != 0 && count($items) >= $randomSkip) {
            for ($i = 0; $i < $randomSkip; $i++) {
                $noRandomArray[$i] = $items[$i];
                unset($items[$i]);
            }
        }

        $itemCount = count($items);
        if ($itemCount <= $itemCountToRandomize) {
            shuffle($items);
            if (!empty($noRandomArray)) {
                for ($i = 1; $i <= $randomSkip; $i++) {
                    array_unshift($items, $noRandomArray[$randomSkip - $i]);
                }
            }
            return $items;
        }

        $itemsChunks = array_chunk($items, $itemCountToRandomize);

        shuffle($itemsChunks[0]);

        $items = [];
        foreach ($itemsChunks as $itemsChunk) {
            $items = array_merge($items, $itemsChunk);
        }
        if (!empty($noRandomArray)) {
            for ($i = 1; $i <= $randomSkip; $i++) {
                array_unshift($items, $noRandomArray[$randomSkip - $i]);
            }
        }
        return $items;
    }

    /**
     * @param $id
     * @param Request $request
     * @param bool $withCache
     * @return array|mixed
     */
    public function getFeederCategoryWithItems($id, Request $request, $withCache = true)
    {
        $categoryWithItems = null;
        $filter = $this->getFilterValues($request);
        $cacheKey = 'feeder_browse_model_' . $id . '_' . md5(json_encode($filter));
        if ($withCache) {
            $categoryWithItems = Cache::read($cacheKey, Application::SHORT_TERM_CACHE);
        }

        if (!$categoryWithItems) {
            $customerSegmentSelected = false;
            $parentFeederCategory = null;
            $feederCategory = null;
            $smallBannerSlots = [];
            $smallShownBanners = [];
            $largeBannerSlots = [];
            $largeShownBanners = [];
            $itemCount = null;
            $bannerPage = null;

            $feederCategoryData = $this->getFeederCategoryData($id);

            if (isset($feederCategoryData['feeder_category'])) {
                /** @var FeederCategory $feederCategory */
                $feederCategory = $feederCategoryData['feeder_category'];
            }

            if (isset($feederCategoryData['customer_segment_selected'])) {
                $customerSegmentSelected = $feederCategoryData['customer_segment_selected'];
            }

            if (!$feederCategory) {
                throw new NotFoundException('Not found');
            }

            $ebaySiteCurrency = 'EUR';

            $searchRequest = new SearchItemsRequest();
            $searchItemFilter = new SearchItemFilter();
            $searchItemFilter->setEbayGlobalId('EBAY-DE');
            $searchItemFilter->setConditionId($feederCategory->items_condition ?? 1000);

            if ($filter['search'] && $customerSegmentSelected) {
                $searchFeederCategories = $this->find()
                    ->contain(['ChildFeederCategories', 'CoreCountries'])
                    ->where(['FeederCategories.use_in_search = ' => 1])
                    ->orderAsc('sort_order')
                    ->all()
                    ->toArray();

                foreach ($searchFeederCategories as $searchFeederCategory) {
                    $searchItemFilter->setCategoryIds(explode(';', str_replace(',', ';', $searchFeederCategory->ebay_category_id)));
                    if (isset($searchFeederCategory->core_countries) && !empty($searchFeederCategory->core_countries)) {
                        foreach ($searchFeederCategory->core_countries as $coreCountry) {
                            $searchItemFilter->setItemLocationCountry($coreCountry->iso_code_3166_2 ?? $coreCountry->iso_code);
                        }
                    }
                }
            } else {
                if (isset($feederCategory->core_countries) && !empty($feederCategory->core_countries)) {
                    foreach ($feederCategory->core_countries as $coreCountry) {
                        $searchItemFilter->setItemLocationCountry($coreCountry->iso_code_3166_2 ?? $coreCountry->iso_code);
                    }
                }
            }

            $searchItemFilter->setSellerIncludes(explode(';', str_replace(',', ';', ($feederCategory->include_seller ?? ''))));
            $searchItemFilter->setSellerExcludes(explode(';', str_replace(',', ';', ($feederCategory->exclude_seller ?? ''))));
            $searchItemFilter->setCurrency($ebaySiteCurrency);
            $searchItemFilter->setPriceFrom((is_numeric($filter['upper']) && $filter['upper'] >= $feederCategory->price_from) ? $filter['upper'] : $feederCategory->price_from);
            $searchItemFilter->setPriceTo((is_numeric($filter['under']) && $filter['under'] <= $feederCategory->price_to) ? $filter['under'] : $feederCategory->price_to);
            if ($feederCategory->only_with_sales_prices) {
                $searchItemFilter->setOriginalPriceFrom(0.1);
            }
            $searchItemFilter->setSellerTrustLevel($feederCategory->seller_trusted_level);
            $searchItemFilter = $this->addFilterToSearchRequest($searchItemFilter, $filter);

            $keywords = $feederCategory->keywords;

            $qty = empty($feederCategory->banner_products_factor) ? FeederHeroItemsTable::BANNER_PRODUCTS_FACTOR : $feederCategory->banner_products_factor;
            if (!empty($filter['search'])) {
                $keywords .= $filter['search'];
            } else {
                $smallBanners = [];
                $largeBanners = [];
                foreach ($feederCategory->feeder_hero_items ?? [] as $feederHeroItem) {
                    if (empty($feederHeroItem->is_active) && empty($feederHeroItem->url)) {
                        continue;
                    }
                    if ($feederHeroItem->type == 1) {
                        $smallBanners[] = $feederHeroItem;
                    } elseif ($feederHeroItem->type == 2) {
                        $largeBanners[] = $feederHeroItem;
                    }
                }

                $smallBannerPositions = null;
                $largeBannerPositions = null;
                if (empty($feederCategoryData['feeder_category']->banner_large_positions) &&
                    empty($feederCategoryData['feeder_category']->banner_small_positions)) {
                    $largeBannerPositions = FeederHeroItemsTable::BANNER_LARGE_POSITIONS;
                    $smallBannerPositions = FeederHeroItemsTable::BANNER_SMALL_POSITIONS;
                } else {
                    if (!empty($feederCategoryData['feeder_category']->banner_small_positions)) {
                        $smallBannerPositions = array_map('intval', explode(",", $feederCategoryData['feeder_category']->banner_small_positions));
                    }
                    if (!empty($feederCategoryData['feeder_category']->banner_large_positions)) {
                        $largeBannerPositions = array_map('intval', explode(",", $feederCategoryData['feeder_category']->banner_large_positions));
                    }
                }

                if ($smallBannerPositions != null || $largeBannerPositions != null) {
                    $bannerStartSlot = $this->getBannerStartSlot($qty, $filter['page'], $qty);

                    $slots = $this->getBannerSlots($qty, $bannerStartSlot, $smallBannerPositions, $largeBannerPositions, $qty, $smallBanners, $largeBanners);
                    $smallBannerSlots = $slots['smallBannerSlots'] ?? [];
                    $largeBannerSlots = $slots['largeBannerSlots'] ?? [];

                    $smallBannerShown = $this->getBannerShownCount($qty, $filter['page'], $smallBannerPositions, $qty);
                    $largeBannerShown = $this->getBannerShownCount($qty, $filter['page'], $largeBannerPositions, $qty);

                    if (!empty($smallBanners)) {
                        $smallShownBanners = $this->getShownBanners($smallBanners, $smallBannerShown, count($smallBannerSlots));
                    }

                    if (!empty($largeBanners)) {
                        $largeShownBanners = $this->getShownBanners($largeBanners, $largeBannerShown, count($largeBannerSlots));
                    }
                    if (!empty($smallBanners) || !empty($largeBanners)) {
                        $qty -= (count($smallBannerSlots) + (count($largeBannerSlots) * 2));
                    }
                }
            }

            if (!empty($smallBanners) || !empty($largeBanners)) {
                $itemCount = $qty + (count($smallBannerSlots) + (count($largeBannerSlots)));
            } else {
                $itemCount = $qty;
            }
            $searchRequest->setLimit($qty);
            $searchItemFilter->setFullTextSearchOr($keywords);
            if (!empty($feederCategory->exclude_keywords)) {
                $searchItemFilter->setFullTextSearchExcludes($feederCategory->exclude_keywords);
            }

            if ($feederCategory->category_type == self::CATEGORY_TYPE_ARTICLE_IDS) {
                $searchItemFilter->setItemLegacyIds(explode(';', str_replace(',', ';', $feederCategory->item_id)));
            } else if ($feederCategory->category_type == self::CATEGORY_TYPE_EBAY_CATEGORIES) {
                $searchItemFilter->setCategoryIds(explode(';', str_replace(',', ';', $feederCategory->ebay_category_id)));
            } else if ($feederCategory->category_type == self::CATEGORY_TYPE_TOP_SELLERS) {
                /** @var EbayCheckoutSessionItemsTable $EbayCheckoutSessionItems */
                $EbayCheckoutSessionItems = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckoutSessionItems');
                $page = is_numeric($filter['page']) ? (int)$filter['page'] : 1;
                $topSoldCheckoutSessionItems = $EbayCheckoutSessionItems->getTopSoldCheckoutSessionItems($qty, $page, 7, explode(';', $feederCategory->top_category_id));
                $topSoldOffers = [];
                foreach ($topSoldCheckoutSessionItems as $topSoldCheckoutSessionItem) {
                    $offerId = is_numeric($topSoldCheckoutSessionItem->grouped_ebay_item_id)
                        ? $topSoldCheckoutSessionItem->grouped_ebay_item_id
                        : explode('|', $topSoldCheckoutSessionItem->grouped_ebay_item_id)[1];
                    $topSoldOffers[$offerId] = $topSoldCheckoutSessionItem->sold_count;
                }
                $searchItemFilter->setItemLegacyIds(array_keys($topSoldOffers));
            }

            if (is_numeric($filter['page'])) {
                $searchRequest->setPage($filter['page']);
            }

            $searchRequest->setSearchItemFilter($searchItemFilter);

            $session = new Session();
            $session->setRequest($searchRequest);
            $session->setAccessToken(Configure::read('eis.token'));
            $response = $session->sendRequest();

            if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                $items = $response->Result ?? [];

                if (isset($topSoldOffers) && !empty($topSoldOffers)) {
                    usort($items, function ($a, $b) use ($topSoldOffers) {
                        return $topSoldOffers[$a->ebay_offer_id] < $topSoldOffers[$b->ebay_offer_id] ? -1
                            : $topSoldOffers[$a->ebay_offer_id] > $topSoldOffers[$b->ebay_offer_id] ? 1 : 0;
                    });
                }
                if ($feederCategory->sort_by_input_sequence && $feederCategory->category_type == self::CATEGORY_TYPE_ARTICLE_IDS) {
                    $itemIdsInputSequence = array_flip(array_filter(array_map('trim',
                        explode(';', str_replace(',', ';', $feederCategory->item_id)))));
                    usort($items, function ($item1, $item2) use ($itemIdsInputSequence) {
                       $item1Index = $itemIdsInputSequence[$item1->ebay_offer_id] ?? 666;
                       $item2Index = $itemIdsInputSequence[$item2->ebay_offer_id] ?? 666;
                       return $item1Index < $item2Index ? -1 : ($item1Index > $item2Index ? 1 : 0);
                    });
                } else if ($feederCategory->randomize) {
                    $randomItemCount = $feederCategory->randomize;
                    if (!empty($largeBannerSlots) || !empty($smallBannerSlots)) {
                        $itemCountWithoutHero = $feederCategory->banner_products_factor - (count($largeBannerSlots) * 2 + count($smallBannerSlots));
                        $randomPageCount = $randomItemCount / $itemCountWithoutHero;
                        if ($filter["page"] == ceil($randomPageCount)) {
                            $randomItemCount = $feederCategory->randomize - (floor($randomPageCount) * $itemCountWithoutHero);
                        } elseif ($filter["page"] > ceil($randomPageCount)) {
                            $randomItemCount = 0;
                        }
                    } else {
                        $randomItemCount -= ($filter["page"] - 1) * $feederCategory->banner_products_factor;
                    }
                    if ($randomItemCount > 0) {
                        $items = $this->randomize($items, $randomItemCount, $feederCategory->random_skip);
                    }
                }

                foreach ($items as &$item) {
                    //Ei caramba! @TODO: Rework
                    @$item->{"display_price"} = Number::currency($item->price, $item->currency);
                    @$item->{"display_original_price"} = null;
                    if (strpos($item->image_url, 'i.ebayimg.com') !== false) {
                        $urlArray = explode('/', $item->image_url);
                        $imageId = $urlArray[count($urlArray) - 2] ?? null;
                        if (strlen($imageId) > 6 && $imageId) {
                            @$item->{"thumbnail_url"} = 'https://i.ebayimg.com/images/g/' . $imageId . '/s-l300.jpg';
                        }
                    }
                }

                if (count($items) > 0) {
                    if (($smallBannerPositions != null || $largeBannerPositions != null) && $itemCount != $qty) {
                        $smallCount = 0;
                        $largeCount = 0;
                        $bannerArray = [];
                        for ($i = 0; $i <= count($items); $i++) {
                            if ($smallCount < count($slots['smallBannerSlots']) && $slots['smallBannerSlots'][$smallCount] == $i) {
                                $bannerArray['type'] = 'smallBanner';
                                array_splice($items, $i, 0, $bannerArray);
                                $smallCount++;
                            } else if ($largeCount < count($slots['largeBannerSlots']) && $slots['largeBannerSlots'][$largeCount] == $i) {
                                $bannerArray['type'] = 'largeBanner';
                                array_splice($items, $i, 0, $bannerArray);
                                $largeCount++;
                            }
                        }
                    }
                }

                $categoryWithItems = [
                    'items' => $items,
                    'feeder_category' => $feederCategory,
                    'customer_segment_selected' => $customerSegmentSelected,
                    'item_count' => $itemCount,
                    'banner_page' => $bannerPage,
                    'small_banner_slots' => $smallBannerSlots,
                    'small_shown_banners' => $smallShownBanners,
                    'large_banner_slots' => $largeBannerSlots,
                    'large_shown_banners' => $largeShownBanners,
                    'filter' => $filter
                ];
                Cache::write($cacheKey, $categoryWithItems, Application::SHORT_TERM_CACHE);
            }
        }
        return $categoryWithItems;
    }

    /**
     *
     * @param $id
     * @return array ['feeder_category' => $feederCategory, 'parent_feeder_category' => $parentFeederCategory, 'customer_segment_selected' => $customerSegmentSelected]
     */
    public function getFeederCategoryData($id)
    {
        $parentFeederCategory = $feederCategory = null;
        $customerSegmentSelected = false;

        if (!$id) {
            /** @var FeederCategory $feederCategory */
            $feederCategory = $this->find()
                ->contain([
                    'ChildFeederCategories',
                    'FeederHeroItems',
                    'ChildFeederCategories.FeederHeroItems',
                    'CoreCountries',
                    'FeederCategoriesVideoElements',
                    'ChildFeederCategories.FeederCategoriesVideoElements'
                ])
                ->cache('feeder_category_data_all', Application::SHORT_TERM_CACHE)
                ->where(['parent_id IS' => null])
                ->orderAsc('sort_order')
                ->first();
            if (!empty($feederCategory->child_feeder_categories)) {
                $parentFeederCategory = $feederCategory;
                $feederCategory = $feederCategory->child_feeder_categories[0];
                $customerSegmentSelected = true;
            }
        } else {
            $feederCategory = $this->find()
                ->where([
                    'FeederCategories.id' => $id
                ])
                ->contain([
                    'ChildFeederCategories',
                    'FeederHeroItems',
                    'ChildFeederCategories.FeederHeroItems',
                    'CoreCountries',
                    'FeederCategoriesVideoElements',
                    'ChildFeederCategories.FeederCategoriesVideoElements'
                ])
                ->cache('feeder_category_data_id_' . $id, Application::SHORT_TERM_CACHE)
                ->first();

            if (isset($feederCategory->child_feeder_categories[0]) && $feederCategory->level == 0) {
                $parentFeederCategory = $feederCategory;
                $customerSegmentSelected = true;
                $feederCategory = $feederCategory->child_feeder_categories[0];
            }
        }

        return [
            'feeder_category' => $feederCategory,
            'parent_feeder_category' => $parentFeederCategory,
            'customer_segment_selected' => $customerSegmentSelected
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getFilterValues(Request $request): array
    {
        $filter = [
            'page' => h($request->getQuery('page', 1)),
            'upper' => h($request->getQuery('upper', 0)),
            'under' => h($request->getQuery('under', null)),
            'search' => h($request->getQuery('search', '')),
            'free_shipping' => h($request->getQuery('free_shipping', 0)),
            'discounts' => h($request->getQuery('discounts', 0)),
            'fast_shipping' => h($request->getQuery('fast_shipping', 0)),
            'low_stock' => h($request->getQuery('low_stock', 0)),
            'top_rated' => h($request->getQuery('top_rated', 0)),
            'free_return' => h($request->getQuery('free_return', 0)),
        ];

        return $filter;
    }

    /**
     * @param $banner
     * @param $bannerShowCount
     * @param $page
     * @return array
     */
    public function getShownBanners($banner, $bannerShown, $bannerShowCount): array
    {
        $showBanners = [];
        $bannerCount = count($banner);

        for ($i = $bannerShown; $i < $bannerShown + $bannerShowCount; $i++) {
            $showBanners[] = $banner[$i % $bannerCount];
        }
        return $showBanners;
    }

    /**
     *
     * 'free_shipping' => $this->request->getQuery('free_shipping', 0),
     * 'discounts' => $this->request->getQuery('discounts', 0),
     * 'fast_shipping' => $this->request->getQuery('fast_shipping', 0),
     * 'low_stock' => $this->request->getQuery('low_stock', 0),
     * 'top_rated' => $this->request->getQuery('top_rated', 0),
     * 'free_return' => $this->request->getQuery('free_return', 0),
     * @param SearchItemFilter $searchItemFilter
     * @param array $filter
     * @return SearchItemFilter
     */
    public function addFilterToSearchRequest(SearchItemFilter $searchItemFilter, $filter): SearchItemFilter
    {
        $searchItemFilter->setDeliveryCostDeTo(20);

        if ($filter['free_shipping']) {
            $searchItemFilter->setDeliveryCostDeTo(0);
        }

        if ($filter['fast_shipping']) {

            $searchItemFilter->setDeliveryDurationDeTo(3);
            $searchItemFilter->setItemLocationCountries(['DE', 'GB']);
        }

        if ($filter['low_stock']) {
            $searchItemFilter->setQuantityTo(3);
        }

        if ($filter['top_rated']) {
            $searchItemFilter->setRatingFrom(4);
        }

        if ($filter['free_return']) {
            $searchItemFilter->setReturnShippingCostPayer('SELLER');
        }

        return $searchItemFilter;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterSave(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);

        $event = new Event('Model.FeederCategories.afterSave', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param \ArrayObject $options
     * @return bool
     */
    public function afterDelete(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        $this->clearCacheGroup(Application::DB_QUERY_CACHE_GROUP);

        $event = new Event('Model.FeederCategories.afterDelete', $this);
        $this->getEventManager()->dispatch($event);
        return true;
    }

    /**
     * @param $qty -> the size per page
     * @param $page -> the current page
     * @param $productFactor -> after this amount the banner positions repeat
     * @return float|int ->
     */
    public function getBannerStartSlot($qty, $page, $productFactor)
    {
        if (!$page || $page == 1) {
            return 0;
        }
        $fullItemCount = $qty * $page;
        $startItemCount = $fullItemCount - $qty;    //the first index of the new page

        $bannerPage = floor($startItemCount / $productFactor);  //this is 1 the first time the banners are repeated
        return $startItemCount - ($productFactor * $bannerPage);
    }

    /**
     * @param $bannerStartSlot
     * @param $positions
     * @return bool|int|string
     */
    public function getBannerStartKey($bannerStartSlot, $positions)
    {
        if ($positions != null) {
            foreach ($positions as $key => $position) {
                if ($position > $bannerStartSlot) {
                    return $key;
                }
            }
        }
        return false;
    }

    /**
     * @param $qty
     * @param $page
     * @param $positions
     * @param $productFactor
     * @return float|int
     */
    public function getBannerShownCount($qty, $page, $positions, $productFactor)
    {
        if (!$page || $page == 1) {
            return 0;
        }
        $fullItemCount = $qty * $page;
        $startItemCount = $fullItemCount - $qty;
        $bannerPage = floor($startItemCount / $productFactor);
        $bannerStartSlot = $this->getBannerStartSlot($qty, $page, $productFactor);

        $count = count($positions) * $bannerPage;
        if ($positions != null) {
            foreach ($positions as $key => $position) {
                if ($position < $bannerStartSlot) {
                    $count++;
                } else {
                    break;
                }
            }
        }
        return $count;
    }

    /**
     * @param $qty -> size per page, usually 30
     * @param $bannerStartSlot -> the starting id in the banner array (can be 30 or such, based on size of items per page (qty) and product Factor)
     * @param $smallPositions -> array with the positions of the small banners
     * @param $largePositions -> array with the positions of the large banners
     * @param $productFactor -> int after which the positions of the banners repeat (multiple of 60)
     * @param $smallBanners -> array containing the small hero banners created for the current category
     * @param $largeBanners -> array containing the large hero banners created for the current category
     * @return array
     *
     */
    public function getBannerSlots($qty, $bannerStartSlot, $smallPositions, $largePositions, $productFactor, $smallBanners, $largeBanners)
    {
        $smallKey = $this->getBannerStartKey($bannerStartSlot - 1, $smallPositions);
        $largeKey = $this->getBannerStartKey($bannerStartSlot - 1, $largePositions);

        $smallPositionCount = 0;
        $largePositionCount = 0;
        if ($smallPositions !== null) {
            $smallPositionCount = count($smallPositions);
        }

        if ($largePositions !== null) {
            $largePositionCount = count($largePositions);
        }

        $smallSlots = [];
        $largeSlots = [];
        $pageAdd = 0;
        $bannerPage = 0;
        if ($smallKey === false && $largeKey === false) {
            $pageAdd += $productFactor;
            $bannerPage = 1;
        }

        if ($smallKey === false) {
            $smallKey = 0;
        }
        if ($largeKey === false) {
            $largeKey = 0;
        }
        $bannerFactor = 0;
        for ($i = $bannerStartSlot; $i < $qty + $bannerStartSlot; $i++) {
            $itemIndex = $i - $productFactor * $bannerPage;
            if ($smallPositions !== null && $smallPositions[$smallKey] == $itemIndex && !empty($smallBanners)) {
                $smallSlots[] = $smallPositions[$smallKey] - $bannerStartSlot + $pageAdd - $bannerFactor;
                $smallKey++;
                if ($smallKey == $smallPositionCount) {
                    $smallKey = 0;
                }
            }
            if ($largePositions !== null && $largePositions[$largeKey] == $itemIndex && !empty($largeBanners)) {
                $largeSlots[] = $largePositions[$largeKey] - $bannerStartSlot + $pageAdd - $bannerFactor;
                $bannerFactor++;
                $largeKey++;
                if ($largeKey == $largePositionCount) {
                    $largeKey = 0;
                }
            }
            if ($i > 0 && $i % $productFactor === 0) {
                $pageAdd += $productFactor;
                $bannerPage++;
            }
        }

        return [
            'smallBannerSlots' => $smallSlots,
            'largeBannerSlots' => $largeSlots
        ];
    }
}
