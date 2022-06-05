<?php

use Migrations\AbstractMigration;

class AddCheckoutSessionItemOriginalPriceAndTags extends AbstractMigration
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
        $this->table('ebay_checkout_session_items')
            ->addColumn('tags', 'string', [
                'limit' => 512,
                'null' => true,
                'after' => 'attributes'
            ])
            ->addColumn('original_price_value', 'float', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
                'after' => 'base_price_value'
            ])
            ->update();
    }
}
