<?php

use Phinx\Migration\AbstractMigration;

class CoreOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    	$this->table('core_orders')
	    	->addColumn('core_seller_id', 'integer', ['limit' => 10])
	    	->addColumn('state_code', 'string', ['limit' => 100])
	    	->addColumn('status_code', 'string', ['limit' => 100])
	    	->addColumn('customer_firstname', 'string', ['limit' => 250])
	    	->addColumn('customer_lastname', 'string', ['limit' => 250])
	    	->addColumn('customer_company', 'string', ['limit' => 250])
	    	->addColumn('customer_email', 'string', ['limit' => 250])
	    	->addColumn('customer_phone', 'string', ['limit' => 250])
	    	->addColumn('customer_street_1', 'string', ['limit' => 250])
	    	->addColumn('customer_street_2', 'string', ['limit' => 250])
	    	->addColumn('customer_postcode', 'string', ['limit' => 250])
	    	->addColumn('customer_city', 'string', ['limit' => 250])
	    	->addColumn('customer_country_code', 'string', ['limit' => 250])
	    	->addColumn('customer_country_name', 'string', ['limit' => 250])
	    	->addColumn('shipping_firstname', 'string', ['limit' => 250])
	    	->addColumn('shipping_lastname', 'string', ['limit' => 250])
	    	->addColumn('shipping_company', 'string', ['limit' => 250])
	    	->addColumn('shipping_street_1', 'string', ['limit' => 250])
	    	->addColumn('shipping_street_2', 'string', ['limit' => 250])
	    	->addColumn('shipping_postcode', 'string', ['limit' => 250])
	    	->addColumn('shipping_city', 'string', ['limit' => 250])
	    	->addColumn('shipping_country_code', 'string', ['limit' => 250])
	    	->addColumn('shipping_country_name', 'string', ['limit' => 250])
	    	->addColumn('invoice_firstname', 'string', ['limit' => 250])
	    	->addColumn('invoice_lastname', 'string', ['limit' => 250])
	    	->addColumn('invoice_company', 'string', ['limit' => 250])
	    	->addColumn('invoice_street_1', 'string', ['limit' => 250])
	    	->addColumn('invoice_street_2', 'string', ['limit' => 250])
	    	->addColumn('invoice_postcode', 'string', ['limit' => 250])
	    	->addColumn('invoice_city', 'string', ['limit' => 250])
	    	->addColumn('invoice_country_code', 'string', ['limit' => 250])
	    	->addColumn('invoice_country_name', 'string', ['limit' => 250])
	    	->addColumn('currency_code', 'string', ['limit' => 250])
	    	->addColumn('currency_name', 'string', ['limit' => 250])
	    	->addColumn('payment_method_code', 'string', ['limit' => 250])
	    	->addColumn('payment_method_name', 'string', ['limit' => 250])
	    	->addColumn('shipping_method_code', 'string', ['limit' => 250])
	    	->addColumn('shipping_method_name', 'string', ['limit' => 250])
	    	->addColumn('purchase_date', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addColumn('core_marketplace_code', 'string', ['limit' => 100])
	    	->addColumn('core_marketplace_name', 'string', ['limit' => 250])
	    	->addColumn('external_order_identifier', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_seller_id'])
	    	->addIndex(['state_code'])
	    	->addIndex(['status_code'])
	    	->addIndex(['currency_code'])
	    	->addIndex(['payment_method_code'])
	    	->addIndex(['shipping_method_code'])
	    	->addIndex(['core_marketplace_code'])
    	->create();
    	
    	$this->table('core_order_products')
    		->addColumn('core_order_id', 'integer', ['limit' => 10])
    		->addColumn('core_product_id', 'integer', ['limit' => 10])
    		->addColumn('sku', 'string', ['limit' => 250])
    		->addColumn('name', 'string', ['limit' => 250])
    		->addColumn('price_excl_tax', 'decimal', ['precision' => 14, 'scale' => 4])
    		->addColumn('tax', 'decimal', ['precision' => 6, 'scale' => 4])
    		->addColumn('quantity', 'decimal', ['precision' => 12, 'scale' => 2])
    		->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
    		->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
    		->addIndex(['core_order_id', 'core_product_id'])
    	->create();
    	
    	$this->table('core_order_states')
	    	->addColumn('code', 'string', ['limit' => 100])
	    	->addColumn('name', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
    	->create();
    	
    	$this->table('core_order_statuses')
	    	->addColumn('code', 'string', ['limit' => 100])
	    	->addColumn('name', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
    	->create();
    	
    	$this->table('core_currencies')
	    	->addColumn('code', 'string', ['limit' => 100])
	    	->addColumn('symbol', 'string', ['limit' => 100])
	    	->addColumn('name', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
    	->create();
    	
    	$this->table('core_order_payments')
    		->addColumn('core_order_id', 'integer', ['limit' => 10])
	    	->addColumn('code', 'string', ['limit' => 100])
	    	->addColumn('name', 'string', ['limit' => 250])
	    	->addColumn('paid_amount', 'decimal', ['precision' => 14, 'scale' => 4])
	    	->addColumn('payment_date', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addColumn('payment_reference_code', 'string', ['limit' => 250])
	    	->addColumn('comment', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_id'])
    	->create();
    	
    	$this->table('core_order_payment_refunds')
	    	->addColumn('core_order_payment_id', 'integer', ['limit' => 10])
	    	->addColumn('refund_amount', 'decimal', ['precision' => 14, 'scale' => 4])
	    	->addColumn('refund_date', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addColumn('refund_reference_code', 'string', ['limit' => 250])
	    	->addColumn('comment', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_payment_id'])
    	->create();
    	
    	$this->table('core_order_shipments')
	    	->addColumn('core_order_id', 'integer', ['limit' => 10])
	    	->addColumn('core_order_product_id', 'integer', ['limit' => 10])
	    	->addColumn('quantity', 'decimal', ['precision' => 12, 'scale' => 2])
	    	->addColumn('shipment_date', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addColumn('carrier_code', 'string', ['limit' => 100])
	    	->addColumn('carrier_name', 'string', ['limit' => 250])
	    	->addColumn('tracking_code', 'string', ['limit' => 250])
	    	->addColumn('tracking_link', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_id', 'core_order_product_id'])
    	->create();
    	
    	$this->table('core_order_cancelations')
	    	->addColumn('core_order_id', 'integer', ['limit' => 10])
	    	->addColumn('core_order_product_id', 'integer', ['limit' => 10])
	    	->addColumn('quantity', 'decimal', ['precision' => 12, 'scale' => 2])
	    	->addColumn('cancel_date', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addColumn('cancel_reason_code', 'string', ['limit' => 100])
	    	->addColumn('cancel_reason_name', 'string', ['limit' => 250])
	    	->addColumn('comment', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_id', 'core_order_product_id'])
	    	->addIndex(['cancel_reason_code'])
    	->create();
    	
    	$this->table('core_order_status_histories')
	    	->addColumn('core_order_id', 'integer', ['limit' => 10])
	    	->addColumn('state_code', 'string', ['limit' => 100])
	    	->addColumn('status_code', 'string', ['limit' => 250])
	    	->addColumn('comment', 'string', ['limit' => 250])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_id'])
    	->create();
    	
    	$this->table('core_order_totals')
	    	->addColumn('core_order_id', 'integer', ['limit' => 10])
	    	->addColumn('code', 'string', ['limit' => 100])
	    	->addColumn('name', 'string', ['limit' => 250])
	    	->addColumn('value', 'decimal', ['precision' => 14, 'scale' => 4])
	    	->addColumn('sort_order', 'integer', ['limit' => 10])
	    	->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
	    	->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
	    	->addIndex(['core_order_id'])
    	->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
    	$this->dropTable('core_orders');
    	$this->dropTable('core_order_products');
    	$this->dropTable('core_order_states');
    	$this->dropTable('core_order_statuses');
    	$this->dropTable('core_currencies');
    	$this->dropTable('core_order_payments');
    	$this->dropTable('core_order_payment_refunds');
    	$this->dropTable('core_order_shipments');
    	$this->dropTable('core_order_cancelations');
    	$this->dropTable('core_order_status_histories');
    	$this->dropTable('core_order_totals');
    }
}