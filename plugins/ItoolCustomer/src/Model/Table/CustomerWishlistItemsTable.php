<?php

namespace ItoolCustomer\Model\Table;

use Cake\Core\Configure;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Entity\CustomerWishlistItem;

/**
 * CustomerWishlists Model
 *
 * @property \ItoolCustomer\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem get($primaryKey, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem newEntity($data = null, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem[] newEntities(array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem[] patchEntities($entities, array $data, array $options = [])
 * @method \ItoolCustomer\Model\Entity\CustomerWishlistItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomerWishlistItemsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('customer_wishlist_items');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('SoftDelete');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
            'className' => 'ItoolCustomer.Customers'
        ]);
        $this->belongsTo('EbayItems', [
            'foreignKey' => 'ebay_item_id',
            'joinType' => 'INNER',
            'className' => 'ItoolCustomer.EbayItems'
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
            ->maxLength('name', 500)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('image')
            ->maxLength('image', 500)
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->scalar('seller')
            ->maxLength('seller', 500)
            ->requirePresence('seller', 'create')
            ->notEmpty('seller');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 200)
            ->requirePresence('currency', 'create')
            ->notEmpty('currency');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }

    /**
     * @param Customer|bool $customer
     * @return array
     */
    public function getWishlistItemsForCustomer($customer = false)
    {
        if (!$customer) {
            return [];
        }

        if(!is_object($customer)){
            $customer = (object)$customer;
        }

        $wishlistItemArray = [];
        if ($customer && $customer->id ?? false) {
            $wishlistItems = $this->find('all')->where(['customer_id' => $customer->id]);
            foreach ($wishlistItems as $wishlistItem) {
                /** @var CustomerWishlistItem $wishlistItem */
                $wishlistItemArray[$wishlistItem->ebay_item_id] = true;
                $wishlistItemArray['image'] = [$wishlistItem->image];
            }
        }
        return $wishlistItemArray;
    }

    /**
     * @param $customer
     */
    public function updateWishlistItems($customer)
    {
        $this->removeBehavior('SoftDelete');
        $itemIds = $this->find('list', ['valueField' => 'ebay_item_id'])->where(['customer_id' => $customer->id])->toArray();
        $this->addBehavior('SoftDelete');

        if (!empty($itemIds)) {
            $groupIds = array_filter($itemIds, 'is_numeric');
            $variantIds = array_diff($itemIds, $groupIds);

            $offerIds = $groupIds;
            foreach ($variantIds as $variantId) {
                $offerIds[] = explode('|', $variantId)[1];
            }

            $searchRequest = new SearchItemsRequest();
            $searchRequest->setLimit(500);

            if (!empty($groupIds)) {
                $searchItemFilter = new SearchItemFilter();
                $searchItemFilter->setEbayGlobalId('EBAY-DE');
                $searchItemFilter->setItemLegacyIds($groupIds);
                $searchItemFilter->setQuantityFrom(1);
                $searchRequest->appendSearchItemFilter($searchItemFilter);
            }

            if (!empty($variantIds)) {
                $searchItemFilter = new SearchItemFilter();
                $searchItemFilter->setEbayGlobalId('EBAY-DE');
                $searchItemFilter->setItemIds($variantIds);
                $searchItemFilter->setQuantityFrom(1);
                $searchRequest->appendSearchItemFilter($searchItemFilter);
            }

            $session = new Session();
            $session->setRequest($searchRequest);
            $session->setAccessToken(Configure::read('eis.token'));
            $response = $session->sendRequest();

            if (isset($response->Result) || (isset($response->Status) && $response->Status == 'Success')) {
                $items = $response->Result ?? [];
                foreach ($items as $item) {
                    $offerId = $item->ebay_offer_id;

                    if (strtotime($item->end_date) < time()) {
                        $this->deleteAll(['ebay_item_id LIKE' => '%' . $offerId . '%']);
                    }

                    $this->updateAll([
                        'name' => $item->title ?? '',
                        'image' => $item->image_url ?? '',
                        'eek' => $item->energy_efficiency ?? null,
                        'delivery_duration_de' => $item->delivery_duration_de ?? null,
                        'delivery_cost_de' => $item->delivery_cost_de ?? null,
                        'original_price' => $item->original_price ?? null,
                        'category_id' => $item->category_id ?? null,
                        'quantity' => $item->quantity ?? null,
                        'price' => $item->price ?? 0,
                        'currency' => $item->currency ?? '',
                        'seller' => $item->seller_username,
                        'is_deleted' => false,
                        'modified' => date('Y-m-d H:i:s')
                    ], [
                        'ebay_item_id LIKE' => '%' . $offerId . '%'
                    ]);
                    $offerIds = array_diff($offerIds, [$offerId]);
                }

                if (!empty($offerIds)) {
                    foreach ($offerIds as $offerId) {
                        $this->updateAll([
                            'is_deleted' => true
                        ], [
                            'ebay_item_id LIKE' => '%' . $offerId . '%'
                        ]);
                    }
                }
            }
        }

        $this->deleteAll([
            'modified <' => date('Y-m-d H:i:s', strtotime('-2 months')),
            'customer_id' => $customer->id
        ]);
    }
}
