<?php

namespace EbayCheckout\Model\Table;

use App\Application;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;

/**
 * EbayCheckoutSessionItems Model
 *
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable|\Cake\ORM\Association\BelongsTo $EbayCheckoutSessions
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionItemShippingsTable|\Cake\ORM\Association\BelongsTo $SelectedEbayCheckoutSessionItemShippings
 * @property |\Cake\ORM\Association\HasMany $EbayCheckoutSessionItemPromotions
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionItemShippingsTable|\Cake\ORM\Association\HasMany $EbayCheckoutSessionItemShippings
 *
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem get($primaryKey, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem newEntity($data = null, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem[] newEntities(array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem[] patchEntities($entities, array $data, array $options = [])
 * @method \EbayCheckout\Model\Entity\EbayCheckoutSessionItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EbayCheckoutSessionItemsTable extends Table
{
    /**
     * Searchable columns
     *
     * @var array
     *
     */
    public $filterArgs = [
        'legacy_order_id' => [
            'type' => 'like',
            'before' => true,
            'after' => true,
        ],
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ebay_checkout_session_items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Search.Searchable');

        $this->addBehavior('SoftDelete'); // because of WD-1187

        $this->belongsTo('EbayCheckoutSessions', [
            'foreignKey' => 'ebay_checkout_session_id',
            'joinType' => 'INNER',
            'className' => 'EbayCheckout.EbayCheckoutSessions'
        ]);
        $this->belongsTo('SelectedEbayCheckoutSessionItemShippings', [
            'foreignKey' => 'selected_ebay_checkout_session_item_shipping_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionItemShippings'
        ]);
        $this->hasMany('EbayCheckoutSessionItemPromotions', [
            'foreignKey' => 'ebay_checkout_session_item_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionItemPromotions'
        ]);
        $this->hasMany('EbayCheckoutSessionItemShippings', [
            'foreignKey' => 'ebay_checkout_session_item_id',
            'className' => 'EbayCheckout.EbayCheckoutSessionItemShippings'
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
            ->allowEmpty('title');

        $validator
            ->allowEmpty('short_description');

        $validator
            ->allowEmpty('base_price_currency');

        $validator
            ->decimal('base_price_value')
            ->allowEmpty('base_price_value');

        $validator
            ->allowEmpty('image');

        $validator
            ->allowEmpty('net_price_currency');

        $validator
            ->decimal('net_price_value')
            ->allowEmpty('net_price_value');

        $validator
            ->integer('quantity')
            ->allowEmpty('quantity');

        $validator
            ->allowEmpty('seller_username');

        $validator
            ->allowEmpty('seller_account_type');

        $validator
            ->allowEmpty('seller_feedback_score');

        $validator
            ->allowEmpty('seller_feedback_percentage');

        $validator
            ->allowEmpty('attributes');

        $validator
            ->allowEmpty('is_deleted');

        $validator
            ->allowEmpty('original_price_value');

        $validator
            ->allowEmpty('tags');

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
        $rules->add($rules->existsIn(['ebay_checkout_session_id'], 'EbayCheckoutSessions'));
        return $rules;
    }

    /**
     * @param string|array|null $ebayCategoryPath
     * @param int $limit
     * @param int $page
     * @param int $sellPeriodInDays
     * @return array|mixed
     */
    public function getTopSoldList(int $limit = 10, int $page = 1, int $sellPeriodInDays = 7, $ebayCategoryPath = null)
    {
        $eisApiToken = Configure::read('eis.token');
        $cacheKey = Text::slug('top_sold_list_' . ($ebayCategoryPath ?: '') . '_' . $limit . '_' . $page . '_' . $sellPeriodInDays);

        $soldItems = Cache::read($cacheKey, Application::SHORT_TERM_CACHE);

        if ($soldItems === false) {
            $soldItems = [];
            $tmpPage = 1;
            $totalCount = $limit * $page;

            do {
                $checkoutSessionItems = $this->getTopSoldCheckoutSessionItems($limit, $tmpPage++, $sellPeriodInDays, $ebayCategoryPath);

                $itemOfferIds = [];
                foreach ($checkoutSessionItems as $checkoutSessionItem) {
                    $ebayItemId = explode('|', $checkoutSessionItem->grouped_ebay_item_id);
                    if (isset($ebayItemId[1]) && is_numeric($ebayItemId[1])) {
                        $itemOfferIds[] = trim($ebayItemId[1]);
                    }
                }

                if (!empty($itemOfferIds)) {
                    $searchItemFilter = (new SearchItemFilter())
                        ->setEbayGlobalId('EBAY-DE')
                        ->setItemLegacyIds($itemOfferIds)
                        ->setQuantityFrom(1);

                    $searchRequest = (new SearchItemsRequest())
                        ->setSearchItemFilter($searchItemFilter);

                    $response = (new Session())
                        ->setRequest($searchRequest)
                        ->setAccessToken($eisApiToken)
                        ->sendRequest();

                    if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                        $items = $response->Result ?? [];
                        foreach ($items as $item) {
                            if (count($soldItems) >= $totalCount) {
                                break;
                            }
                            $soldItems[] = $item;
                        }
                    }
                }
            } while (count($soldItems) < $totalCount && !empty($checkoutSessionItems));

            $soldItems = array_slice($soldItems, ($limit * ($page - 1)), $limit);

            Cache::write($cacheKey, $soldItems, Application::SHORT_TERM_CACHE);
        }
        return $soldItems;
    }

    /**
     * @param string|array|null $ebayCategoryPath
     * @param int $limit
     * @param int $page
     * @param int $sellPeriodInDays
     * @return array|mixed
     */
    public function getTopSoldCheckoutSessionItems(int $limit = 10, int $page = 1, int $sellPeriodInDays = 7, $ebayCategoryPath = null)
    {
        $cacheKey = 'topSoldItems_Limit' . $limit . 'Page' . $page . 'Period' . $sellPeriodInDays . 'Cat' . md5(serialize($ebayCategoryPath));
        $checkoutSessionItemsQuery = $this->find()
            ->where([
                'EbayCheckoutSessions.purchase_order_id IS NOT' => null,
                'EbayCheckoutSessions.modified >' => date('Y-m-d H:i:s', strtotime('-' . $sellPeriodInDays . ' days'))
            ])
            ->matching('EbayCheckoutSessions')
            ->limit($limit)
            ->page($page);

        $checkoutSessionItems = $checkoutSessionItemsQuery
            ->select([
                'grouped_ebay_item_id' => 'SUBSTRING_INDEX(EbayCheckoutSessionItems.ebay_item_id, "|", 2)',
                'sold_count' => $checkoutSessionItemsQuery->func()->count('EbayCheckoutSessions.id')
            ])
            ->group(['SUBSTRING_INDEX(EbayCheckoutSessionItems.ebay_item_id, "|", 2)'])
            ->order([
                'sold_count' => 'DESC',
                'grouped_ebay_item_id' => 'DESC'
            ]);

        if (!empty($ebayCategoryPath)) {
            if (!is_array($ebayCategoryPath)) {
                $checkoutSessionItems = $checkoutSessionItems->where([
                    'EbayCheckoutSessionItems.ebay_category_path LIKE' => '%' . $ebayCategoryPath . '%'
                ]);
            } else {
                $likeConditions = [];
                foreach ($ebayCategoryPath as $thisCategoryPath) {
                    $likeConditions[] = ['EbayCheckoutSessionItems.ebay_category_path LIKE' => '%' . $thisCategoryPath . '%'];
                }
                $checkoutSessionItems = $checkoutSessionItems->where(['OR' => $likeConditions]);
            }
        }
        return $checkoutSessionItems->cache($cacheKey, Application::SHORT_TERM_CACHE)->toArray();
    }

    /**
     * @param int $sellPeriodInDays
     * @return array
     */
    public function getSoldItemsCategories($sellPeriodInDays = 7)
    {
        $categoryPaths = $this->find('list', ['valueField' => 'ebay_category_path', 'keyField' => 'ebay_category_path'])
            ->where([
                'EbayCheckoutSessions.purchase_order_id IS NOT' => null,
                'EbayCheckoutSessions.modified >' => date('Y-m-d H:i:s', strtotime('-' . $sellPeriodInDays . ' days'))
            ])
            ->matching('EbayCheckoutSessions')
            ->cache('get_sold_item_categories_for_' . $sellPeriodInDays, Application::SHORT_TERM_CACHE)
            ->group('ebay_category_path')
            ->toArray();

        if (empty($categoryPaths)) {
            return [];
        }

        $categoryPaths = array_values($categoryPaths);

        foreach ($categoryPaths as &$categoryPath) {
            $categoryPath = explode('|', $categoryPath);
        }
        $categories = array_unique(array_merge(...$categoryPaths));
        return $categories;
    }

    public function searchItemWithGtin($gtin)
    {
        $searchItemsRequest = new SearchItemsRequest();

        /** @var SearchItemFilter[] $searchItemFilters */
        $searchItemFilters = [
            (new SearchItemFilter())->setGtin($gtin),
            (new SearchItemFilter())->setInferredGtin($gtin),
            (new SearchItemFilter())->setFullTextSearch($gtin)
        ];

        $this->appendAdditionalSearchItemFilters($searchItemsRequest, $searchItemFilters);

        $response = (new Session())
            ->setRequest($searchItemsRequest->setLimit(50))
            ->setAccessToken(Configure::read('eis.token'))
            ->sendRequest();

        $this->sortOffersByAvailability($response->Result);

        return $response->Result[0]->item_id ?? $response->Result[0]->ebay_offer_id ?? '';
    }

    public function searchItemWithEpid($epid)
    {
        $searchItemsRequest = new SearchItemsRequest();

        /** @var SearchItemFilter[] $searchItemFilters */
        $searchItemFilters = [
            (new SearchItemFilter())->setEpid($epid),
            (new SearchItemFilter())->setInferredEpid($epid),
            (new SearchItemFilter())->setFullTextSearch($epid)
        ];

        $this->appendAdditionalSearchItemFilters($searchItemsRequest, $searchItemFilters);

        $response = (new Session())
            ->setRequest($searchItemsRequest->setLimit(50))
            ->setAccessToken(Configure::read('eis.token'))
            ->sendRequest();

        $this->sortOffersByAvailability($response->Result);

        return $response->Result[0]->item_id ?? $response->Result[0]->ebay_offer_id ?? '';
    }

    protected function appendAdditionalSearchItemFilters(SearchItemsRequest $searchItemsRequest, array $searchItemFilters)
    {
        $newSearchItemFilters = [];
        foreach ($searchItemFilters as $searchItemFilter) {
            $searchItemFilter->setEbayGlobalId('EBAY-DE');
            $searchItemsRequest->appendSearchItemFilter($searchItemFilter);
            $newSearchItemFilter = (clone $searchItemFilter)->setIsGuestCheckoutEnabled(false);
            $searchItemsRequest->appendSearchItemFilter($newSearchItemFilter);
            $newSearchItemFilters[] = $newSearchItemFilter;
        }

        $searchItemFilters = array_merge($searchItemFilters, $newSearchItemFilters);
        $newSearchItemFilters = [];
        foreach ($searchItemFilters as $searchItemFilter) {
            $newSearchItemFilter = (clone $searchItemFilter)->setEndDateFrom(new \DateTime('- 6 months'));
            $searchItemsRequest->appendSearchItemFilter($newSearchItemFilter);
            $newSearchItemFilters[] = $newSearchItemFilter;
        }

        $searchItemFilters = array_merge($searchItemFilters, $newSearchItemFilters);
        $newSearchItemFilters = [];
        foreach ($searchItemFilters as $searchItemFilter) {
            $searchItemsRequest
                ->appendSearchItemFilter((clone $searchItemFilter)
                    ->setAvailability('TEMPORARILY_UNAVAILABLE'))
                ->appendSearchItemFilter((clone $searchItemFilter)
                    ->setAvailability('UNAVAILABLE'));
        }
    }

    public function sortOffersByAvailability(array &$offers)
    {
        usort($offers, function ($offer1, $offer2) {
            $availablities = [
               'UNAVAILABLE' => 0, 'TEMPORARILY_UNAVAILABLE' => 1, 'AVAILABLE' => 2
            ];

            $offer1Availability = $availablities[$offer1->availability ?? 'UNAVAILABLE'] ?? 0;
            $offer2Availability = $availablities[$offer2->availability ?? 'UNAVAILABLE'] ?? 0;
            $offer1IsGuestCheckoutEnabled = $offer1->is_guest_checkout_enabled ?? 0;
            $offer2IsGuestCheckoutEnabled = $offer2->is_guest_checkout_enabled ?? 0;

            if ($offer1Availability > $offer2Availability) {
                return -1;
            } else if ($offer1Availability < $offer2Availability) {
                return 1;
            }

            if ($offer1IsGuestCheckoutEnabled > $offer2IsGuestCheckoutEnabled) {
                return -1;
            } else if ($offer1IsGuestCheckoutEnabled < $offer2IsGuestCheckoutEnabled) {
                return 1;
            }

            if (($offer1->score ?? 0) > ($offer2->score ?? 0)) {
                return -1;
            } else if (($offer1->score ?? 0) < ($offer2->score ?? 0)) {
                return 1;
            }
            return 0;
        });

        return $offers;
    }
}
