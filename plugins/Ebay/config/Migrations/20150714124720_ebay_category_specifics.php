<?php
use Phinx\Migration\AbstractMigration;

class EbayCategorySpecifics extends AbstractMigration
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
        $table = $this->table('ebay_category_specifics');
        $table
            ->addColumn('ebay_category_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_attribute_name', 'string', [
                'limit' => 128,
                'null' => false,
            ])
            ->addColumn('ebay_value_type', 'string', [
                'limit' => 64,
                'null' => true,
            ])
            ->addColumn('ebay_min_values', 'integer', [
                'limit' => 4,
                'null' => false,
            ])
            ->addColumn('ebay_max_values', 'integer', [
                'limit' => 4,
                'null' => false,
            ])
            ->addColumn('ebay_selection_mode', 'string', [
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('ebay_variation_specifics', 'string', [
                'limit' => 64,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(['ebay_category_id'])
            ->create();

        $table = $this->table('ebay_category_specific_to_value_recommendations');
        $table
            ->addColumn('ebay_category_specific_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_category_specific_value_recommendation_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(['ebay_category_specific_id', 'ebay_category_specific_value_recommendation_id'])
            ->create();

        $table = $this->table('ebay_category_specific_value_recommendations');
        $table
            ->addColumn('ebay_site_id', 'integer', [
                'limit' => 10,
                'null' => false
            ])
            ->addColumn('ebay_attribute_value_name', 'string', [
                'limit' => 128,
                'null' => false
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(['ebay_site_id'])
            ->create();
    }
}
