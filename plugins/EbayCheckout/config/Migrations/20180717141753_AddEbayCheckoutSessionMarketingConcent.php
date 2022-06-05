<?php

use Migrations\AbstractMigration;

class AddEbayCheckoutSessionMarketingConcent extends AbstractMigration
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
        if (!$table->hasColumn('marketing_consent')) {
            $table->addColumn('marketing_consent', 'boolean',
                ['default' => 0, 'null' => true, 'after' => 'type'])->update();
        }
    }
}
