<?php

namespace Ebay\Event;

use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class GetSellerAccountsListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Controller.SafetyQuantity.getSellerAccounts' => 'getSellerAccounts'
        ];
    }

    public function getSellerAccounts(Event $event)
    {
        $coreSellerId = isset($event->data['core_seller_id']) ? $event->data['core_seller_id'] : null;
        $ebayAccounts = TableRegistry::get('Ebay.EbayAccounts')->find('list', [
            'keyField' => 'code',
            'valueField' => 'name'
        ])
            ->where(['EbayAccounts.core_seller_id' => $coreSellerId])
            ->toArray();


        if (!isset($event->result['accounts'])) {
            $data['accounts']['Ebay'] = $ebayAccounts;
            return $data;
        } else {
            $event->result['accounts']['Ebay'] = $ebayAccounts;
        }
    }
}