<?php


namespace Feeder\Event;

use Cake\Core\Plugin;
use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use Cake\Utility\Text;
use Feeder\Model\Table\FeederQuizzesTable;
use UrlRewrite\Model\Table\UrlRewriteRedirectsTable;
use UrlRewrite\Model\Table\UrlRewriteRoutesTable;

/**
 * Class FeederQuizListener
 * @package Feeder\Event
 * @property FeederQuizzesTable $FeederQuizzes
 * @property UrlRewriteRoutesTable $UrlRewriteRoutes
 * @property UrlRewriteRedirectsTable $UrlRewriteRedirects
 */
class FeederQuizListener implements EventListenerInterface
{
    private $creator = 'feeder_quiz_listener';
    private $FeederQuizzes;
    private $UrlRewriteRoutes;
    private $UrlRewriteRedirects;
    private $redirectCode = 302;

    public function implementedEvents()
    {
        return [
            'Model.FeederQuizzes.afterSave' => 'refreshRouting',
            'Model.FeederQuizzes.afterDelete' => 'refreshRouting'
        ];
    }

    public function refreshRouting(Event $event)
    {
        if (Plugin::loaded('UrlRewrite')) {
            $this->FeederQuizzes = TableRegistry::getTableLocator()->get('Feeder.FeederQuizzes');

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

        $quizzes = $this->FeederQuizzes->find('all');

        $urlRewriteRoutes = [];

        foreach ($quizzes as $quiz) {
            if (empty($quiz->url_path)) {
                $quiz->url_path = Text::slug(Inflector::dasherize($quiz->title_tag));
                $this->FeederQuizzes->save($quiz);
            }
            $urlRewriteRoutes[] = $this->getUrlRewriteRouteEntity($quiz->url_path, $quiz->id, $routes);
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

    protected function getUrlRewriteRouteEntity($urlPath, $quitId, $routes)
    {
        $entity = null;
        foreach ($routes as $route) {
            if ($route->args == $quitId) {
                $entity = $this->UrlRewriteRoutes->patchEntity($route, [
                    'target_url' => '/' . $urlPath . '/*',
                    'plugin' => 'Feeder',
                    'controller' => 'Quiz',
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
                'controller' => 'Quiz',
                'action' => 'index',
                'creator' => $this->creator,
                'timestamp' => time(),
                'args' => $quitId
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
                        'source_url' =>  '/feeder/quiz/' . $urlRewriteRoute->args,
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
                    'source_url' =>  '/feeder/quiz/' . $urlRewriteRoute->args,
                    'target_url' => $targetUrl,
                    'timestamp' => time(),
                    'creator' => $this->creator
                ]);
            }
        }
        return $entity;
    }
}
