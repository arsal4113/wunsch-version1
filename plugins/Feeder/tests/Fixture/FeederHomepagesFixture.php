<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederHomepagesFixture
 *
 */
class FeederHomepagesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'big_banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'big_banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'surprise_item_ids' => ['type' => 'string', 'length' => 2040, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'feeder_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'feeder_category_id' => ['type' => 'index', 'columns' => ['feeder_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            //'feeder_homepages_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_category_id'], 'references' => ['feeder_categories', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'big_banner_image' => 'Lorem ipsum dolor sit amet',
                'big_banner_link' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_image' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_link' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_image' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_link' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_image' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_link' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_image' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_link' => 'Lorem ipsum dolor sit amet',
                'surprise_item_ids' => 'Lorem ipsum dolor sit amet',
                'feeder_category_id' => 1
            ],
        ];
        parent::init();
    }
}
