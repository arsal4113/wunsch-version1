<?php

namespace Feeder\Controller;

use App\Application;
use Cake\Core\Configure;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Event\Event;
use Cake\I18n\Number;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Feeder\Model\Table\FeederInfluencersTable;

/**
 * FeederQuiz Controller
 *
 * @property FeederInfluencersTable $FeederInfluencers
 */
class InfluencerController extends AppController
{
    /**
     * @throws \Exception
     */
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
    }

    /**
     * BeforeFilter to allow view without login
     *
     * @param Event $event
     * @return \Cake\Http\Response|void|null
     * @throws \Exception
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
    }

    /**
     * @param null $id
     */
    public function index($id = null)
    {
        $this->loadModel('Feeder.FeederInfluencers');
        try {
            if(isset($id)){
                $feederInfluencer = $this->FeederInfluencers->get($id, [
                    'contain' => ['FeederInfluencerMiniCategories'],
                    #'cache' => Application::SHORT_TERM_CACHE, 'key' => 'influencer_' . $id
                ]);
            }else{
                $feederInfluencer = $this->FeederInfluencers->find('all', ['contain' => ['FeederInfluencerMiniCategories']])->orderAsc('id')->first();#->cache('first_influencer', Application::SHORT_TERM_CACHE)->first();
            }
        } catch(RecordNotFoundException $e) {
            $feederInfluencer = $this->FeederInfluencers->newEntity();

        }
        $this->loadModel('Feeder.FeederCategories');
        $first_items = null;
        $second_items = null;
        if(isset($feederInfluencer->area_8_world_id)){
            $first_items = getItemsById($this->FeederCategories->get($feederInfluencer->area_8_world_id));
            shuffle($first_items);
        }
        if(isset($feederInfluencer->area_9_world_id)){
            $second_items = getItemsById($this->FeederCategories->get($feederInfluencer->area_9_world_id));
            shuffle($second_items);
        }
        $this->set('influencer', $feederInfluencer);
        $this->set('first_items', $first_items);
        $this->set('second_items', $second_items);
    }
}

function getItemsById($category){
    $items = null;
    if(!empty($category->item_id)){
        $items = getProducts(array_map('trim', explode(';', $category->item_id)), false);
    }else if(!empty($category->ebay_category_id)){
        $items = getProducts(array_map('trim', explode(';', $category->ebay_category_id)), true);
    }else if(!empty($category->top_category_id)){
        $items = getProducts(array_map('trim', explode(';', $category->top_category_id)), true);
    }
    return $items;
}

function getProducts($ids, $isCategory) {
    $searchRequest = new SearchItemsRequest();
    $searchItemFilter = new SearchItemFilter();
    $searchItemFilter->setEbayGlobalId('EBAY-DE');
    $searchItemFilter->setCurrency('EUR');
    $searchItemFilter->setQuantityFrom(1);
    if ($isCategory) {
        $searchItemFilter->setCategoryIds($ids);
    } else {
        $searchItemFilter->setItemLegacyIds($ids);
    }
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
