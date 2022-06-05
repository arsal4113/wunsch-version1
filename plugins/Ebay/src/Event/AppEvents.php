<?php
namespace Ebay\Event;

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 12.06.15
 * Time: 16:30
 */

use Cake\Event\EventListenerInterface;

class AppEvents implements EventListenerInterface
{

    public function implementedEvents()
    {
        return [
            'Template.render.sidebar' => [
                'callable' => 'sidebar'
            ]
        ];
    }

    public function sidebar($event)
    {
        $sidebar = $event->getResult();
        $sidebar[] = [
            'name' => 'eBay',
            'icon' => 'fa-cart-plus',
            'links' => [
                [
                    'name' => 'Ebay Accounts',
                    'link' => ['controller' => 'EbayAccounts', 'action' => 'index', 'prefix' => false, 'plugin' => 'Ebay']
                ],
                [
                    'name' => 'Ebay Account Types',
                    'link' => ['controller' => 'EbayAccountTypes', 'action' => 'index', 'prefix' => false, 'plugin' => 'Ebay']
                ],
                [
                    'name' => 'Ebay Credentials',
                    'link' => ['controller' => 'EbayCredentials', 'action' => 'index', 'prefix' => false, 'plugin' => 'Ebay']
                ],
                [
                    'name' => 'Ebay Sites',
                    'link' => ['controller' => 'EbaySites', 'action' => 'index', 'prefix' => false, 'plugin' => 'Ebay']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
