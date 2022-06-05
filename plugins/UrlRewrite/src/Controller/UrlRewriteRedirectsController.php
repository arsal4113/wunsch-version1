<?php

namespace UrlRewrite\Controller;

use Cake\Event\Event;

/**
 * UrlRewriteRedirects Controller
 *
 * @property \UrlRewrite\Model\Table\UrlRewriteRedirectsTable $UrlRewriteRedirects
 *
 * @method \UrlRewrite\Model\Entity\UrlRewriteRedirect[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UrlRewriteRedirectsController extends AppController
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
        $this->paginate = [
            'contain' => ['UrlRewriteRedirectTypes']
        ];
        $this->Prg->commonProcess();

        $availableColumns = $this->UrlRewriteRedirects->getSchema()->columns();

        $this->set('urlRewriteRedirects', $this->paginate($this->UrlRewriteRedirects->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['urlRewriteRedirects']);
    }

    /**
     * View method
     *
     * @param string|null $id Url Rewrite Redirect id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlRewriteRedirect = $this->UrlRewriteRedirects->get($id, [
            'contain' => ['UrlRewriteRedirectTypes']
        ]);
        $this->set('urlRewriteRedirect', $urlRewriteRedirect);
        $this->set('_serialize', ['urlRewriteRedirect']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlRewriteRedirect = $this->UrlRewriteRedirects->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['creator'] = 'User-' . $this->Auth->user('id');
            $data['timestamp'] = time();
            $urlRewriteRedirect = $this->UrlRewriteRedirects->patchEntity($urlRewriteRedirect, $data);
            if ($this->UrlRewriteRedirects->save($urlRewriteRedirect)) {
                $this->Flash->success(__('The url rewrite redirect has been saved.'));

                $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
                $this->getEventManager()->dispatch($event);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite redirect could not be saved. Please, try again.'));
            }
        }
        $urlRewriteRedirectTypes = $this->UrlRewriteRedirects->UrlRewriteRedirectTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'header'
        ]);
        $this->set(compact('urlRewriteRedirect', 'urlRewriteRedirectTypes'));
        $this->set('_serialize', ['urlRewriteRedirect']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Url Rewrite Redirect id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlRewriteRedirect = $this->UrlRewriteRedirects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['creator'] = 'User-' . $this->Auth->user('id');
            $data['timestamp'] = time();
            $urlRewriteRedirect = $this->UrlRewriteRedirects->patchEntity($urlRewriteRedirect, $data);
            if ($this->UrlRewriteRedirects->save($urlRewriteRedirect)) {
                $this->Flash->success(__('The url rewrite redirect has been saved.'));

                $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
                $this->getEventManager()->dispatch($event);

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite redirect could not be saved. Please, try again.'));
            }
        }
        $urlRewriteRedirectTypes = $this->UrlRewriteRedirects->UrlRewriteRedirectTypes->find('list', [
            'keyField' => 'id',
            'valueField' => 'header'
        ]);
        $this->set(compact('urlRewriteRedirect', 'urlRewriteRedirectTypes'));
        $this->set('_serialize', ['urlRewriteRedirect']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Url Rewrite Redirect id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlRewriteRedirect = $this->UrlRewriteRedirects->get($id);
        if ($this->UrlRewriteRedirects->delete($urlRewriteRedirect)) {
            $this->Flash->success(__('The url rewrite redirect has been deleted.'));

            $event = new Event('UrlRewrite.UrlRewriteChanged.afterChange', $this);
            $this->getEventManager()->dispatch($event);

        } else {
            $this->Flash->error(__('The url rewrite redirect could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
