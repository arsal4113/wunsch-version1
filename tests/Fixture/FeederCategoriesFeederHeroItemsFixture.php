<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederCategoriesFeederHeroItemsFixture
 */
class FeederCategoriesFeederHeroItemsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'feeder_category_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'feeder_hero_item_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'feeder_category_id' => ['type' => 'index', 'columns' => ['feeder_category_id'], 'length' => []],
            'feeder_hero_item_id' => ['type' => 'index', 'columns' => ['feeder_hero_item_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            //'feeder_categories_feeder_hero_items_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_category_id'], 'references' => ['feeder_categories', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            //'feeder_categories_feeder_hero_items_ibfk_2' => ['type' => 'foreign', 'columns' => ['feeder_hero_item_id'], 'references' => ['feeder_hero_items', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
                'feeder_category_id' => 1,
                'feeder_hero_item_id' => 1,
            ],
        ];
        parent::init();
    }
}
