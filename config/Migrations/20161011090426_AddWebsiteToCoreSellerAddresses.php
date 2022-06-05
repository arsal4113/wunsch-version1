<?php
use Migrations\AbstractMigration;

class AddWebsiteToCoreSellerAddresses extends AbstractMigration
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
        $table->addColumn('website', 'string', [
            'limit' => 255
        ]);
        $table->update();
    }
}
