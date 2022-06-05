<?php
use Migrations\AbstractMigration;

class CoreOrdersShippingInfoUpdate extends AbstractMigration
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
        $this->table('core_orders')
            ->addColumn('shipping_phone', 'string', ['limit' => 100, 'after' => 'shipping_company'])
            ->save();
    }
}
