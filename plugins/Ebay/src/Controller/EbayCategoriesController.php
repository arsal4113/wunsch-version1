<?php
namespace Ebay\Controller;

use Ebay\Controller\AppController;
use Cake\Core\Exception\Exception;

/**
 * EbayCategories Controller
 *
 * @property \Ebay\Model\Table\EbayCategoriesTable $EbayCategories
 */
class EbayCategoriesController extends AppController
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
        $this->paginate = [
            'contain' => ['EbaySites', 'ParentEbayCategories'],
            'order' => ['id' => 'ASC']
        ];

        $this->Prg->commonProcess();

        $availableColumns = $this->EbayCategories->schema()->columns();

        $this->set('ebayCategories', $this->paginate($this->EbayCategories->find('searchable', $this->Prg->parsedParams())));
        $this->set('availableColumns', array_combine($availableColumns, $availableColumns));
        $this->set('_serialize', ['ebayCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Ebay Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ebayCategory = $this->EbayCategories->get($id, [
            'contain' => ['EbaySites', 'ParentEbayCategories.EbaySites', 'ChildEbayCategories.EbaySites']
        ]);
        $this->set('ebayCategory', $ebayCategory);
        $this->set('_serialize', ['ebayCategory']);
    }
}
