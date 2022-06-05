<?php
namespace Dashboard\View\Cell;

use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\View\Cell;
use ItoolCustomer\Model\Table\CustomersTable;

/**
 * Customers cell
 */
class CustomersCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */

    protected $_validCellOptions = [];

    /**
     * Number of Customers method.
     *
     * @param string $dashboardType
     * @param integer $currentSellerId
     * @param integer $currentUserId
     * @return void
     */
    public function numberOfCustomers($dashboardType, $currentSellerId, $currentUserId)
    {
        /** @var CustomersTable $customers */
        $customers = $this->loadModel('ItoolCustomer.Customers');

        switch($dashboardType) {
            case "user":
                $identifier['core_user_id'] = $currentUserId;
                break;
            case "seller":
                $identifier['core_seller_id'] = $currentSellerId;
                break;
        }

        $activeCustomers = $customers->find()
            ->where(['is_active' => 1, 'is_deleted' => 0]);

        $numberOfCustomers = new \stdClass();
        $numberOfCustomers->total = (clone $activeCustomers)->count();

        $numberOfCustomers->quarter = (clone $activeCustomers)->where([
            'created >' => Time::now()->toQuarter(true)[0],
            'created <=' => Time::now()->toQuarter(true)[1]
        ])->count();

        $numberOfCustomers->ebay = (clone $activeCustomers)->where(['ebay_registered' => 1])->count();

        $numberOfCustomers->catch = (clone $activeCustomers)->where(['ebay_registered' => 0])
            ->notMatching('SocialProfiles',  function (Query $q) {
                return $q;
        })->count();

        $numberOfCustomers->fb = (clone $activeCustomers)->matching('SocialProfiles',  function (Query $q) {
            return $q->where(['SocialProfiles.provider' => 'facebook']);
        })->count();

        $numberOfCustomers->google = (clone $activeCustomers)->matching('SocialProfiles',  function (Query $q) {
            return $q->where(['SocialProfiles.provider' => 'google']);
        })->count();

        $numberOfCustomers->twitter = (clone $activeCustomers)->matching('SocialProfiles',  function (Query $q) {
            return $q->where(['SocialProfiles.provider' => 'twitter']);
        })->count();

        $numberOfCustomers->instagram = (clone $activeCustomers)->matching('SocialProfiles',  function (Query $q) {
            return $q->where(['SocialProfiles.provider' => 'instagram']);
        })->count();

        $this->set(compact('numberOfCustomers'));
    }
}
