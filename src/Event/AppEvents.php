<?php
namespace App\Event;

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 12.06.15
 * Time: 16:30
 */

use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

class AppEvents implements EventListenerInterface
{

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Event\EventListenerInterface::implementedEvents()
     */
    public function implementedEvents()
    {
        return [
            'Template.render.sidebar' => [
                'callable' => 'sidebar'
            ]
        ];
    }

    /**
     * Collection of menu links for the sidebar
     *
     * @param Event $event
     */
    public function sidebar($event)
    {
        $sidebar = $event->getResult();
        $sidebar[] = [
            'name' => 'Users Management',
            'icon' => 'fa-group',
            'links' => [
                [
                    'name' => 'Sellers',
                    'link' => ['controller' => 'CoreSellers', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'Seller Type',
                    'link' => ['controller' => 'CoreSellerTypes', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'User Roles',
                    'link' => ['controller' => 'CoreUserRoles', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'Users',
                    'link' => ['controller' => 'CoreUsers', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'Permissions',
                    'link' => ['controller' => 'Aros', 'action' => 'index', 'prefix' => false, 'plugin' => 'AclManager']
                ]
            ]
        ];

        $sidebar[] = [
            'name' => 'Products Management',
            'icon' => 'fa-list',
            'links' => [
                [
                    'name' => 'Product Visits',
                    'link' => ['controller' => 'ProductVisits', 'action' => 'index', 'prefix' => false, 'plugin' => 'VisitManager']
                ]
            ]
        ];
        $sidebar[] = [
            'name' => 'Customer Management',
            'icon' => 'fa-user',
            'links' => [
                [
                    'name' => __('Customers'),
                    'link' => ['controller' => 'Customers', 'action' => 'index', 'plugin' => 'ItoolCustomer']
                ],
                [
                    'name' => __('Wishlist Configuration'),
                    'link' => ['controller' => 'CustomerWishlistConfiguration', 'action' => 'configure', 'plugin' => 'ItoolCustomer']
                ],
                [
                    'name' => __('Exclude Customers'),
                    'link' => ['controller' => 'ExcludeCustomers', 'action' => 'uploadCustomersFile', 'plugin' => 'ItoolCustomer']
                ]
            ]
        ];
        $sidebar[] = [
            'name' => 'i-Tool 3 Settings',
            'icon' => 'fa-cogs',
            'links' => [
                [
                    'name' => 'Add New Configuration',
                    'link' => [
                        'controller' => 'CoreConfigurations',
                        'action' => 'add',
                        'prefix' => false,
                        'plugin' => false,
                    ]

                ],
                [
                    'name' => 'Countries',
                    'link' => ['controller' => 'CoreCountries', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'Languages',
                    'link' => ['controller' => 'CoreLanguages', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ],
                [
                    'name' => 'Error Logs',
                    'link' => ['controller' => 'CoreErrors', 'action' => 'index', 'prefix' => false, 'plugin' => false]
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
