<?php

use Migrations\AbstractMigration;

class AddCheckoutSessionIpIndex extends AbstractMigration
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
        $this->table('ebay_checkout_sessions')
            ->addIndex(['ip'])
            ->update();
    }
}
