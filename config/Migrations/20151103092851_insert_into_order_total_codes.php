<?php
use Migrations\AbstractMigration;

class InsertIntoOrderTotalCodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $this->execute('TRUNCATE core_order_total_types;');

        $this->execute("
	   		    INSERT INTO `core_order_total_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'base', 'Basis', NOW(), NOW()),
	   		      (NULL, 'charge', 'Gebühr', NOW(), NOW()),
	   		      (NULL, 'discount', 'Rabatt', NOW(), NOW());
	   	");

        $base = $this->fetchRow('SELECT id FROM `core_order_total_types` WHERE code = "base"');
        $charge = $this->fetchRow('SELECT id FROM `core_order_total_types` WHERE code = "charge"');
        $discount = $this->fetchRow('SELECT id FROM `core_order_total_types` WHERE code = "discount"');

        $this->execute("
	   		    INSERT INTO `core_order_total_codes` (`id`, `core_seller_id`, `core_order_total_type_id`, `code`, `name`, `sort_order`, `created`, `modified`) VALUES
	   		      (NULL, NULL, " . $base['id'] . ", 'subtotal', 'Zwischensumme', 1, NOW(), NOW()),
	   		      (NULL, NULL, " . $discount['id'] . ", 'discount', 'Rabatt', 2, NOW(), NOW()),
	   		      (NULL, NULL, " . $charge['id'] . ", 'shipping', 'Versandkosten', 3, NOW(), NOW()),
	   		      (NULL, NULL, " . $base['id'] . ", 'tax', 'MwSt. %s %', 4, NOW(), NOW()),
	   		      (NULL, NULL, " . $base['id'] . ", 'total', 'Gesamtsumme', 5, NOW(), NOW());
	   	");
    }
}
