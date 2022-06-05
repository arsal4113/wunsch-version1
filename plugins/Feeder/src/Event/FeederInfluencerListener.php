<?php


namespace Feeder\Event;

use Cake\Core\Plugin;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Feeder\Model\Table\FeederInfluencersTable;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class FeederInfluencerListener
 * @package Feeder\Event
 * @property FeederInfluencersTable $FeederInfluencers
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 */
class FeederInfluencerListener implements EventListenerInterface
{
    private $creator = 'feeder_influencer_listener';
    private $FeederInfluencers;
    private $UrlRewriteRoutes;
    private $UrlRewriteRedirects;
    private $redirectCode = 302;

    public function implementedEvents()
    {
        return [
            'Model.FeederInfluencers.afterSave' => 'refreshRouting',
            'Model.FeederInfluencers.afterDelete' => 'refreshRouting'
        ];
    }

    public function refreshRouting(Event $event)
    {
        if (Plugin::loaded('UrlRewrite')) {
            $this->FeederInfluencers = TableRegistry::getTableLocator()->get('Feeder.FeederInfluencers');

            # avoid loop after saving default url paths for categories
            EventManager::instance()->off($this);

            $urlRewriteRoutes = $this->refreshRoutes();
            $this->refreshRedirects($urlRewriteRoutes);

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            EventManager::instance()->dispatch($event);
        }
    }

    protected function refreshRoutes()
    {
        $startTimestamp = time();
        $this->UrlRewriteRoutes = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRoutes');

        $routes = $this->UrlRewriteRoutes->find()
            ->where([
                'creator' => $this->creator
            ]);

        $influencers = $this->FeederInfluencers->find('all');

        $urlRewriteRoutes = [];

        foreach ($influencers as $influencer) {
            if (empty($influencer->url_path)) {
                $influencer->url_path = Text::slug(Inflector::dasherize($influencer->title));
                $this->FeederInfluencers->save($influencer);
            }
            $urlRewriteRoutes[] = $this->getUrlRewriteRouteEntity($influencer->url_path, $influencer->id, $routes);
        }

        if ($this->UrlRewriteRoutes->saveMany($urlRewriteRoutes)) {
            $this->UrlRewriteRoutes->deleteAll(['creator' => $this->creator, 'timestamp <' => $startTimestamp]);
        }
        return $urlRewriteRoutes;
    }

    protected function refreshRedirects($urlRewriteRoutes)
    {
        $startTimestamp = time();
        $this->UrlRewriteRedirects = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirects');

        $redirectType = $this->UrlRewriteRedirects->UrlRewriteRedirectTypes->find()
            ->where(['code' => $this->redirectCode])
            ->first();

        $urlRewriteRedirects = $this->UrlRewriteRedirects->find()
            ->where([
                'creator' => $this->creator
            ]);

        $newUrlRewriteRedirects = [];

        foreach ($urlRewriteRoutes as $urlRewriteRoute) {
            $newUrlRewriteRedirect = $this->getUrlRewriteRedirectEntity($redirectType, $urlRewriteRoute, $urlRewriteRedirects);
            if (!empty($newUrlRewriteRedirect)) {
                $newUrlRewriteRedirects[] = $newUrlRewriteRedirect;
            }
        }
        if (!empty($newUrlRewriteRedirects)) {
            if ($this->UrlRewriteRedirects->saveMany($newUrlRewriteRedirects)) {
                $this->UrlRewriteRedirects->deleteAll(['creator' => $this->creator, 'timestamp <' => $startTimestamp]);
            }
        }
    }

    protected function getUrlRewriteRouteEntity($urlPath, $influencerId, $routes)
    {
        $entity = null;
        foreach ($routes as $route) {
            if ($route->args == $influencerId) {
                $entity = $this->UrlRewriteRoutes->patchEntity($route, [
                    'target_url' => '/' . $urlPath . '/*',
                    'plugin' => 'Feeder',
                    'controller' => 'Influencer',
                    'action' => 'index',
                    'timestamp' => time(),
                ]);
                break;
            }
        }
        if (empty($entity)) {
            $entity = $this->UrlRewriteRoutes->newEntity([
                'target_url' => '/' . $urlPath . '/*',
                'plugin' => 'Feeder',
                'controller' => 'Influencer',
                'action' => 'index',
                'creator' => $this->creator,
                'timestamp' => time(),
                'args' => $influencerId
            ]);
        }
        return $entity;
    }

    protected function getUrlRewriteRedirectEntity($redirectType, $urlRewriteRoute, $urlRewriteRedirects)
    {
        $entity = null;
        //remove last *
        $targetUrl = explode('*', $urlRewriteRoute->target_url);
        $targetUrl = $targetUrl[0] ?? null;
        if (!empty($targetUrl)) {
            foreach ($urlRewriteRedirects as $urlRewriteRedirect) {
                if ($urlRewriteRedirect->target_url == $targetUrl) {
                    $entity = $this->UrlRewriteRedirects->patchEntity($urlRewriteRedirect, [
                        'url_rewrite_redirect_type_id' => $redirectType->id,
                        //generate url based on template with the _name defined in the routes.php
                        'source_url' =>  '/feeder/influencer/' . $urlRewriteRoute->args,
                        'target_url' => $targetUrl,
                        'timestamp' => time()
                    ]);
                    break;
                }
            }
            if (empty($entity)) {
                $entity = $this->UrlRewriteRedirects->newEntity([
                    'url_rewrite_redirect_type_id' => $redirectType->id,
                    //generate url based on template with the _name defined in the routes.php
                    'source_url' =>  '/feeder/influencer/' . $urlRewriteRoute->args,
                    'target_url' => $targetUrl,
                    'timestamp' => time(),
                    'creator' => $this->creator
                ]);
            }
        }
        return $entity;
    }
}
