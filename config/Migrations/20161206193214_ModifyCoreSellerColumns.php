<?php
use Migrations\AbstractMigration;

class ModifyCoreSellerColumns extends AbstractMigration
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
            ->changeColumn('name', 'string', ['limit' => 250, 'after' => 'code'])
            ->changeColumn('code', 'string', ['limit' => 250, 'after' => 'core_seller_type_id'])
            ->update();
    }
}
