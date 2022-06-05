<?php
use Migrations\AbstractMigration;

class AddEbayMappingConfigs extends AbstractMigration
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
        $pending = $this->fetchRow('SELECT id, code FROM core_order_states WHERE code LIKE "pending"');
        $processing = $this->fetchRow('SELECT id FROM core_order_states WHERE code LIKE "processing"');

        $checkoutIncomplete = $this->fetchRow('SELECT id FROM core_order_statuses WHERE code LIKE "checkout_incomplete"');
        $paymentIncomplete = $this->fetchRow('SELECT id FROM core_order_statuses WHERE code LIKE "payment_incomplete"');

        $paypalPaymentMethod = $this->fetchRow('SELECT id FROM core_payment_methods WHERE code LIKE "paypal"');
        $banktransferMethod = $this->fetchRow('SELECT id FROM core_payment_methods WHERE code LIKE "banktransfer"');

        $dhlPackageShippingMethod = $this->fetchRow('SELECT id FROM core_shipping_methods WHERE code LIKE "dhl_package"');
        $packageShippingMethod = $this->fetchRow('SELECT id FROM core_shipping_methods WHERE code LIKE "package"');
        $specialDeliveryShippingMethod = $this->fetchRow('SELECT id FROM core_shipping_methods WHERE code LIKE "special_delivery"');
        $expressDeliveryShippingMethod = $this->fetchRow('SELECT id FROM core_shipping_methods WHERE code LIKE "express"');
        $pickupDeliveryShippingMethod = $this->fetchRow('SELECT id FROM core_shipping_methods WHERE code LIKE "pickup"');

        $this->execute("
	   		    INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES
	   		      (NULL, NULL, 'Ebay', 'Order/Mapping/state_for_merging', '" . $pending['code'] . "', NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/state_Incomplete', " . $pending['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/state_Pending', " . $pending['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/state_Complete', " . $pending['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/status_Incomplete', " . $checkoutIncomplete['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/status_Pending', " . $paymentIncomplete['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/status_Complete', " . $paymentIncomplete['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/payment_method_PayPal', " . $paypalPaymentMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/payment_method_MoneyXferAcceptedInCheckout', " . $banktransferMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/payment_method_None', " . $banktransferMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/shipping_method_DE_DHLPaket', " . $dhlPackageShippingMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/shipping_method_DE_Paket', " . $packageShippingMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/shipping_method_DE_SpecialDelivery', " . $specialDeliveryShippingMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/shipping_method_DE_Express', " . $expressDeliveryShippingMethod['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Ebay', 'Order/Mapping/shipping_method_DE_Pickup', " . $pickupDeliveryShippingMethod['id'] . ", NOW(), NOW());
	   	");
    }
}
