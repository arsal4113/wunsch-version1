<?php
use Migrations\AbstractMigration;

class CoreSellerBugfixes extends AbstractMigration
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
        $this->table('core_sellers')
            ->changeColumn('created', 'datetime', ['default' => null, 'null' => true])
            ->changeColumn('modified', 'datetime', ['default' => null, 'null' => true])
            ->update();

        $this->table('core_seller_addresses')
            ->changeColumn('created', 'datetime', ['default' => null, 'null' => true])
            ->changeColumn('modified', 'datetime', ['default' => null, 'null' => true])
            ->update();
    }
}
