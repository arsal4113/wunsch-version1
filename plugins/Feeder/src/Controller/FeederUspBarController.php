<?php

namespace Feeder\Controller;

use App\Model\Table\CoreConfigurationsTable;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * FeederUspBar Controller
 *
 * @property CoreConfigurationsTable $CoreConfigurations
 *
 * @property \Feeder\Model\Table\FeederUspBarTable $FeederUspBar
 *
 * @method \Feeder\Model\Entity\FeederUspBar[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FeederUspBarController extends AppController
{
    /**
     * @var array
     *
     */
    public $components = ['Search.Prg'];

    const CONFIG_GROUP = 'FeederUspBar';
    const USP_BAR_FontColor_CONFIG_PATH = 'Feeder/FeederUspBar/uspFontColor';
    const USP_BAR_BackgroundColor_CONFIG_PATH = 'Feeder/FeederUspBar/uspBackgroundColor';
    const USP_BAR_Activation_CONFIG_PATH = 'Feeder/FeederUspBar/uspIsActive';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('CoreConfigurations');
        $feederUspBar = $this->paginate($this->FeederUspBar);

        $uspFontColor = TableRegistry::get('CoreConfigurations')->find()
            ->where(['configuration_path' => self::USP_BAR_FontColor_CONFIG_PATH])
            ->first();
        $uspBackgroundColor = TableRegistry::get('CoreConfigurations')->find()
            ->where(['configuration_path' => self::USP_BAR_BackgroundColor_CONFIG_PATH])
            ->first();
        $uspIsActive = TableRegistry::get('CoreConfigurations')->find()
            ->where(['configuration_path' => self::USP_BAR_Activation_CONFIG_PATH])
            ->first();
        $this->set('uspBackgroundColor', $uspBackgroundColor['configuration_value']);
        $this->set('uspFontColor', $uspFontColor['configuration_value']);
        $this->set('uspIsActive', $uspIsActive['configuration_value']);
        $this->set(compact('feederUspBar'));
    }

    /**
     * View method
     *
     * @param string|null $id Feeder Usp Bar id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feederUspBar = $this->FeederUspBar->get($id, [
            'contain' => []
        ]);

        $this->set('feederUspBar', $feederUspBar);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feederUspBar = $this->FeederUspBar->newEntity();
        if ($this->request->is('post')) {
            $feederUspBar = $this->FeederUspBar->patchEntity($feederUspBar, $this->request->getData());
            if ($this->FeederUspBar->save($feederUspBar)) {
                $this->Flash->success(__('The feeder usp bar has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder usp bar could not be saved. Please, try again.'));
        }
        $this->set(compact('feederUspBar'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feeder Usp Bar id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feederUspBar = $this->FeederUspBar->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feederUspBar = $this->FeederUspBar->patchEntity($feederUspBar, $this->request->getData());
            if ($this->FeederUspBar->save($feederUspBar)) {
                $this->Flash->success(__('The feeder usp bar has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feeder usp bar could not be saved. Please, try again.'));
        }
        $this->set(compact('feederUspBar'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feeder Usp Bar id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feederUspBar = $this->FeederUspBar->get($id);
        if ($this->FeederUspBar->delete($feederUspBar)) {
            $this->Flash->success(__('The feeder usp bar has been deleted.'));
        } else {
            $this->Flash->error(__('The feeder usp bar could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     */
    public function addColors()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $this->loadModel('CoreConfigurations');
            $uspFontColor = $this->CoreConfigurations->find()
                ->where([
                    'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                    'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                    'CoreConfigurations.configuration_path' => self::USP_BAR_FontColor_CONFIG_PATH
                ])
                ->first();
            if (empty($uspFontColor)) {
                $uspFontColor = $this->CoreConfigurations->newEntity();
                $uspFontColor->set('core_seller_id', $this->Auth->user('core_seller_id'));
                $uspFontColor->set('configuration_group', self::CONFIG_GROUP);
                $uspFontColor->set('configuration_path', self::USP_BAR_FontColor_CONFIG_PATH);
            }
            $uspFontColor->set('configuration_value', $postData['usp_font_color'] ?? '');

            $uspBackgroundColor = $this->CoreConfigurations->find()
                ->where([
                    'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                    'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                    'CoreConfigurations.configuration_path' => self::USP_BAR_BackgroundColor_CONFIG_PATH
                ])
                ->first();
            if (empty($uspBackgroundColor)) {
                $uspBackgroundColor = $this->CoreConfigurations->newEntity();
                $uspBackgroundColor->set('core_seller_id', $this->Auth->user('core_seller_id'));
                $uspBackgroundColor->set('configuration_group', self::CONFIG_GROUP);
                $uspBackgroundColor->set('configuration_path', self::USP_BAR_BackgroundColor_CONFIG_PATH);
            }
            $uspBackgroundColor->set('configuration_value', $postData['usp_background_color'] ?? '');
            $this->set('uspBackgroundColor', $uspBackgroundColor['configuration_value']);
            $this->set('uspFontColor', $uspFontColor['configuration_value']);
            if ($this->CoreConfigurations->save($uspFontColor) && $this->CoreConfigurations->save($uspBackgroundColor)) {
                $this->Flash->success(__('The USP Bar has been saved.'));
                $this->set('uspBackgroundColor', $uspBackgroundColor);
                $this->set('uspFontColor', $uspFontColor);
            } else {
                $this->Flash->error(__('The USP Bar could not be saved. Please, try again.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activate method
     */
    public function activateUsp()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $this->loadModel('CoreConfigurations');

            $uspIsActive = $this->CoreConfigurations->find()
                ->where([
                    'CoreConfigurations.core_seller_id' => $this->Auth->user('core_seller_id'),
                    'CoreConfigurations.configuration_group' => self::CONFIG_GROUP,
                    'CoreConfigurations.configuration_path' => self::USP_BAR_Activation_CONFIG_PATH
                ])
                ->first();
            if (empty($uspIsActive)) {
                $uspIsActive = $this->CoreConfigurations->newEntity();
                $uspIsActive->set('core_seller_id', $this->Auth->user('core_seller_id'));
                $uspIsActive->set('configuration_group', self::CONFIG_GROUP);
                $uspIsActive->set('configuration_path', self::USP_BAR_Activation_CONFIG_PATH);
            }
            $uspIsActive->set('configuration_value', $postData['usp_is_active'] ?? '');
            $this->set('uspIsActive', $uspIsActive['configuration_value']);

            if ($this->CoreConfigurations->save($uspIsActive)) {
                $this->Flash->success(__('The USP Bar activation has been saved.'));
                $this->set('uspIsActive', $uspIsActive);
            } else {
                $this->Flash->error(__('The USP Bar activation could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }
}
