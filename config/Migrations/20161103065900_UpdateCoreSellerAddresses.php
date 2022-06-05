<?php
use Migrations\AbstractMigration;

class UpdateCoreSellerAddresses extends AbstractMigration
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
        $this->table('core_seller_addresses')
            ->changeColumn('core_country_id', 'integer', ['limit' => 10, 'null' => true ,'default' => null, 'after' => 'core_seller_id'])
            ->changeColumn('website', 'string', ['limit' => 250, 'null' => true, 'default' => null, 'after' => 'company_name'])
            ->update();
    }
}
