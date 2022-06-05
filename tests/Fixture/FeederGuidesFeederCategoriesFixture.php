<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederGuidesFeederCategoriesFixture
 */
class FeederGuidesFeederCategoriesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'feeder_guide_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'feeder_category_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'feeder_guide_id' => ['type' => 'index', 'columns' => ['feeder_guide_id'], 'length' => []],
            'feeder_category_id' => ['type' => 'index', 'columns' => ['feeder_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'feeder_guides_feeder_categories_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_guide_id'], 'references' => ['feeder_guides', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'feeder_guides_feeder_categories_ibfk_2' => ['type' => 'foreign', 'columns' => ['feeder_category_id'], 'references' => ['feeder_categories', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'feeder_guide_id' => 1,
                'feeder_category_id' => 1,
            ],
        ];
        parent::init();
    }
}
