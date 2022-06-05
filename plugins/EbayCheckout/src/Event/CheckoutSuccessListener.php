<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 23.10.18
 * Time: 13:48
 */

namespace EbayCheckout\Event;

use Cake\Core\Configure;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use EisSdk\Request\RefreshItemRequest;
use EisSdk\Security\Session;


class CheckoutSuccessListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'EbayCheckout.EbayCheckoutSessions.success' => [
                'callable' => 'refreshItems',
                'priority' => 100
            ]
        ];
    }

    public function refreshItems(Event $event)
    {
        $ebayItemIds = $event->getData('ebayItemIds');
        $ebayGlobalId = $event->getData('ebayGlobalId');

        try {
            if(!empty($ebayItemIds)) {
                if(!is_array($ebayItemIds)) {
                    $ebayItemIds = [$ebayItemIds];
                }
                $refreshItemRequest = new RefreshItemRequest();
                $refreshItemRequest->setItemIds($ebayItemIds);
                $refreshItemRequest->setEbayGlobalId($ebayGlobalId);

                $session = new Session();
                $session->setAccessToken(Configure::read('eis.token'));
                $session->setRequest($refreshItemRequest);
                $session->sendRequest();
            }
        } catch (\Exception $exp) {
            $this->log(__('Error while sending item refresh request. ErrorMessage "{0}", ItemId "{1}", eBayGlobalId "{2}", File "{3}", CodeLine "{4}"', [
                $exp->getMessage(),
                implode(',', $ebayItemIds),
                $ebayGlobalId,
                $exp->getFile(),
                $exp->getLine()
            ]));
        }
        return true;
    }
}