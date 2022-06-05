<?php
use Migrations\AbstractMigration;

class EbayCredentialCleanup extends AbstractMigration
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
        $this->table('ebay_credentials')
            ->addColumn('is_active', 'boolean', ['after' => 'ru_name', 'default' => 1])
            ->addIndex(['is_active'])
            ->update();

        $this->table('ebay_accounts')
            ->changeColumn('ebay_credential_id', 'integer', ['limit' => 10, 'default' => null, 'null' => true, 'after' => 'ebay_account_type_id'])
            ->update();


        $this->execute('DELETE FROM core_configurations WHERE configuration_group = "EbayFashion" AND configuration_path = "Default/EbayAccount/ebay_credential_id"');

    }
}
