<?php

use Migrations\AbstractMigration;

class AddNewIndexEbayCheckoutSessions extends AbstractMigration
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

        if (!$table->hasIndex(['session_token'])) {
            $table
                ->addIndex(['session_token'])
                ->update();
        }
    }
}
