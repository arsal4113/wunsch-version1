<?php

use Phinx\Migration\AbstractMigration;

class CoreProductsCoreConfigurableAttributes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $tableName = 'core_products_configurable_attributes';
        if($this->hasTable($tableName)) {
            $this->dropTable($tableName);    
        }
        
        $this->table($tableName)
            ->addColumn('core_product_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('core_product_eav_attribute_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addForeignKey('core_product_id', 'core_products', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('core_product_eav_attribute_id', 'core_product_eav_attributes', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
