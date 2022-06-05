<?php
namespace ZipData\Event;
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 27.08.18
 * Time: 10:14
 */

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
            'name' => 'Zip Data',
            'icon' => 'fa-group',
            'links' => [
                [
                    'name' => 'Upload',
                    'link' => ['controller' => 'ZipDataZips', 'action' => 'index', 'plugin' => 'ZipData']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
