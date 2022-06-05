<?php
use Migrations\AbstractMigration;

class EbayConfigs extends AbstractMigration
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
        $ebayListerType = $this->fetchRow('SELECT id FROM ebay_lister_types WHERE code = "api"');

        $this->execute("
	   		    INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES
	   		      (NULL, NULL, 'Ebay', 'GetSellerEvents/create_listings', '0', NOW(), NOW()),
			    (NULL, NULL, 'Ebay', 'GetSellerEvents/ebay_lister_type_id', '" . $ebayListerType['id'] . "', NOW(), NOW());
	   	");
    }
}
