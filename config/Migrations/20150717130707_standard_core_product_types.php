<?php

use Phinx\Migration\AbstractMigration;

class StandardCoreProductTypes extends AbstractMigration
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
        $this->execute("DELETE FROM core_product_types");
        $this->execute("ALTER TABLE `core_product_types` auto_increment = 1;");
        $this->execute("INSERT INTO `core_product_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
            (NULL, 'simple', 'Simple Product', '2015-07-03 13:02:05', '2015-07-03 13:02:05'),
            (NULL, 'configurable', 'Configurable Product', '2015-07-03 13:02:16', '2015-07-15 10:44:04');
        ");
    }
}
