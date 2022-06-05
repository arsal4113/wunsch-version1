<?php
use Migrations\AbstractMigration;

class UpdateCoreSellerAddressZip extends AbstractMigration
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
            ->changeColumn('zip_code', 'string', ['limit' => 30, 'default' => null, 'null' => true])
            ->update();
    }
}
