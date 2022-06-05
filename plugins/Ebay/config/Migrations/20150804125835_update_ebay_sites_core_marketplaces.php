<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbaySitesCoreMarketplaces extends AbstractMigration
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
        $table = $this->table('ebay_sites');
        $table
        ->addColumn('core_marketplace_id', 'integer', array(
            'limit' => 11,
            'null' => true,
            'after' => 'ebay_global_id',
        ))
        ->addIndex(['core_marketplace_id'])
        ->addForeignKey('core_marketplace_id', 'core_marketplaces', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
        ->update();
    }
}
