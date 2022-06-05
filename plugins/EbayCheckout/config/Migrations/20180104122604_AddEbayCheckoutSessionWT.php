<?php
use Migrations\AbstractMigration;

class AddEbayCheckoutSessionWT extends AbstractMigration
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

        $table = $this->table('ebay_checkout_sessions');

        if (!$table->hasColumn('widget_type')) {
            $table
                ->addColumn('widget_type', 'string', [
                    'default' => null,
                    'limit' => 510,
                    'null' => true,
                    'after' => 'ebay_global_id'
                ])->update();
        }
    }
}
