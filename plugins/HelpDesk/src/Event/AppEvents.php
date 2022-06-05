<?php

namespace HelpDesk\Event;

use Cake\Event\EventListenerInterface;

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
            ],
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
            'name' => 'HelpDesk',
            'icon' => 'fa-bullhorn',
            'links' => [
                [
                    'name' => __('Help Desk Category'),
                    'link' => ['controller' => 'HelpDeskCategories', 'action' => 'index', 'plugin' => 'HelpDesk']
                ],
                [
                    'name' => __('FAQ'),
                    'link' => ['controller' => 'HelpDeskFaqs', 'action' => 'index', 'plugin' => 'HelpDesk']
                ],
            ]
        ];
        $event->setResult($sidebar);
    }
}