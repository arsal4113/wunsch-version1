<?php

use Phinx\Migration\AbstractMigration;

class UpdateCoreProductAttributeValueImages extends AbstractMigration
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
        $table = $this->table('core_product_attribute_value_images');
        $table->addColumn('sort_order', 'integer', ['default' => null, 'limit' => 11, 'null' => false, 'after' => 'value'])
            ->update();
    }
}
