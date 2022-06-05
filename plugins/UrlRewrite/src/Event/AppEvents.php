<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 10.08.18
 * Time: 13:27
 */

namespace UrlRewrite\Event;

use Cake\Event\EventListenerInterface;

/**
 * Class AppEvents
 * @package UrlRewrite\Event
 */
class AppEvents implements EventListenerInterface
{
    /**
     * @return array
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
     * @param $event
     */
    public function sidebar($event)
    {
        $sidebar = $event->getResult();
        $sidebar[] = [
            'name' => 'Url Rewrites',
            'icon' => 'fa-exchange',
            'links' => [
                [
                    'name' => __('Url Redirects'),
                    'link' => ['controller' => 'UrlRewriteRedirects', 'action' => 'index', 'plugin' => 'UrlRewrite']
                ],
                [
                    'name' => __('Url Routes'),
                    'link' => ['controller' => 'UrlRewriteRoutes', 'action' => 'index', 'plugin' => 'UrlRewrite']
                ],
                [
                    'name' => __('Url Rewrite Types'),
                    'link' => ['controller' => 'UrlRewriteRedirectTypes', 'action' => 'index', 'plugin' => 'UrlRewrite']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
