<?php

use Phinx\Migration\AbstractMigration;

class ActiveUserUpdate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     */
    public function change()
    {
    	$table = $this->table('core_users');
        $table
        	->addColumn('is_active', 'boolean', [
        		'default' => 0,
            	'limit' => null,
            	'null' => false,
			])
			->addIndex(array('is_active'))
        	->update();
    }
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}