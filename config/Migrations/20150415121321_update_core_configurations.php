<?php

use Phinx\Migration\AbstractMigration;

class UpdateCoreConfigurations extends AbstractMigration
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
    	$this->execute('ALTER TABLE `core_configurations` CHANGE `core_seller_id` `core_seller_id` INT(11) NULL;');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}