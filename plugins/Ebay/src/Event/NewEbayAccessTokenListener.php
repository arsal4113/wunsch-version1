<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2019-01-25
 * Time: 13:04
 */

namespace Ebay\Event;

use Cake\Cache\Cache;
use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Ebay\Model\Table\EbayRestApiAccessTokensTable;

/**
 * Class NewEbayAccessTokenListener
 * @package Ebay\Event
 * @property EbayRestApiAccessTokensTable $EbayRestApiAccessTokens
 */
class NewEbayAccessTokenListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Ebay.Component.EbayBuyApi.afterAccessTokenSaved' => 'afterBuyApiAccessTokenSaved'
        ];
    }

    public function afterBuyApiAccessTokenSaved(Event $event)
    {
       return true;
    }
}
