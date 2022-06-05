<?php
namespace ItoolCustomer\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use ItoolCustomer\Model\Entity\Customer;
use Cake\ORM\TableRegistry;
use ItoolCustomer\Model\Entity\CustomerWishlistItem;

/**
 * Wishlist component
 */
class WishlistComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param Customer $customer
     * @param string $ebay_item_id
     * @return array
     */
    public function addItemToWishlist($customer, $ebayItemId)
    {
        $searchRequest = new SearchItemsRequest();
        $searchItemFilter = new SearchItemFilter();
        $searchItemFilter->setEbayGlobalId('EBAY-DE');
        if (strpos($ebayItemId, 'v1') === 0) {
            $searchItemFilter->setItemId($ebayItemId);
        } else {
            $searchItemFilter->setItemLegacyId($ebayItemId);
        }
        $searchRequest->setSearchItemFilter($searchItemFilter);
        $session = new Session();
        $session->setRequest($searchRequest);
        $session->setAccessToken(Configure::read('eis.token'));
        $response = $session->sendRequest();
        if ($response && !empty($response->Result[0])) {
            $item = $response->Result[0];
            $this->CustomerWishlistItems = TableRegistry::get ('ItoolCustomer.CustomerWishlistItems');
            $wishlistItem = $this->CustomerWishlistItems->find('all')->where([
                'customer_id' => $customer->id,
                'ebay_item_id' => $ebayItemId
            ])->first();
            /** @var CustomerWishlistItem $wishlistItem */
            if (!$wishlistItem) {
                $wishlistItem = $this->CustomerWishlistItems->newEntity();
            }
            $wishlistItem->ebay_item_id = $ebayItemId;
            $wishlistItem->customer_id = $customer->id;
            $wishlistItem->name = $item->title ?? '';
            $wishlistItem->image = $item->image_url ?? '';
            $wishlistItem->eek = $item->energy_efficiency ?? null;
            $wishlistItem->delivery_duration_de = $item->delivery_duration_de ?? null;
            $wishlistItem->delivery_cost_de = $item->delivery_cost_de ?? null;
            $wishlistItem->original_price = $item->original_price ?? null;
            $wishlistItem->quantity = $item->quantity ?? null;
            $wishlistItem->price = $item->price ?? 0;
            $wishlistItem->currency = $item->currency ?? '';
            $wishlistItem->seller = $item->seller_username;
            $wishlistItem->category_id = $item->category_id;
            if ($this->CustomerWishlistItems->save($wishlistItem)) {
                return $wishlistItem;
            }
        }
        return false;
    }
}
