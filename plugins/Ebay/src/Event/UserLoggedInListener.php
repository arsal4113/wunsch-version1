<?php

namespace Ebay\Event;

use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;

class UserLoggedInListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Controller.CoreUsers.UserLoggedIn' => 'afterLogin'
        ];
    }

    public function afterLogin(Event $event)
    {
        $ebayTokenExpirationOffset = '+2 weeks';

        $user = $event->getData('user');
        if (!empty($user)) {
            $ebayAccounts = TableRegistry::get('Ebay.EbayAccounts')->find()
                ->where([
                    'EbayAccounts.core_seller_id' => $user['core_seller_id'],
                    'EbayAccounts.is_active' => 1,
                    'EbayAccounts.token_expiration_time <=' => date('Y-m-d H:i:s', strtotime($ebayTokenExpirationOffset))
                ]);
            if (!empty($ebayAccounts)) {
                foreach ($ebayAccounts as $ebayAccount) {
                    $event->getSubject()->Flash->error(__('eBay Token for the account "{0}" expires at {1}', [$ebayAccount->name, $ebayAccount->token_expiration_time]));
                }
            }

            /*$ebayAccounts = TableRegistry::get('Ebay.EbayAccounts')->find()
                ->contain(['EbayCredentials'])
                ->where([
                    'EbayAccounts.core_seller_id' => $user['core_seller_id'],
                    'EbayAccounts.is_active' => 1,
                    'EbayCredentials.is_active' => 0
                ]);

            if (!empty($ebayAccounts)) {
                $view = new View();
                $htmlHelper = new HtmlHelper($view);
                $link = $htmlHelper->link('Recreate now!', ['controller' => 'EbayFashionStores', 'action' => 'ebayConnection', 'plugin' => 'EbayFashion']);
                foreach ($ebayAccounts as $ebayAccount) {
                    $event->getSubject()->Flash->error(__('For security reason please recreate your eBay token for the ebay account "{0}". {1}', [$ebayAccount->name, $link]));
                }
            }*/
        }
    }
}