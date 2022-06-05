<?php

use Phinx\Migration\AbstractMigration;

class UpdateSellerForeignKeys extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
		$table = $this->table('core_sellers');
		$table
			->addIndex(['is_active'])
			->update();
		
		$table = $this->table('core_marketplaces_core_sellers');
		$table
			->addIndex(['core_marketplace_id'])
			->addIndex(['core_seller_id'])
			->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
			->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
			->update();
		
		$table = $this->table('core_user_roles');
		$table
			->addIndex(['code'])
			->addIndex(['core_seller_id'])
			->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
			->update();
		
		$table = $this->table('core_users');
		$table
			->addIndex(['email'])
			->addIndex(['is_active'])
			->addIndex(['core_seller_id'])
			->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
			->update();
		
		$this->execute("ALTER TABLE `core_users` CHANGE `is_active` `is_active` TINYINT(1) NOT NULL DEFAULT '0' AFTER `core_seller_id`;");
		
		$table = $this->table('core_user_roles_core_users');
		$table
			->addIndex(['core_user_role_id'])
			->addIndex(['core_user_id'])
			->addForeignKey('core_user_role_id', 'core_user_roles', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
			->addForeignKey('core_user_id', 'core_users', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
			->update();
    }
}
