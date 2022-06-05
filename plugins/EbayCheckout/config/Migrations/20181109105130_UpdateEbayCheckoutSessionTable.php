<?php

use Migrations\AbstractMigration;

class UpdateEbayCheckoutSessionTable extends AbstractMigration
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

        if (!$table->hasColumn('ebay_epn_campaign_id')) {
            $update = true;
            $table
                ->addColumn('ebay_epn_campaign_id', 'string', ['limit' => 250, 'null' => true, 'default' => null, 'after' => 'ebay_global_id']);
        }

        if (!$table->hasColumn('ebay_epn_reference_id')) {
            $update = true;
            $table
                ->addColumn('ebay_epn_reference_id', 'string', ['limit' => 250, 'null' => true, 'default' => null, 'after' => 'ebay_global_id']);
        }

        if (!$table->hasColumn('ebay_app_id')) {
            $update = true;
            $table
                ->addColumn('ebay_app_id', 'string', ['limit' => 250, 'null' => true, 'default' => null, 'after' => 'ebay_global_id']);
        }
        if ($update) {
            $table->update();
        }
    }
}
