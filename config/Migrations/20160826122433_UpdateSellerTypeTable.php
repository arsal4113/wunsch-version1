<?php
use Migrations\AbstractMigration;

class UpdateSellerTypeTable extends AbstractMigration
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
            ->addColumn('core_user_role_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->addIndex(['core_user_role_id'])
            ->save();
    }
}
