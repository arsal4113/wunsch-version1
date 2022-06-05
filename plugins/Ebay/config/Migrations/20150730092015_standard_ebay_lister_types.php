<?php

use Phinx\Migration\AbstractMigration;

class StandardEbayListerTypes extends AbstractMigration
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
        $this->execute("INSERT INTO `ebay_lister_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
            (NULL, 'mip', 'MIP', NOW(), NOW()),
            (NULL, 'api', 'API', NOW(), NOW());"
        );
    }
}
