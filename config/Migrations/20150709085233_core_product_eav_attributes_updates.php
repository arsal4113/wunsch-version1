<?php

use Phinx\Migration\AbstractMigration;

class CoreProductEavAttributesUpdates extends AbstractMigration
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
        $table = $this->table('core_product_eav_attributes');
        $table->addColumn('sort_order', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'multiple_values'])
            ->update();
        
        $this->execute("ALTER TABLE `core_product_eav_attribute_groups` DROP FOREIGN KEY `core_product_eav_attribute_groups_ibfk_1`;");
        $this->execute("ALTER TABLE core_product_eav_attribute_groups DROP INDEX core_product_eav_attribute_set_id;");
        $this->execute("ALTER TABLE `core_product_eav_attribute_groups` DROP `core_product_eav_attribute_set_id`;");
        
        $this->table('core_product_eav_attribute_groups_core_product_eav_attributes')
            ->addColumn('core_product_eav_attribute_set_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('core_product_eav_attribute_group_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('core_product_eav_attribute_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addForeignKey('core_product_eav_attribute_set_id', 'core_product_eav_attribute_sets', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION', 'constraint' => 'core_product_eav_attribute_set_id'))
            ->addForeignKey('core_product_eav_attribute_group_id', 'core_product_eav_attribute_groups', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION', 'constraint' => 'core_product_eav_attribute_group_id'))
            ->addForeignKey('core_product_eav_attribute_id', 'core_product_eav_attributes', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION', 'constraint' => 'core_product_eav_attribute_id'))
            ->create();        
    }
}
