<?php
use Migrations\AbstractMigration;

class AddEbayCheckoutSessionCcEgi extends AbstractMigration
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
        $this->table('ebay_checkout_sessions')
            ->addColumn('country_code', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
                'after' => 'last_name'
            ])
            ->addColumn('ebay_global_id', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
                'after' => 'country_code'
            ])->update();
    }
}
