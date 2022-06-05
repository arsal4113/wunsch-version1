<?php
use Migrations\AbstractMigration;

class UpdateOrderTotalCodes extends AbstractMigration
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
        $discount = $this->fetchRow('SELECT id FROM `core_order_total_types` WHERE code = "discount"');

        $this->execute("
	   		    INSERT INTO `core_order_total_codes` (`id`, `core_seller_id`, `core_order_total_type_id`, `code`, `name`, `sort_order`, `created`, `modified`) VALUES
	   		      (NULL, NULL, " . $discount['id'] . ", 'shipping_discount', 'Versandkosten-Rabatt', 2, NOW(), NOW());
	   	");
    }
}
