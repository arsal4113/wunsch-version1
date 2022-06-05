<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederCategoriesCoreCountriesFixture
 */
class FeederCategoriesCoreCountriesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'feeder_category_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_country_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'feeder_category_id' => ['type' => 'index', 'columns' => ['feeder_category_id'], 'length' => []],
            'core_country_id' => ['type' => 'index', 'columns' => ['core_country_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'feeder_categories_core_countries_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_category_id'], 'references' => ['feeder_categories_new', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
            'feeder_categories_core_countries_ibfk_2' => ['type' => 'foreign', 'columns' => ['core_country_id'], 'references' => ['core_countries', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'feeder_category_id' => 38,
                'core_country_id' => 1,
            ],
        ];
        parent::init();
    }
}
