<?php
use Migrations\AbstractMigration;

class InsertShipmentStateToConfiguration extends AbstractMigration
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
        $stateCompleted = $this->fetchRow('Select id FROM `core_order_states` WHERE code = "completed"');
        $stateProcessing = $this->fetchRow('Select id FROM `core_order_states` WHERE code = "processing"');

        if(!empty($stateProcessing) && !empty($stateCompleted)) {
            $this->execute("
	   		    INSERT INTO `core_order_statuses` (`id`, `core_order_state_id`, `code`, `name`, `next_allowed_order_status`, `created`, `modified`) VALUES
	   		      (NULL, " . $stateProcessing['id'] . ", 'partial_shipment', 'Teilversandt', NULL ,NOW(), NOW()),
	   		      (NULL, " . $stateCompleted['id'] . ", 'full_shipment', 'Versandt', NULL ,NOW(), NOW());
	   	        ");

            $statusFullShipment = $this->fetchRow('Select id FROM `core_order_statuses` WHERE code = "full_shipment"');
            $statusPartialShipment = $this->fetchRow('Select id FROM `core_order_statuses` WHERE code = "partial_shipment"');

            $this->execute("
	   		    INSERT INTO `core_configurations` (`id`, `core_seller_id`, `configuration_group`, `configuration_path`, `configuration_value`, `created`, `modified`) VALUES
	   		      (NULL, NULL, 'Core', 'Order/shipped_order_state_id', " . $stateCompleted['id'] . " ,NOW(), NOW()),
	   		      (NULL, NULL, 'Core', 'Order/partial_shipped_order_state_id', " . $stateProcessing['id'] . " ,NOW(), NOW()),
	   		      (NULL, NULL, 'Core', 'Order/shipped_order_status_id', " . $statusFullShipment['id'] . " ,NOW(), NOW()),
	   		      (NULL, NULL, 'Core', 'Order/partial_shipped_order_status_id', " . $statusPartialShipment['id'] . " ,NOW(), NOW());
	   	        ");
        }
    }
}
