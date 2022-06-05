<?php

use Phinx\Migration\AbstractMigration;

class CoreLanguageIdCoreSellers extends AbstractMigration
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
        $table = $this->table('core_sellers');
        $table
            ->addColumn('core_language_id', 'integer', array(
                'limit' => 11,
                'null' => false,
                'default' => 1,
                'after' => 'name'
            ))
            ->addIndex(['core_language_id'])
            ->addForeignKey('core_language_id', 'core_languages', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
