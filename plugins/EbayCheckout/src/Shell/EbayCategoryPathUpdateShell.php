<?php


namespace EbayCheckout\Shell;


use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Ebay\Controller\Component\EbayBuyApiComponent;

/**
 * Class EbayCategoryPathUpdateShell
 * @package EbayCheckout\Shell
 * @property \Ebay\Controller\Component\EbayBuyApiComponent $EbayBuyApi
 * @property \EbayCheckout\Model\Table\EbayCheckoutSessionsTable $EbayCheckoutSessions
 */
class EbayCategoryPathUpdateShell extends Shell
{
    public function main()
    {
        $this->EbayCheckoutSessions = TableRegistry::get('EbayCheckout.EbayCheckoutSessions');

        $limit = 100;
        $page = 1;

        $ebayAccount = TableRegistry::get('Ebay.EbayAccounts')->find()
            ->where(['EbayAccounts.is_active' => 1])
            ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
            ->first();

        $this->EbayBuyApi = new EbayBuyApiComponent(new ComponentRegistry());
        $this->EbayBuyApi->setAccount($ebayAccount);
        $processed = [];

        do {
            $purchasedItems = $this->EbayCheckoutSessions->EbayCheckoutSessionItems
                ->find()
                ->select([
                    'EbayCheckoutSessionItems.ebay_item_id'
                ])
                ->contain(['EbayCheckoutSessions'])
                ->where([
                    'EbayCheckoutSessions.modified >' => date('Y-m-d H:i:s', strtotime('-7 days'))
                ])
                ->limit($limit)
                ->page($page++);

            foreach ($purchasedItems as $purchasedItem) {
                $legacyEbayItemId = explode('|', $purchasedItem->ebay_item_id);
                $legacyEbayItemId = $legacyEbayItemId[1] ?? null;

                if (empty($purchasedItem->ebay_category_path) && is_numeric($legacyEbayItemId) && !in_array($legacyEbayItemId, $processed)) {
                    $response = $this->EbayBuyApi->getItem($purchasedItem->ebay_item_id);

                    if (isset($response['errors'])) {
                        continue;
                    }

                    $this->EbayCheckoutSessions->EbayCheckoutSessionItems->updateAll(
                        ['ebay_category_path' => $response['category_path']],
                        ['ebay_item_id LIKE' => '%|' . $legacyEbayItemId . '|%']
                    );
                    $processed[] = $legacyEbayItemId;
                }
            }
        } while ($limit == count($purchasedItems->toArray()));
    }
}