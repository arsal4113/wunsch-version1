<?php

namespace Ebay\Shell\Task;

use Cake\Console\Shell;
use Cake\Core\Exception\Exception;
use Cake\Controller\ComponentRegistry;
use Ebay\Controller\Component\EbayTradingApiComponent;
use Ebay\Model\Table\EbayCategoriesTable;
use Cake\Console\ConsoleOptionParser;

/**
 * DownloadCategories Task
 *
 * This task can be used to import eBay categories into database.
 * @property EbayCategoriesTable $EbayCategories
 * @property EbayTradingApiComponent $EbayTradingApi
 */
class DownloadCategoriesTask extends Shell
{
    /**
     * Ebay Trading API Component
     *
     * @var Component
     */
    public $EbayTradingApi;

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Ebay.EbayCategories');

        $component = new ComponentRegistry();
        $this->EbayTradingApi = new EbayTradingApiComponent($component);
    }

    /**
     * main() method.
     *
     * @return bool
     */
    public function main()
    {
        $conditions = [];
        if (!empty($this->args[0]) || $this->args[0] !== 0) {
            $conditions['ebay_site_id'] = $this->args[0];
        }

        $ebaySites = $this->EbayCategories->EbaySites->find('all', [
            'conditions' => $conditions,
            'contain' => ['EbayAccounts', 'EbayAccounts.EbayCredentials', 'EbayAccounts.EbaySites', 'EbayAccounts.EbayAccountTypes']
        ]);

        if (!empty($ebaySites)) {
            foreach ($ebaySites as $ebaySite) {
                try {
                    if (isset($ebaySite->ebay_accounts[0])) {
                        $this->out('<info>Download eBay category from this eBay site: "' . $ebaySite->name . '"</info>');

                        $this->EbayTradingApi->initSession($ebaySite->ebay_accounts[0]);
                        $ebayCategories = $this->EbayTradingApi->getCategories(['categorySiteId' => $ebaySite['ebay_site_id'], 'detailLevel' => 'ReturnAll']);
                        if (!empty($ebayCategories)) {
                            $categoryVersion = (string)$ebayCategories->CategoryVersion;
                            foreach ($ebayCategories->CategoryArray->Category as $ebayCategory) {
                                // Set parent ID
                                $parentId = null;
                                if ((string)$ebayCategory->CategoryParentID != (string)$ebayCategory->CategoryID) {
                                    $eBayParentId = (string)$ebayCategory->CategoryParentID;
                                    $parentCategory = $this->EbayCategories->getCategoryByEbayCategoryId($ebaySite->id, $eBayParentId);
                                    if (!empty($parentCategory)) {
                                        $parentId = $parentCategory->id;
                                    }
                                }

                                // Create / update eBay category
                                $data = [
                                    'ebay_site_id' => $ebaySite->id,
                                    'ebay_category_id' => (string)$ebayCategory->CategoryID,
                                    'parent_id' => $parentId,
                                    'category_level' => (string)$ebayCategory->CategoryLevel,
                                    'name' => (string)$ebayCategory->CategoryName,
                                    'version' => $categoryVersion
                                ];
                                $this->EbayCategories->saveEbayCategory($data);
                                $this->out('<success>eBay category: "' . (string)$ebayCategory->CategoryName . '" has been saved.</success>');
                            }
                        }
                    }
                } catch (Exception $e) {
                    $this->out('<error>' . $e->getMessage() . '</error>');
                }
            }
        }
    }

    /**
     * GetOptionParser method.
     *
     * @return ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('ebay_site_id', [
            'help' => 'A valid ebay site ID e.g. 77 for Ebay-DE'
        ])->setDescription('<info>' . __('Task to import eBay categories.') . '</info>');
        return $parser;
    }
}
