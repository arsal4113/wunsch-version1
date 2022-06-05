<?php

use Migrations\AbstractMigration;

class EbayOAuthTokenExpireTimestamp2 extends AbstractMigration
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
        $table = $this->table('ebay_rest_api_access_tokens');
        if ($table->hasColumn('expire_datetime'))
            $table->removeColumn('expire_datetime')
                ->update();
    }
}
