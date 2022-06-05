<?php
use Migrations\AbstractMigration;

class Update extends AbstractMigration
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
        $this->table('core_payment_methods')
            ->removeColumn('is_active')
            ->update();

        $this->execute("
	   		    INSERT INTO `core_payment_methods` (`id`, `code`, `name`, `created`, `modified`) VALUES
			      (NULL, 'paypal', 'PayPal', NOW(), NOW()),
			      (NULL, 'banktransfer', 'Überweisung', NOW(), NOW()),
			      (NULL, 'cash_on_delivery', 'Nachnahme', NOW(), NOW());
	   	");

        $this->execute("
	   		    INSERT INTO `core_carriers` (`id`, `code`, `name`, `tracking_link`, `created`, `modified`) VALUES
			      (NULL, 'dhl', 'DHL', 'https://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc={tracking_code}&rfn=&extendedSearch=true', NOW(), NOW()),
			      (NULL, 'dpd', 'DPD', 'https://tracking.dpd.de/parcelstatus?query={tracking_code}&locale=de_DE', NOW(), NOW());
	   	");

        $this->table('core_shipping_methods')
            ->removeColumn('core_carrier_id')
            ->removeColumn('is_active')
            ->update();

        $this->execute("
	   		    INSERT INTO `core_shipping_methods` (`id`, `code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'flatrate', 'Paketversand', NOW(), NOW()),
	   		      (NULL, 'free_shipping', 'Versandkostenfrei', NOW(), NOW()),
	   		      (NULL, 'express', 'Expressversand', NOW(), NOW()),
	   		      (NULL, 'gls', 'GLS Versand', NOW(), NOW()),
			      (NULL, 'dhl_package', 'DHL Paket', NOW(), NOW()),
			      (NULL, 'dpd_package', 'DPD Paket', NOW(), NOW());
	   	");

        $this->execute("
	   		    INSERT INTO `core_order_states` (`id`, `code`, `name`, `created`, `modified`) VALUES
			      (NULL, 'pending', 'Offen', NOW(), NOW()),
			      (NULL, 'processing', 'In Bearbeitung', NOW(), NOW()),
			      (NULL, 'completed', 'Abgeschlossen', NOW(), NOW()),
			      (NULL, 'canceled', 'Storniert', NOW(), NOW());
	   	");

        $this->table('core_order_statuses')
            ->addColumn('next_allowed_order_status', 'text', ['after' => 'name', 'default' => null, 'null' => true])
            ->update();

        $pending = $this->fetchRow('SELECT id FROM core_order_states WHERE code LIKE "pending"');
        $processing = $this->fetchRow('SELECT id FROM core_order_states WHERE code LIKE "processing"');

        $this->execute("
	   		    INSERT INTO `core_order_statuses` (`id`, `core_order_state_id`, `code`, `name`, `created`, `modified`) VALUES
			      (NULL, " . $pending['id'] . ", 'checkout_incomplete', 'Kauf nicht abgeschlossen', NOW(), NOW()),
			      (NULL, " . $pending['id'] . ", 'payment_incomplete', 'Ausstehende Zahlung', NOW(), NOW()),
			      (NULL, " . $pending['id'] . ", 'invoice_address_incomplete', 'Rechnungsadresse unvollständig', NOW(), NOW()),
			      (NULL, " . $pending['id'] . ", 'partial_payment', 'Teilzahlung', NOW(), NOW()),
			      (NULL, " . $processing['id'] . ", 'full_payment', 'Zahlung erhalten', NOW(), NOW());
	   	");

        $paid = $this->fetchRow('SELECT id FROM core_order_statuses WHERE code LIKE "partial_payment"');
        $partialPaid = $this->fetchRow('SELECT id FROM core_order_statuses WHERE code LIKE "full_payment"');

        $this->execute("
	   		    INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES
			      (NULL, NULL, 'Core', 'Order/paid_order_state_id', " . $processing['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Core', 'Order/paid_order_status_id', " . $paid['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Core', 'Order/partial_paid_order_state_id', " . $pending['id'] . ", NOW(), NOW()),
			      (NULL, NULL, 'Core', 'Order/partial_paid_order_status_id', " . $partialPaid['id'] . ", NOW(), NOW());
	   	");

    }
}
