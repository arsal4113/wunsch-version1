<?php

use Phinx\Migration\AbstractMigration;

class CoreProductEavAttributeSets extends AbstractMigration
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
        $this->execute("DROP TABLE core_product_eav_attribute_set_names");
        
        $tableName = 'core_product_eav_attribute_sets';
        if($this->hasTable($tableName)) {
            $this->dropTable($tableName);
        }
        
        $this->table('core_product_eav_attribute_sets')
            ->addColumn('core_seller_id', 'integer', ['default' => null, 'limit' => 11, 'null' => false])
            ->addColumn('code', 'string', ['default' => null, 'limit' => 128, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 128, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
