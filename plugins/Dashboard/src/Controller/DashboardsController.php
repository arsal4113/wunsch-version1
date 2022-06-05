<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * Dashboards Controller
 *
 * @property \App\Model\Table\CoreSellersTable $CoreSellers
 * @property \Dashboard\Model\Table\DashboardConfigurationsTable $DashboardConfigurations
 */
class DashboardsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        try {
            $this->loadModel('CoreSellers');
            $this->loadModel('Dashboard.DashboardConfigurations');

            $currentSellerId = $this->currentUser['core_seller_id'];
            $currentUserId = $this->currentUser['id'];

            if (isset($_SESSION['Auth']['User']['super_user_core_seller_id']) && !empty($_SESSION['Auth']['User']['super_user_core_seller_id'])) {
                $currentSellerId = $_SESSION['Auth']['User']['super_user_core_seller_id'];
            }

            // Get seller data
            $sellerData = $this->CoreSellers->get($currentSellerId);

            // Get dashboard type
            $userDashboard = $this->request->cookie('user_dashboard');
            if (isset($userDashboard) && $userDashboard == 'on') {
                $dashboardType = 'user';
            } else {
                $dashboardType = 'seller';
            }

            // User configuration
            $conditions = [
                'DashboardConfigurations.core_seller_id' => $currentSellerId,
                'DashboardConfigurations.core_user_id' => $currentUserId,
            ];
            $userDashboardConfigurations = $this->DashboardConfigurations->find()->where($conditions)->order(['DashboardConfigurations.sort_order' => 'ASC'])->all()->toArray();

            // Seller configuration
            if (empty($userDashboardConfigurations)) {
                $conditions = [
                    'DashboardConfigurations.core_seller_id' => $currentSellerId,
                    'DashboardConfigurations.core_user_id IS' => null
                ];
                $userDashboardConfigurations = $this->DashboardConfigurations->find()->where($conditions)->order(['DashboardConfigurations.sort_order' => 'ASC'])->all()->toArray();
            }

            // Seller Type configuration
            if (empty($userDashboardConfigurations)) {
                $this->DashboardConfigurations->removeBehavior('Ocl');

                $conditions = [
                    'DashboardConfigurations.core_seller_type_id' => $sellerData->core_seller_type_id,
                    'DashboardConfigurations.core_seller_id IS' => null,
                    'DashboardConfigurations.core_user_id IS' => null
                ];
                $userDashboardConfigurations = $this->DashboardConfigurations->find()->where($conditions)->order(['DashboardConfigurations.sort_order' => 'ASC'])->all()->toArray();

                $this->DashboardConfigurations->addBehavior('Ocl');
            }

            $this->set(compact('dashboardType', 'currentSellerId', 'currentUserId', 'userDashboardConfigurations'));
        } catch (\Exception $exp) {
            $this->Flash->error(__($exp->getMessage()));
        }
    }
}
