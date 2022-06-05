<?php

use Phinx\Migration\AbstractMigration;

class UpdateCoreProductDefaultEavAttributes extends AbstractMigration
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
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `core_marketplace_id` `core_marketplace_id` INT(11) NOT NULL AFTER `id`;");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `core_marketplace_id` `core_marketplace_id` INT(11) NOT NULL DEFAULT '0';");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `code` `code` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD `name` VARCHAR(256) NOT NULL AFTER `code`;");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `data_type` `data_type` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `name`;");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `is_required` `is_required` TINYINT(1) NOT NULL DEFAULT '0';");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` CHANGE `multiple_values` `multiple_values` TINYINT(1) NOT NULL DEFAULT '0';");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD `sort_order` INT(11) NOT NULL DEFAULT '0' AFTER `multiple_values`;");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD `is_configurable` TINYINT(1) NOT NULL DEFAULT '0' AFTER `sort_order`;");
        
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`core_marketplace_id`);");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`code`);");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`data_type`);");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`is_required`);");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`multiple_values`);");
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD INDEX(`is_configurable`);");
        
        $this->execute("ALTER TABLE `core_product_default_eav_attributes` ADD FOREIGN KEY (`core_marketplace_id`) REFERENCES `core_marketplaces`(`id`) ON DELETE RESTRICT ON UPDATE NO ACTION;");
        
        $this->execute("
            INSERT INTO `core_product_default_eav_attributes` (`id`, `core_marketplace_id`, `code`, `name`, `data_type`, `is_required`, `multiple_values`, `sort_order`, `is_configurable`, `created`, `modified`) VALUES
            (NULL, 1, 'ean', 'EAN', 'varchar', 0, 0, 1, 0, '2015-08-03 11:54:30', '2015-08-03 11:54:30'),
            (NULL, 1, 'title', 'Title', 'varchar', 1, 0, 2, 0, '2015-08-03 12:02:46', '2015-08-03 12:02:46'),
            (NULL, 1, 'subtitle', 'Subtitle', 'varchar', 0, 0, 3, 0, '2015-08-03 12:09:35', '2015-08-03 12:09:35'),
            (NULL, 1, 'description', 'Description', 'text', 1, 0, 4, 0, '2015-08-03 12:09:47', '2015-08-03 12:09:47'),
            (NULL, 1, 'short_description', 'Short Description', 'text', 0, 0, 5, 0, '2015-08-03 12:10:03', '2015-08-03 12:10:03'),
            (NULL, 1, 'brand', 'Brand', 'varchar', 1, 0, 6, 0, '2015-08-03 12:10:18', '2015-08-03 12:10:18'),
            (NULL, 1, 'manufacturer', 'Manufacturer', 'varchar', 1, 0, 7, 0, '2015-08-03 12:10:33', '2015-08-03 12:10:33'),
            (NULL, 1, 'manufacturer_number', 'Manufacturer Number', 'varchar', 0, 0, 8, 0, '2015-08-03 12:10:47', '2015-08-03 12:10:47'),
            (NULL, 1, 'condition', 'Condition', 'varchar', 1, 0, 9, 0, '2015-08-03 12:11:20', '2015-08-03 12:11:20'),
            (NULL, 1, 'condition_note', 'Condition Note', 'varchar', 0, 0, 10, 0, '2015-08-03 12:11:34', '2015-08-03 12:11:34'),
            (NULL, 1, 'image', 'Image', 'image', 1, 1, 11, 0, '2015-08-03 12:11:47', '2015-08-03 12:11:55'),
            (NULL, 1, 'price', 'Price', 'decimal', 1, 0, 12, 0, '2015-08-03 12:12:12', '2015-08-03 12:12:12');
        ");
    }
}
