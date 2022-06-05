<?php

use Phinx\Migration\AbstractMigration;

class CoreCategoriesCoreProducts extends AbstractMigration
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
        $this->execute("TRUNCATE core_categories_core_products");
        $this->execute("ALTER TABLE `core_categories_core_products` ADD  FOREIGN KEY (`core_product_id`) REFERENCES `core_products`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
        $this->execute("ALTER TABLE `core_categories_core_products` ADD  FOREIGN KEY (`core_category_id`) REFERENCES `core_categories`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;");
    }
}
