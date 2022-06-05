<?php
use Migrations\AbstractSeed;

/**
 * Attributes seed.
 */
class AttributesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */

    /**
     * @author Richard Steinmetz
     * @since August 2016
     * add new attribute mobile description, may not have been seeded live
     */
    public function run()
    {
        $data = [
            'code' => 'mobile_description',
            'name' => 'Mobile Description',
            'data_type' => 'text',
            'data_loader' => NULL,
            'is_required' => 0,
            'multiple_values' => 0,
            'sort_order' => 13,
            'is_configurable' => 0,
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s'),

        ];

        $table = $this->table('core_product_default_eav_attributes');
        $table->insert($data)->save();
    }
}