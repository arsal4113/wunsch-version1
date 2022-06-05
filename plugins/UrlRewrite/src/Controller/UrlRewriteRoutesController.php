<?php

namespace UrlRewrite\Controller;

use Cake\Event\Event;

/**
 * UrlRewriteRoutes Controller
 *
 * @property \UrlRewrite\Model\Table\UrlRewriteRoutesTable $UrlRewriteRoutes
 *
 * @method \UrlRewrite\Model\Entity\UrlRewriteRoute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UrlRewriteRoutesController extends AppController
{
    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->Prg->commonProcess();

        $availableColumns = $this->UrlRewriteRoutes->getSchema()->columns();

        $this->set('urlRewriteRoutes', $this->paginate($this->UrlRewriteRoutes->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['urlRewriteRoutes']);
    }

    /**
     * View method
     *
     * @param string|null $id Url Rewrite Route id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlRewriteRoute = $this->UrlRewriteRoutes->get($id, [
            'contain' => []
        ]);
        $this->set('urlRewriteRoute', $urlRewriteRoute);
        $this->set('_serialize', ['urlRewriteRoute']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlRewriteRoute = $this->UrlRewriteRoutes->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['creator'] = 'User-' . $this->Auth->user('id');
            $data['timestamp'] = time();

            $urlRewriteRoute = $this->UrlRewriteRoutes->patchEntity($urlRewriteRoute, $data);
            if ($this->UrlRewriteRoutes->save($urlRewriteRoute)) {
                $this->Flash->success(__('The url rewrite route has been saved.'));

                $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
                $this->getEventManager()->dispatch($event);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite route could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('urlRewriteRoute'));
        $this->set('_serialize', ['urlRewriteRoute']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Url Rewrite Route id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlRewriteRoute = $this->UrlRewriteRoutes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['creator'] = 'User-' . $this->Auth->user('id');
            $data['timestamp'] = time();

            $urlRewriteRoute = $this->UrlRewriteRoutes->patchEntity($urlRewriteRoute, $data);
            if ($this->UrlRewriteRoutes->save($urlRewriteRoute)) {
                $this->Flash->success(__('The url rewrite route has been saved.'));

                $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
                $this->getEventManager()->dispatch($event);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite route could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('urlRewriteRoute'));
        $this->set('_serialize', ['urlRewriteRoute']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Url Rewrite Route id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlRewriteRoute = $this->UrlRewriteRoutes->get($id);
        if ($this->UrlRewriteRoutes->delete($urlRewriteRoute)) {
            $this->Flash->success(__('The url rewrite route has been deleted.'));

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            $this->getEventManager()->dispatch($event);

        } else {
            $this->Flash->error(__('The url rewrite route could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
