<?php

namespace UrlRewrite\Controller;

/**
 * UrlRewriteRedirectTypes Controller
 *
 * @property \UrlRewrite\Model\Table\UrlRewriteRedirectTypesTable $UrlRewriteRedirectTypes
 *
 * @method \UrlRewrite\Model\Entity\UrlRewriteRedirectType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UrlRewriteRedirectTypesController extends AppController
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

        $availableColumns = $this->UrlRewriteRedirectTypes->getSchema()->columns();

        $this->set('urlRewriteRedirectTypes', $this->paginate($this->UrlRewriteRedirectTypes->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['urlRewriteRedirectTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Url Rewrite Redirect Type id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->get($id, [
            'contain' => ['UrlRewriteRedirects']
        ]);
        $this->set('urlRewriteRedirectType', $urlRewriteRedirectType);
        $this->set('_serialize', ['urlRewriteRedirectType']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->newEntity();
        if ($this->request->is('post')) {
            $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->patchEntity($urlRewriteRedirectType, $this->request->data);
            if ($this->UrlRewriteRedirectTypes->save($urlRewriteRedirectType)) {
                $this->Flash->success(__('The url rewrite redirect type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite redirect type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('urlRewriteRedirectType'));
        $this->set('_serialize', ['urlRewriteRedirectType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Url Rewrite Redirect Type id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->patchEntity($urlRewriteRedirectType, $this->request->data);
            if ($this->UrlRewriteRedirectTypes->save($urlRewriteRedirectType)) {
                $this->Flash->success(__('The url rewrite redirect type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The url rewrite redirect type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('urlRewriteRedirectType'));
        $this->set('_serialize', ['urlRewriteRedirectType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Url Rewrite Redirect Type id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $urlRewriteRedirectType = $this->UrlRewriteRedirectTypes->get($id);
        if ($this->UrlRewriteRedirectTypes->delete($urlRewriteRedirectType)) {
            $this->Flash->success(__('The url rewrite redirect type has been deleted.'));
        } else {
            $this->Flash->error(__('The url rewrite redirect type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
