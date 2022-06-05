<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('ebay_checkout_session_billing_addresses')
            ->addColumn('ebay_checkout_session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('address_line_1', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('address_line_2', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('country', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('county', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('postal_code', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('state_or_province', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_item_promotions')
            ->addColumn('ebay_checkout_session_item_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('discount_currency', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('discount_value', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
            ])
            ->addColumn('message', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('promotion_code', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('promotion_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_item_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_item_shippings')
            ->addColumn('ebay_checkout_session_item_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('base_delivery_cost_currency', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('base_delivery_cost_value', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
            ])
            ->addColumn('delivery_discount_currency', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('delivery_discount_value', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
            ])
            ->addColumn('max_estimated_delivery_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('min_estimated_delivery_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('selected', 'integer', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('shipping_carrier_code', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('shipping_option_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('shipping_service_code', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_item_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_items')
            ->addColumn('ebay_checkout_session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('selected_ebay_checkout_session_item_shipping_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('title', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('short_description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('base_price_currency', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('base_price_value', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
            ])
            ->addColumn('image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('ebay_item_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('ebay_line_item_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('net_price_currency', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('net_price_value', 'decimal', [
                'default' => null,
                'null' => true,
                'precision' => 12,
                'scale' => 4,
            ])
            ->addColumn('quantity', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('seller_username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('seller_account_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('seller_feedback_score', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('seller_feedback_percentage', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_id',
                ]
            )
            ->addIndex(
                [
                    'selected_ebay_checkout_session_item_shipping_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_payment_brands')
            ->addColumn('ebay_checkout_session_payment_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('payment_method_brand_type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_payment_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_payment_messages')
            ->addColumn('ebay_checkout_session_payment_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('legal_message', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('required_for_user_confirmation', 'integer', [
                'default' => null,
                'limit' => 4,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_payment_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_payments')
            ->addColumn('ebay_checkout_session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('payment_method_tyoe', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('label', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('logo', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('additional_data', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_shipping_addresses')
            ->addColumn('ebay_checkout_session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('recipient', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('address_line_1', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('address_line_2', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('city', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('country', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('phone_number', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('postal_code', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('state_or_province', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_sessions')
            ->addColumn('core_seller_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('core_order_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('ebay_checkout_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('selected_ebay_checkout_session_payment_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('session_token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('ebay_checkout_session_id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'core_order_id',
                ]
            )
            ->addIndex(
                [
                    'core_seller_id',
                ]
            )
            ->addIndex(
                [
                    'ebay_checkout_id',
                ]
            )
            ->addIndex(
                [
                    'selected_ebay_checkout_session_payment_id',
                ]
            )
            ->create();

        $this->table('ebay_checkouts')
            ->addColumn('core_seller_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('logo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('main_color', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => true,
            ])
            ->addColumn('second_color', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => true,
            ])
            ->addColumn('font', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('font_color', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => true,
            ])
            ->addColumn('background_image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('background_image_position', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('background_color', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'core_seller_id',
                ]
            )
            ->create();

        $this->table('ebay_checkout_session_billing_addresses')
            ->addForeignKey(
                'ebay_checkout_session_id',
                'ebay_checkout_sessions',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_item_promotions')
            ->addForeignKey(
                'ebay_checkout_session_item_id',
                'ebay_checkout_session_items',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_item_shippings')
            ->addForeignKey(
                'ebay_checkout_session_item_id',
                'ebay_checkout_session_items',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_items')
            ->addForeignKey(
                'ebay_checkout_session_id',
                'ebay_checkout_sessions',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'selected_ebay_checkout_session_item_shipping_id',
                'ebay_checkout_session_item_shippings',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'SET_NULL'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_payment_brands')
            ->addForeignKey(
                'ebay_checkout_session_payment_id',
                'ebay_checkout_session_payments',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_payment_messages')
            ->addForeignKey(
                'ebay_checkout_session_payment_id',
                'ebay_checkout_session_payments',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_payments')
            ->addForeignKey(
                'ebay_checkout_session_id',
                'ebay_checkout_sessions',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_session_shipping_addresses')
            ->addForeignKey(
                'ebay_checkout_session_id',
                'ebay_checkout_sessions',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('ebay_checkout_sessions')
            ->addForeignKey(
                'core_order_id',
                'core_orders',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'core_seller_id',
                'core_sellers',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'ebay_checkout_id',
                'ebay_checkouts',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'selected_ebay_checkout_session_payment_id',
                'ebay_checkout_session_payments',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'SET_NULL'
                ]
            )
            ->update();

        $this->table('ebay_checkouts')
            ->addForeignKey(
                'core_seller_id',
                'core_sellers',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('ebay_checkout_session_billing_addresses')
            ->dropForeignKey(
                'ebay_checkout_session_id'
            );

        $this->table('ebay_checkout_session_item_promotions')
            ->dropForeignKey(
                'ebay_checkout_session_item_id'
            );

        $this->table('ebay_checkout_session_item_shippings')
            ->dropForeignKey(
                'ebay_checkout_session_item_id'
            );

        $this->table('ebay_checkout_session_items')
            ->dropForeignKey(
                'ebay_checkout_session_id'
            )
            ->dropForeignKey(
                'selected_ebay_checkout_session_item_shipping_id'
            );

        $this->table('ebay_checkout_session_payment_brands')
            ->dropForeignKey(
                'ebay_checkout_session_payment_id'
            );

        $this->table('ebay_checkout_session_payment_messages')
            ->dropForeignKey(
                'ebay_checkout_session_payment_id'
            );

        $this->table('ebay_checkout_session_payments')
            ->dropForeignKey(
                'ebay_checkout_session_id'
            );

        $this->table('ebay_checkout_session_shipping_addresses')
            ->dropForeignKey(
                'ebay_checkout_session_id'
            );

        $this->table('ebay_checkout_sessions')
            ->dropForeignKey(
                'core_order_id'
            )
            ->dropForeignKey(
                'core_seller_id'
            )
            ->dropForeignKey(
                'ebay_checkout_id'
            )
            ->dropForeignKey(
                'selected_ebay_checkout_session_payment_id'
            );

        $this->table('ebay_checkouts')
            ->dropForeignKey(
                'core_seller_id'
            );

        $this->dropTable('ebay_checkout_session_billing_addresses');
        $this->dropTable('ebay_checkout_session_item_promotions');
        $this->dropTable('ebay_checkout_session_item_shippings');
        $this->dropTable('ebay_checkout_session_items');
        $this->dropTable('ebay_checkout_session_payment_brands');
        $this->dropTable('ebay_checkout_session_payment_messages');
        $this->dropTable('ebay_checkout_session_payments');
        $this->dropTable('ebay_checkout_session_shipping_addresses');
        $this->dropTable('ebay_checkout_sessions');
        $this->dropTable('ebay_checkouts');
    }
}
