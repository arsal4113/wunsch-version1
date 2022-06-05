<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayListerTypes extends AbstractMigration
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
        $table = $this->table('ebay_lister_types');
        $table
        ->addColumn('code', 'string', array(
            'limit' => 45,
            'after' => 'id'
        ))
        ->addIndex(['code'])
        ->update();
    }
}
