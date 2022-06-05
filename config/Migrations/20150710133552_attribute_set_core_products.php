<?php

use Phinx\Migration\AbstractMigration;

class AttributeSetCoreProducts extends AbstractMigration
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
        $this->execute("DELETE FROM core_products");
        $table = $this->table('core_products');
        $table->addColumn('core_product_eav_attribute_set_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'core_product_type_id'])
            ->addForeignKey('core_product_eav_attribute_set_id', 'core_product_eav_attribute_sets', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
            ->update();
    }
}
