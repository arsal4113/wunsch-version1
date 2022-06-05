<?php
use Migrations\AbstractMigration;

class InsertIntoConfigs extends AbstractMigration
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
	   		    INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES
	   		      (NULL, NULL, 'Ebay', 'Order/Mapping/charge_type_ShippingServiceCost', '{\"code\":\"shipping\",\"required\":true,\"is_amount_incl_tax\":true}', NOW(), NOW());
	   	");
    }
}
