<?php
use Migrations\AbstractMigration;

class SaveCheckoutItemsLegacyOrderId extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('ebay_checkout_session_items');
        if (!$table->hasColumn('legacy_order_id')) {
            $table->addColumn('legacy_order_id', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
                'after' => 'ebay_line_item_id'
            ])
                ->addIndex(['legacy_order_id'])
                ->update();
        }
    }

    public function down()
    {
    }
}
