<?php
use Migrations\AbstractMigration;

class CoreSellerColumnsSort extends AbstractMigration
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
            ->changeColumn('core_seller_type_id', 'integer', ['limit' => 10, 'null' => true, 'default' => null, 'after' => 'id'])
            ->changeColumn('core_language_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->changeColumn('core_country_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->update();
    }
}
