<?php

use Phinx\Migration\AbstractMigration;

class CoreProductLinkTypes extends AbstractMigration
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
        $table = $this->table('core_product_link_types');
        $table
            ->addColumn('code', 'string', ['default' => null, 'limit' => 128, 'null' => false])
            ->addColumn('name', 'string', ['default' => null, 'limit' => 128, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['code'])
            ->create();
        
        // Standard values
        $this->execute("INSERT INTO `core_product_link_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
            (NULL, 'cross_selling', 'Cross Selling', NOW(), NOW()),
            (NULL, 'up_selling', 'Up Selling', NOW(), NOW());
        ");
    }
}
