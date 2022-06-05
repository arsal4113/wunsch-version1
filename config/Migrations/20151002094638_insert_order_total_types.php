<?php
use Migrations\AbstractMigration;

class InsertOrderTotalTypes extends AbstractMigration
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
        $this->execute("
	   		    INSERT INTO `core_order_total_types` (`id`, `code`, `name`, `sort_order`, `created`, `modified`) VALUES
			      (NULL, 'subtotal', 'Zwischensumme', 1, NOW(), NOW()),
			      (NULL, 'shipping', 'Versandkosten', 2, NOW(), NOW()),
			      (NULL, 'tax', 'inkl. MwSt.', 3, NOW(), NOW()),
			      (NULL, 'total', 'Gesamtsumme', 4, NOW(), NOW());
	   	");
    }
}
