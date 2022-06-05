<?php
use Migrations\AbstractMigration;

class CoreSellerAclForeignKey extends AbstractMigration
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
        $this->table('core_user_roles')
            ->dropForeignKey('core_seller_id')
            ->update();

        $this->table('core_user_roles')
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();

        $this->table('core_users')
            ->dropForeignKey('core_seller_id')
            ->update();

        $this->table('core_users')
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->update();
    }
}
