<?php

use Phinx\Migration\AbstractMigration;

class UpdateCoreProductEavAttributes extends AbstractMigration
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
        $table->addColumn('is_configurable', 'boolean', ['default' => null, 'limit' => null, 'null' => false, 'after' => 'sort_order'])
            ->update();
    }
}
