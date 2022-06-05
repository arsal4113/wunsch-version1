<?php
use Migrations\AbstractMigration;

class NewShippingMethodSpecialDelivery extends AbstractMigration
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
	   		    UPDATE `core_shipping_methods` SET `code` = 'package' WHERE `code` = 'flatrate'
	   	");

        $this->execute("
	   		    INSERT INTO `core_shipping_methods` (`id`, `code`, `name`, `created`, `modified`) VALUES
			      (NULL, 'special_delivery', 'Sonderversand', NOW(), NOW()),
			      (NULL, 'pickup', 'Selbstabholung', NOW(), NOW());
	   	");

    }
}
