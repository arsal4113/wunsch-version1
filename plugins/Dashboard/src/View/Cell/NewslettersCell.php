<?php
namespace Dashboard\View\Cell;

use Cake\View\Cell;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * Newsletters cell
 * @property CustomersTable $Customers
 */
class NewslettersCell extends Cell
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
    public function numberOfNewsletters($dashboardType, $currentSellerId, $currentUserId)
    {
        /** @var NewslettersTable $newsletters */
        $newsletters = $this->loadModel('ItoolCustomer.Newsletters');

        switch($dashboardType) {
            case "user":
                $identifier['core_user_id'] = $currentUserId;
                break;
            case "seller":
                $identifier['core_seller_id'] = $currentSellerId;
                break;
        }

        $numberOfNewsletters = new \stdClass();
        $numberOfNewsletters->total = $newsletters->find()->where(['subscribed' => 1])->select(['email'])->distinct(['email'])->count();

        $this->set(compact('numberOfNewsletters'));
    }


    public function emarsysSubscribers($dashboardType, $currentSellerId, $currentUserId)
    {
        $this->loadModel('ItoolCustomer.Customers');

        $customers = $this->Customers->find()
            ->innerJoin(
                ['Newsletters' => 'newsletters'],
                ['Newsletters.email = Customers.email', 'Newsletters.subscribed = 1']);

        $numberOfSubscribers = new \stdClass();
        $numberOfSubscribers->total = $customers->count();

        $this->set(compact('numberOfSubscribers'));
    }
}
