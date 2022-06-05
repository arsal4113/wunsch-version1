<?php

use Migrations\AbstractMigration;

class UpdateEbayRestApiAccessTokens extends AbstractMigration
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
        if (!$table->hasColumn('token_type')) {
            $table
                ->addColumn('token_type', 'string', ['limit' => 50, 'after' => 'grant_type'])
                ->addIndex(['token_type'])
                ->update();
        }

        if (!$table->hasColumn('token_expire_timestamp')) {
            $table
                ->addColumn('token_expire_timestamp', 'text', ['null' => true, 'default' => null, 'after' => 'expire_timestamp'])
                ->update();
        }

        if (!$table->hasColumn('refresh_token')) {
            $table
                ->addColumn('refresh_token', 'text', ['null' => true, 'default' => null, 'after' => 'token_expire_timestamp'])
                ->update();
        }

        if (!$table->hasColumn('refresh_token_expire_timestamp')) {
            $table
                ->addColumn('refresh_token_expire_timestamp', 'integer', ['null' => true, 'default' => null, 'after' => 'refresh_token'])
                ->update();
        }

        if (!$table->hasColumn('user_identifier')) {
            $table
                ->addColumn('user_identifier', 'integer', ['null' => true, 'default' => null, 'after' => 'ebay_account_id'])
                ->addIndex(['user_identifier'])
                ->update();
        }
    }
}
