<?php
namespace App\Controller;

use Cake\Routing\Router;
use Cake\Utility\Inflector;
use Cake\Utility\Text;

/**
 * CoreConfigurations Controller
 *
 * @property \App\Model\Table\CoreConfigurationsTable $CoreConfigurations
 * @property \Search\Controller\Component\PrgComponent $Prg
 */
class CoreConfigurationsController extends AppController
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
        return $this->redirect($this->referer());
    }

    /**
     * Group method
     *
     * @param $name
     * @return void
     */
    public function loadConfigurationGroup($name = null)
    {
        if ($name === null) return;

        $configurations = $this->CoreConfigurations->getConfigurationInfo();
        $configuration = null;
        foreach ($configurations as $groupName => $content) {
            if ($name == Inflector::underscore(Text::slug($groupName))) {
                $configuration = $configurations[$groupName];
                break;
            }
        }

        $coreConfigurationPaths = [];
        foreach ($configuration as $key => $content) {
            foreach ($content as $id => $subPathAndValue) {
                foreach ($subPathAndValue as $subPath => $value) {
                    $coreConfigurationPaths[$key . '/' . $subPath] = ['value' => $value, 'id' => $id];
                }
            }
        }

        $keyStructure = [];
        foreach ($coreConfigurationPaths as $key => $value) {
            $path = explode("/", $key);
            $i = count($path) - 1;
            $lastTree = [$path[$i] => $value];
            $tree = $lastTree;
            $i--;
            while ($i >= 0) {
                $tree = [];
                $tree[$path[$i]] = $lastTree;
                $lastTree = $tree;
                $i--;
            }
            $keyStructure = array_merge_recursive($keyStructure, $tree);
        }

        $this->set('configurations', $keyStructure);
        $this->set('groupName', $name);
        $this->set('_serialize', ['coreConfiguration']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            foreach ($this->request->data as $configuration_id => $configuration_value) {
                $coreConfiguration = $this->CoreConfigurations->get($configuration_id, ['contain' => []]);
                $coreConfiguration->configuration_value = $configuration_value;
                $this->CoreConfigurations->save($coreConfiguration);
            }

            $this->Flash->success(__('Configuration has been saved.'));

            return $this->redirect(['action' => 'loadConfigurationGroup', $name]);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Core Configuration id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coreConfiguration = $this->CoreConfigurations->get($id, [
            'contain' => ['CoreSellers']
        ]);
        $this->set('coreConfiguration', $coreConfiguration);
        $this->set('_serialize', ['coreConfiguration']);
    }


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coreConfiguration = $this->CoreConfigurations->newEntity();
        if ($this->request->is('post')) {
            $coreConfiguration = $this->CoreConfigurations->patchEntity($coreConfiguration, $this->request->data);
            if ($this->CoreConfigurations->save($coreConfiguration)) {
                $this->Flash->success(__('Configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Configuration could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreConfigurations->CoreSellers->find('list', ['limit' => 200]);

        $groupNames = $this->CoreConfigurations->getDistinctConfigurationGroup();
        $this->set('groupNames', $groupNames);

        $this->set(compact('coreConfiguration', 'coreSellers'));
        $this->set('_serialize', ['coreConfiguration']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Core Configuration id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coreConfiguration = $this->CoreConfigurations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coreConfiguration = $this->CoreConfigurations->patchEntity($coreConfiguration, $this->request->data);

            if ($this->CoreConfigurations->save($coreConfiguration)) {
                $this->Flash->success(__('Configuration has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Configuration could not be saved. Please, try again.'));
            }
        }
        $coreSellers = $this->CoreConfigurations->CoreSellers->find('list', ['limit' => 200]);
        $this->set(compact('coreConfiguration', 'coreSellers'));
        $this->set('_serialize', ['coreConfiguration']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Core Configuration id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coreConfiguration = $this->CoreConfigurations->get($id);
        if ($this->CoreConfigurations->delete($coreConfiguration)) {
            $this->Flash->success(__('Configuration has been deleted.'));
        } else {
            $this->Flash->error(__('Configuration could not be deleted. Please, try again.'));
            return $this->redirect(['action' => 'index']);
        }

    }

}
