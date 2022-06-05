<?php

namespace CatchTheme\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize()
    {
        $this->isFrontend = true;
        parent::initialize();
        $this->loadComponent('Csrf');
    }
}
