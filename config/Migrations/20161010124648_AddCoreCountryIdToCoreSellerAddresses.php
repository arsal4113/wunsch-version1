<?php
use Migrations\AbstractMigration;

class AddCoreCountryIdToCoreSellerAddresses extends AbstractMigration
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
        $table = $this->table('core_seller_addresses');
        $table->addColumn('core_country_id', 'integer', [
            'limit' => 10
        ]);
        $table->addIndex(['core_country_id']);
        $table->update();
    }
}
