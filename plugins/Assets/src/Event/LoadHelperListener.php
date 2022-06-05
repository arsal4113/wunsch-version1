<?php
namespace Assets\Event;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;

class LoadHelperListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Controller.beforeRender' => 'injectHelper',
        ];
    }

    public function injectHelper(Event $event)
    {
        $event->subject->viewBuilder()->helpers(['Html' => [
            'className' => 'Assets.Html'
        ]]);
    }
}