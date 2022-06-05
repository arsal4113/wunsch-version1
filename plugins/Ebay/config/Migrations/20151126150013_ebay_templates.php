<?php

use Phinx\Migration\AbstractMigration;

class EbayTemplates extends AbstractMigration
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
        $table = $this->table('ebay_templates');
        $table
            ->addColumn('ebay_account_id', 'integer', array(
                'limit' => 11,
                'null' => false
            ))
            ->addColumn('name', 'string', array(
                'limit' => 128,
                'null' => false
            ))
            ->addColumn('template_codes', 'text', array(
                'null' => false
            ))
            ->addColumn('created', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addColumn('modified', 'datetime', array(
                'default' => null,
                'limit' => null,
                'null' => false,
            ))
            ->addIndex(['ebay_account_id'])
            ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
