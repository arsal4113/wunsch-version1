<?php

namespace ItoolCustomer\Event;

use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use ItoolCustomer\Controller\Component\WishlistComponent;
use ItoolCustomer\Model\Table\CustomerWishlistItemsTable;

class AppEvents implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Template.render.sidebar' => [
                'callable' => 'sidebar'
            ],
            'SocialAuth.afterIdentify' => [
                'callable' => 'socialLogin'
            ],
            'ItoolCustomer.Controller.Customers.CustomerLoggedIn' => [
                'callable' => 'login'
            ]
        ];
    }

    public function sidebar($event)
    {
        $sidebar = $event->getResult();
        $sidebar[] = [
            'name' => 'Newsletter Management',
            'icon' => 'fa-bullhorn',
            'links' => [
                [
                    'name' => __('Newsletter Export'),
                    'link' => ['controller' => 'NewsletterBackend', 'action' => 'export', 'plugin' => 'ItoolCustomer']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }

    public function socialLogin ($event)
    {
        $user = $event->getData('user');

        $session = \Cake\Network\Session::create();
        $session->write('Pandata.just_logged', $user->id);

        /** @var CustomerWishlistItemsTable $table */
        $table = TableRegistry::get('ItoolCustomer.CustomerWishlistItems');
        $table->updateWishlistItems($user);
    }

    public function login($event)
    {
        $customer = $event->getData('customer');

        /** @var CustomerWishlistItemsTable $table */
        $table = TableRegistry::get('ItoolCustomer.CustomerWishlistItems');
        $table->updateWishlistItems($customer);
    }


}
