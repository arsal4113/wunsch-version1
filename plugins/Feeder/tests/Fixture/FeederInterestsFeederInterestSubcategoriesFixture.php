<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederInterestsFeederInterestSubcategoriesFixture
 */
class FeederInterestsFeederInterestSubcategoriesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'feeder_interest_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'feeder_interest_subcategory_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'feeder_interest_id' => ['type' => 'index', 'columns' => ['feeder_interest_id'], 'length' => []],
            'feeder_interest_subcategory_id' => ['type' => 'index', 'columns' => ['feeder_interest_subcategory_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'feeder_interests_feeder_interest_subcategories_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_interest_id'], 'references' => ['feeder_interests', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'feeder_interests_feeder_interest_subcategories_ibfk_2' => ['type' => 'foreign', 'columns' => ['feeder_interest_subcategory_id'], 'references' => ['feeder_interest_subcategories', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'feeder_interest_id' => 1,
                'feeder_interest_subcategory_id' => 1,
            ],
        ];
        parent::init();
    }
}
