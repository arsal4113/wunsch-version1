<?php
use Migrations\AbstractMigration;

class EbayOAuthTokenExpireTimestamp extends AbstractMigration
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
        $this->table('ebay_rest_api_access_tokens')
            ->addColumn('expire_timestamp', 'integer', ['limit' => 10, 'after' => 'token', 'default' => null, 'null' => true])
            ->update();
    }
}
