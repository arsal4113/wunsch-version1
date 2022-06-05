<?php
use Migrations\AbstractMigration;

class DefaultCancelOrderState extends AbstractMigration
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
        $data = [
            [
                'core_seller_id' => null,
                'configuration_group' => 'Core',
                'configuration_path' => 'Order/full_cancelled_order_state_id',
                'configuration_value' => 4,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'core_seller_id' => null,
                'configuration_group' => 'Core',
                'configuration_path' => 'Order/full_cancelled_order_status_id',
                'configuration_value' => 8,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]
        ];

        $this->insert('core_configurations', $data);
    }
}
