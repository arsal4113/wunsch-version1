<?php
namespace EbayCheckout\Event;

use Cake\Event\EventListenerInterface;

class AppEvents implements EventListenerInterface
{

    public function implementedEvents()
    {
        return [
            'Template.render.sidebar' => [
                'callable' => 'sidebar'
            ],
        ];
    }

    public function sidebar($event)
    {
        $sidebar = $event->getResult();
        $sidebar[] = [
            'name' => 'EbayCheckout',
            'icon' => 'fa-ship',
            'links' => [
                [
                    'name' => 'Sessions',
                    'link' => ['controller' => 'EbayCheckouts', 'action' => 'indexSessions', 'plugin' => 'EbayCheckout']
                ],
                [
                    'name' => 'Export Sessions',
                    'link' => ['controller' => 'EbayCheckouts', 'action' => 'exportSessions', 'plugin' => 'EbayCheckout']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
