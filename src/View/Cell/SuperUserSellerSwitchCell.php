<?php
namespace App\View\Cell;

use App\Model\Entity\CoreUser;
use Cake\View\Cell;

/**
 * SuperUserSellerSwitch cell
 *
 * @property \App\Model\Table\CoreSellersTable $CoreSellers
 */
class SuperUserSellerSwitchCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $coreSellers = false;
        if ($this->request->session()->read('Auth.User.is_super_user') == CoreUser::SUPER_USER) {
            $this->loadModel('CoreSellers');
            $this->CoreSellers->removeBehavior('Ocl');
            $coreSellers = $this->CoreSellers->find('list');
        }
        $this->set('coreSellers', $coreSellers);
    }
}
