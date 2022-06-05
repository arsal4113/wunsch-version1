<?php
namespace ItoolCustomer\View\Cell;

use Cake\View\Cell;
use ItoolCustomer\Model\Entity\Customer;

/**
 * AccountNavigation cell
 */
class AccountNavigationCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * @param $frontUser Customer
     * @param null $active
     */
    public function display ($frontUser, $active = null)
    {
        $this->set('active', $active);
        $this->set('frontUser', $frontUser);
        $name = '';
        if ($frontUser && !empty($frontUser->first_name)) {
            $name = $frontUser->first_name;
        }
        $this->set('name', $name);
    }
}
