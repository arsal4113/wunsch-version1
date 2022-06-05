<?php

use Phinx\Migration\AbstractMigration;

class UpdateRenderTemplateForAttributes extends AbstractMigration
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
        $table = $this->table('core_product_eav_attribute_groups');
        $table
            ->addColumn('render_template', 'string', ['null' => true, 'limit' => 128, 'after' => 'name'])
            ->update();
        
        $table = $this->table('core_product_default_eav_attributes');
        $table
            ->addColumn('data_loader', 'string', ['null' => true, 'limit' => 128, 'after' => 'data_type'])
            ->update();
        
        $table = $this->table('core_product_eav_attributes');
        $table
            ->addColumn('data_loader', 'string', ['null' => true, 'limit' => 128, 'after' => 'data_type'])
            ->update();        
    }
}
