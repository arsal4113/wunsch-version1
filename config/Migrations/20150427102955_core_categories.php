<?php

use Phinx\Migration\AbstractMigration;

class CoreCategories extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    	$this->dropTable('core_category_attribute_value_varchars');
    	$this->dropTable('core_category_eav_attributes');
    	$this->dropTable('core_category_eav_attribute_names');
    	$this->dropTable('core_categories');
    	$this->table('core_categories')
    		->addColumn('parent_id', 'integer', ['default' => null, 'limit' => 10, 'null' => true])
    		->addColumn('core_seller_id', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
    		->addColumn('name', 'string', ['default' => null, 'limit' => 250, 'null' => false])
    		->addColumn('description', 'text', ['default' => null, 'null' => true])
    		->addColumn('meta_description', 'text', ['default' => null, 'null' => true])
    		->addColumn('lft', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
    		->addColumn('rght', 'integer', ['default' => null, 'limit' => 10, 'null' => false])
    		->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
    		->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
    	->create();	
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}