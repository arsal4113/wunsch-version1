<?php
use Migrations\AbstractMigration;

class UpdateRestTokenTable extends AbstractMigration
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

        if($table->hasColumn('grant_type')) {
            $table->changeColumn('grant_type', 'string', ['limit' => 100, 'null' => true, 'default' => null, 'after' => 'refresh_token_expire_timestamp'])
                ->update();
        }
    }
}
