<?php
use Migrations\AbstractMigration;

class RegisterDefaultCoreSellerType extends AbstractMigration
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
            'core_seller_id' => null,
            'configuration_group' => 'Core',
            'configuration_path' => 'Register/default_core_seller_type',
            'configuration_value' => 'free',
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ];
        $this->insert('core_configurations', $data);
    }
}
