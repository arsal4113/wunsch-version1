<?php

namespace Feeder\Event;

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
            'name' => 'Feeder',
            'icon' => 'fa-bullhorn',
            'links' => [
                [
                    'name' => __('Categories'),
                    'link' => ['controller' => 'FeederCategories', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Fizzy Bubble'),
                    'link' => ['controller' => 'FeederFizzyBubbles', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Guides'),
                    'link' => ['controller' => 'FeederGuides', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Hero Items'),
                    'link' => ['controller' => 'FeederHeroItems', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Categories Video Elements'),
                    'link' => ['controller' => 'FeederCategoriesVideoElements', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Homepages'),
                    'link' => ['controller' => 'FeederHomepages', 'action' => 'configure', 'plugin' => 'Feeder']
                ],
                /*[
                    'name' => __('Homepage Banners'),
                    'link' => ['controller' => 'FeederHomepageBanners', 'action' => 'index', 'plugin' => 'Feeder']
                ],*/
                [
                    'name' => __('Homepage Midpage Containers'),
                    'link' => ['controller' => 'FeederHomepageMidpageContainers', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Interests'),
                    'link' => ['controller' => 'FeederInterests', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Interest Subcategories'),
                    'link' => ['controller' => 'FeederInterestSubcategories', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Quizzes'),
                    'link' => ['controller' => 'FeederQuizzes', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Quiz Results'),
                    'link' => ['controller' => 'FeederQuizResults', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('SEO Pillar Pages'),
                    'link' => ['controller' => 'FeederPillarPages', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Influencers'),
                    'link' => ['controller' => 'FeederInfluencers', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Influencer Mini Categories'),
                    'link' => ['controller' => 'FeederInfluencerMiniCategories', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('Worlds'),
                    'link' => ['controller' => 'FeederWorlds', 'action' => 'index', 'plugin' => 'Feeder']
                ],
                [
                    'name' => __('USP Bar Configuration'),
                    'link' => ['controller' => 'FeederUspBar', 'action' => 'index', 'plugin' => 'Feeder']
                ]
            ]
        ];
        $event->setResult($sidebar);
    }
}
