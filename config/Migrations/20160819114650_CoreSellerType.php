<?php
use Migrations\AbstractMigration;

class CoreSellerType extends AbstractMigration
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
        $this->table('core_seller_types')
            ->addColumn('code', 'string', ['limit' => 200])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        $this->table('core_sellers')
            ->addColumn('core_seller_type_id', 'integer', ['limit' => 10, 'null' => true, 'default' => null, 'after' => 'core_country_id'])
            ->addIndex(['core_seller_type_id'])
            ->save();
    }
}
