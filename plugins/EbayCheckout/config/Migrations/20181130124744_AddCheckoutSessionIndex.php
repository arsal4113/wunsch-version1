<?php

use Migrations\AbstractMigration;

class AddCheckoutSessionIndex extends AbstractMigration
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
        $update = false;
        $table = $this->table('ebay_checkout_sessions');

        if (!$table->hasIndex(['modified'])) {
            $table->addIndex(['modified']);
            $update = true;
        }

        if (!$table->hasIndex(['purchase_order_id'])) {
            $table->addIndex(['purchase_order_id']);
            $update = true;
        }

        if (!$table->hasIndex(['ebay_epn_campaign_id'])) {
            $table->addIndex(['ebay_epn_campaign_id']);
            $update = true;
        }

        if (!$table->hasIndex(['ebay_epn_reference_id'])) {
            $table->addIndex(['ebay_epn_reference_id']);
            $update = true;
        }

        if ($update) {
            $table->update();
        }
    }
}
