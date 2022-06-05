<?php

namespace Feeder\Shell;

use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Ebay\Controller\Component\EbayBuyApiComponent;
use Feeder\Model\Table\FeederHeroItemsTable;
use Ebay\Model\Table\EbayAccountsTable;

/**
 * CheckHeroItemsOutOfStock shell command.
 *
 * @property EbayAccountsTable $EbayAccounts
 * @property EbayBuyApiComponent EbayBuyApi
 * @property FeederHeroItemsTable FeederHeroItems
 */
class CheckHeroItemsOutOfStockShell extends Shell
{
    private $EbayBuyApi;

    /**
     * @see \Cake\Console\Shell::initialize()
     */
    public function initialize()
    {
        parent::initialize();

        $componentRegistry = new ComponentRegistry();
        $this->EbayBuyApi = new EbayBuyApiComponent($componentRegistry);

        $this->loadModel('Feeder.FeederHeroItems');
        $this->loadModel('Ebay.EbayAccounts');
    }

    /**
     * main() method.
     */
    public function main()
    {
        /** @var \Ebay\Model\Entity\EbayAccount $ebayAccount */
        $ebayAccount = $this->EbayAccounts->find()
            ->where(['EbayAccounts.is_active' => 1])
            ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
            ->first();

        if (!empty($ebayAccount)) {
            $this->out(__('Using EbayAccount "{0}" with id {1}', $ebayAccount->name, $ebayAccount->id));
            $this->EbayBuyApi->setAccount($ebayAccount);
        } else {
            $this->out(__('EbayAccount missing'));
            return;
        }

        do {
            $heroItem = $this->FeederHeroItems->find()
                ->where(function (QueryExpression $exp, Query $q) {
                    return $exp->or([
                        $q->newExpr($exp->equalFields('FeederHeroItems.modified', 'FeederHeroItems.created')),
                        'FeederHeroItems.modified <=' => new Time(strtotime('-1 hour'))
                    ]);
                })
                ->first();

            if (!empty($heroItem)) {
                $itemId = trim($heroItem->item_id);
                $heroUrl = trim($heroItem->url);

                $isActive = 1;
                if (empty($heroUrl) && !empty($itemId)) {
                    $isActive = 0;
                    $itemTitle = null;
                    $itemCategoryId = null;

                    try {
                        $ebayItem = $this->EbayBuyApi->getItem($itemId);

                        if (!isset($ebayItem['errors'])) {
                            $itemTitle = $ebayItem['title'] ?? null;
                            $itemCategoryId = $ebayItem['category_id'] ?? null;

                            foreach ($ebayItem['items'] as $item) {
                                $itemEndDate = $item['item_end_date'] ?? null;

                                if (empty($itemEndDate) || strtotime($itemEndDate) > time()) {
                                    $itemQuantity = $item['quantity'] ?? 0;
                                    if ($itemQuantity > 0) {
                                        $isActive = 1;
                                        break;
                                    }
                                }
                            }
                        }
                    } catch (\Exception $exp) {
                        $this->out($exp->getMessage());
                        $isActive = 0;
                    }
                }

                if ($isActive) {
                    $this->out(__('hero item {0} is not out of stock', [$itemId]));
                } else {
                    $this->out(__('hero item {0} is out of stock', [$itemId]));
                }

                $heroItem->is_active = $isActive;

                if (!empty($itemTitle)) {
                    $heroItem->title = preg_replace('/[[:^print:]]/', '', $itemTitle);
                }
                if (!empty($itemCategoryId)) {
                    $heroItem->category_id = $itemCategoryId;
                }
                $this->FeederHeroItems->save($heroItem);
            }
        } while (!empty($heroItem));
    }
}
