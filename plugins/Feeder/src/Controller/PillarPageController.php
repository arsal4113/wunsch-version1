<?php
/**
 * Created by PhpStorm.
 * User: gero
 * Date: 19.03.19
 * Time: 10:49
 */

namespace Feeder\Controller;

use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\I18n\Number;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Table\FeederCategoriesTable;
use Feeder\Model\Table\FeederPillarPagesTable;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

/**
 * FeederPillarPage Controller
 *
 * @property CustomersTable $Customers
 * @property CustomerWishlistItemsTable $CustomerWishlistItems
 * @property \Feeder\Model\Table\FeederPillarPagesTable $FeederPillarPages
 */
class PillarPageController extends AppController
{
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \App\Controller\empty|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'index',
        ]);
    }

    /**
     * BeforeRender
     *
     * @param Event $event
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $theme = Configure::read('ebayCheckout.theme', null) ?? 'Feeder';
        $this->viewBuilder()->setTheme($theme);
        $this->viewBuilder()->setHelpers(['Feeder.Feeder']);
        $this->set('feederHomepage', $this->FeederHomepages->get(1));
    }

    public function index($id = null)
    {
        $account = $this->Auth->user();
        $account = (object)$account;
        $this->loadModel('ItoolCustomer.Customers');
        $wishlistItems = [];
        if(isset($account->id)){
            $customer = $this->Customers->get($account->id);
            if ($customer) {
                $this->loadModel('ItoolCustomer.CustomerWishlistItems');
                $wishlistItems = $this->CustomerWishlistItems->getWishlistItemsForCustomer($customer);
            }
        }

        $this->loadModel('Feeder.FeederPillarPages');
        try {
            if(isset($id)){
                $feederPillarPage = $this->FeederPillarPages->get($id);
            }else{
                $feederPillarPage = $this->FeederPillarPages->find("all")->orderAsc("id")->first();
            }
        } catch (RecordNotFoundException $e) {
            $feederPillarPage = $this->FeederPillarPages->newEntity();
        }

        $blockConfig = json_decode($feederPillarPage['block_configuration']);

        foreach($blockConfig as $block){
            if(isset($block->categoryIds)) {
                $this->loadModel('Feeder.FeederCategories');
                $catIds = explode(';', str_replace(",", ";", $block->categoryIds));
                $block->categoryIds = $this->FeederCategories->find('all', [
                    'conditions' => [
                        "FeederCategories.id IN" => $catIds
                    ]
                ])->toArray();
            }

            if (!empty($block->itemSource) && $block->itemSource == FeederPillarPagesTable::ITEMS_SOURCE_FROM_CATEGORY) {
                if (!empty($block->itemsCategory)) {
                    $block->itemIds = TableRegistry::getTableLocator()->get('Feeder.FeederCategories')
                        ->getFeederCategoryWithItems($block->itemsCategory, $this->request)
                        ['items'];
                    $block->itemIds = array_values(array_filter($block->itemIds, function ($item) { return !is_string($item); }));
                }
            } else if (!empty($block->itemSource) && $block->itemSource == FeederPillarPagesTable::ITEMS_SOURCE_TOP_SELLERS) {
                if (!empty($block->itemsTopSellerCategories)) {
                    $checkoutSessionItems = TableRegistry::getTableLocator()->get('EbayCheckout.EbayCheckoutSessionItems')
                        ->getTopSoldCheckoutSessionItems(30, 1, 7, explode(';', $block->itemsTopSellerCategories));

                    $itemOfferIds = [];
                    foreach ($checkoutSessionItems as $checkoutSessionItem) {
                        $ebayItemId = explode('|', $checkoutSessionItem->grouped_ebay_item_id);
                        if (isset($ebayItemId[1]) && is_numeric($ebayItemId[1])) {
                            $itemOfferIds[] = trim($ebayItemId[1]);
                        }
                    }

                    if (!empty($itemOfferIds)) {
                        $block->itemIds = getItems($itemOfferIds);
                    }
                }
            } else {
                if(isset($block->itemIds)){
                    $block->itemIds = getItems(explode(';', str_replace(',', ';', $block->itemIds)));
                }
            }
        }

        $this->set('wishlistItems', $wishlistItems);
        $this->set('blockConfig', $blockConfig);
        $this->set('pillarPage', $feederPillarPage);
    }
}

function getItems($itemIds) {
    $searchRequest = new SearchItemsRequest();
    $searchItemFilter = new SearchItemFilter();
    $searchItemFilter->setEbayGlobalId('EBAY-DE');
    $searchItemFilter->setCurrency('EUR');
    $searchItemFilter->setQuantityFrom(1);
    $searchItemFilter->setItemLegacyIds($itemIds);
    $searchRequest->appendSearchItemFilter($searchItemFilter);
    $searchRequest->setLimit(30);
    $session = new Session();
    $session->setRequest($searchRequest);
    $session->setAccessToken(Configure::read('eis.token'));
    $response = $session->sendRequest();
    foreach ($response->Result as &$item) {
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
    return $response->Result;
}
