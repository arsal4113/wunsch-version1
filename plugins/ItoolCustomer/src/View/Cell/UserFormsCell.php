<?php

namespace ItoolCustomer\View\Cell;

use Cake\View\Cell;

class UserFormsCell extends Cell
{
    protected $_validCellOptions = ['socialLogins'];

    public function display($socialLogins)
    {
        $this->set('socialLogins', $socialLogins);
        $this->set('ajax', $this->request->is('ajax'));
        $this->set('handler', ($this->request->getParam('plugin') ?: '')
            . '-' . ($this->request->getParam('controller') ?: '')
            . '-' . ($this->request->getParam('action') ?: ''));
    }
}
