<?php

use Phinx\Migration\AbstractMigration;

class UpdateCoreOrderShipmentsForUps extends AbstractMigration
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
        $this->table('core_order_shipments')
            ->addColumn('shipping_label', 'string', ['limit' => 512, 'null' => true, 'default' => null, 'after' => 'tracking_link'])
            ->addColumn('shipping_cost', 'decimal', ['precision' => 14, 'scale' => 4, 'after' => 'shipping_label', 'null' => true, 'default' => null])
            ->update();
    }
}
