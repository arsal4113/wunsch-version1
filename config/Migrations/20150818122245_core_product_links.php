<?php

use Phinx\Migration\AbstractMigration;

class CoreProductLinks extends AbstractMigration
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
        $table = $this->table('core_product_links');
        $table
            ->addColumn('core_product_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('linked_product_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('core_product_link_type_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_product_id'])
            ->addIndex(['linked_product_id'])
            ->addIndex(['core_product_link_type_id'])
            ->addForeignKey('core_product_id', 'core_products', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('linked_product_id', 'core_products', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('core_product_link_type_id', 'core_product_link_types', 'id', array('delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
