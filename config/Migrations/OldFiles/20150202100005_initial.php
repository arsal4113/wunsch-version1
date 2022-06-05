<?php
use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * @return void
     */
    public function change()
    {
        $table = $this->table('core_cancel_reason_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_cancel_reason_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_cancel_reasons');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_carrier_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_carrier_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_carriers');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('carrier_code', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('carrier_link', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_categories');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('parent_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('category_level', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_categories_core_products');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_category_attribute_value_varchars');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_category_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_category_eav_attribute_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_category_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_category_eav_attributes');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_required', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('data_type', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('multiple_values', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_configurations');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('configuration_group', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('configuration_key', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('configuration_value', 'string', [
                'limit' => '100',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_countries');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('iso_code', 'string', [
                'limit' => '2',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '128',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_error_logs');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('error_type', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('error_sub_type', 'string', [
                'limit' => '80',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('message', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('additional_error_data', 'string', [
                'limit' => '255',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('http_code', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('file', 'string', [
                'limit' => '255',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('line', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('trace', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_languages');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('iso_code', 'string', [
                'limit' => '3',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_marketplaces');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '128',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_active', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_marketplaces_core_sellers');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_datetimes');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_decimals');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'decimal', [
                'limit' => '14',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_images');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'string', [
                'limit' => '1024',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_ints');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_texts');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'text', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_attribute_value_varchars');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('value', 'string', [
                'limit' => '1024',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_default_eav_attributes');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_required', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('data_type', 'string', [
                'limit' => '10',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('multiple_values', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_eav_attribute_group_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_group_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '120',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_eav_attribute_groups');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_set_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '120',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('sort_order', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_eav_attribute_set_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_eav_attribute_set_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '120',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_eav_attribute_sets');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_eav_attributes');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '256',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('data_type', 'string', [
                'limit' => '10',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_required', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('multiple_values', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_quantities');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('quantity', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '128',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_update_histories');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('core_product_update_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_product_update_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_products');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('parent_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('sku', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_sellers');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_active', 'boolean', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_user_roles');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '64',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '128',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('core_users');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_user_role_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('email', 'string', [
                'limit' => '512',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('password', 'string', [
                'limit' => '512',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_account_type_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_account_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('account_type', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_accounts');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_credential_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('token', 'text', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_accounts_ebay_sites');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_categories');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('parent_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('category_level', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('version', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_category_mappings');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_credentials');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_type_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('key_set_name', 'string', [
                'limit' => '64',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('app_id', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('dev_id', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('cert_id', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_dispute_explanation_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_dispute_explanation_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_dispute_explanations');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_dispute_explanations_ebay_dispute_reasons');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_dispute_explanation_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_dispute_reason_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_dispute_reason_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_dispute_reason_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_dispute_reasons');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_launch_profiles');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('duration', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_lister_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('auction_type', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('launch_quantity', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('min_quantity', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('quantity_restriction_per_buyer', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_lister_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_listing_errors');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_listing_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('action', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('type', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('message', 'string', [
                'limit' => '1024',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '45',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_listings');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_product_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('sku', 'string', [
                'limit' => '100',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('ean', 'string', [
                'limit' => '45',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('ebay_item_id', 'string', [
                'limit' => '45',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('item_title', 'string', [
                'limit' => '100',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('item_subtitle', 'string', [
                'limit' => '100',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('item_condition', 'string', [
                'limit' => '45',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('ebay_category_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('start_price', 'decimal', [
                'limit' => '14',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('quantity', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('quantity_sold', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('ebay_lister_type_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('auction_type', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('duration', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('scheduled', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ended', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('start_time', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('end_time', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('listing_status', 'string', [
                'limit' => '45',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_site_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ebay_sites');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_marketplace_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_global_id', 'string', [
                'limit' => '20',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('is_active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_accounts');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_accounts_feed_import_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('limit_per_hour', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('sort_order', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_field_mappings');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('import_file_field_name', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('itool_field_name', 'string', [
                'limit' => '100',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('search_value_in_database', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => '0'
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_field_value_mappings');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_field_mapping_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('target_table', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('source_column_name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('target_column_name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_job_status_histories');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_job_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_job_status_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_job_statuses');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_jobs');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_type_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('file_name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('feed_import_types');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('type_name', 'string', [
                'limit' => '80',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('type_code', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('ftp_configurations');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('host', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('port', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('user', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('pass', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('action_type', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('connection_type', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('remote_path', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('local_path', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('archive_path', 'string', [
                'limit' => '255',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('time_interval', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('last_start', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('next_start', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('last_execution_time', 'datetime', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->addColumn('active', 'integer', [
                'limit' => '1',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('mip_job_status_histories');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('mip_job_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('mip_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('mip_job_status_names');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('feed_import_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_language_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('name', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('mip_job_statuses');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('code', 'string', [
                'limit' => '45',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('mip_jobs');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('type', 'string', [
                'limit' => '100',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('file_name', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('mip_job_status_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('mip_updater_configurations');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('core_seller_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_account_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('time_interval', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('last_start', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('next_start', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('last_execution_time', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('active', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('created', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('modified', 'datetime', [
                'limit' => '',
                'null' => '',
                'default' => ''
            ])
            ->save();
        $table = $this->table('translation_core_attributes');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('locale', 'string', [
                'limit' => '6',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('model', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('foreign_key', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('field', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('content', 'text', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->save();
        $table = $this->table('translation_core_generals');
        $table
            ->addColumn('id', 'integer', [
                'limit' => '11',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('locale', 'string', [
                'limit' => '6',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('model', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('foreign_key', 'integer', [
                'limit' => '10',
                'unsigned' => '',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('field', 'string', [
                'limit' => '255',
                'null' => '',
                'default' => ''
            ])
            ->addColumn('content', 'text', [
                'limit' => '',
                'null' => '1',
                'default' => ''
            ])
            ->save();
    }

    /**
     * Migrate Up.
     *
     * @return void
     */
    public function up()
    {
    }

    /**
     * Migrate Down.
     *
     * @return void
     */
    public function down()
    {
    }

}
