<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Maintenances Controller
 *
 */
class MaintenancesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }

    public function index()
    {
        if (!Configure::read('maintenance.status')) {
            return $this->redirect('/');
        }
        $this->render('maintenance', 'maintenance');
    }

    public function view($id = null)
    {
        $this->index();
    }


    public function add()
    {
        $this->index();
    }


    public function edit($id = null)
    {
        $this->index();
    }


    public function delete($id = null)
    {
        $this->index();
    }
}
