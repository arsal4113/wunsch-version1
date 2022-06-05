<?php

use Migrations\AbstractMigration;
use EbayCheckout\Model\Table\EbayCheckoutSessionsTable;


/**
 * Class EbayCheckoutSessionsPurchaseTimestamp
 * @property EbayCheckoutSessionsTable $EbayCheckoutSessions
 */
class EbayCheckoutSessionsPurchaseTimestamp extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('ebay_checkout_sessions');
        if (!$table->hasColumn('purchase_order_timestamp')) {
            $table
                ->addColumn('purchase_order_timestamp', 'integer', ['limit' => 10, 'default' => null, 'null' => true, 'after' => 'purchase_order_id'])
                ->addIndex(['purchase_order_timestamp'])
                ->update();
        }

        $ranges = [
            '+01:00' => [
                [
                    'from' => '2018-10-28 03:00:00',
                    'to' => '2019-03-31 02:00:00'
                ],
            ],
            '+02:00' => [
                [
                    'from' => '2018-03-25 02:00:00',
                    'to' => '2018-10-28 03:00:00'
                ],
                [
                    'from' => '2019-03-31 02:00:00',
                    'to' => '2019-10-27 03:00:00'
                ]
            ]
        ];
        foreach ($ranges as $timeDrift => $dateRanges) {
            foreach ($dateRanges as $dateRange) {
                $this->execute('UPDATE ebay_checkout_sessions SET purchase_order_timestamp = UNIX_TIMESTAMP(CONVERT_TZ(modified, "' . $timeDrift . '", "SYSTEM")) WHERE purchase_order_id IS NOT NULL AND purchase_order_timestamp IS NULL AND modified >= "' .$dateRange['from'] . '" AND modified <= "' .$dateRange['to'] . '"');
            }
        }
    }
}