<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederHompagesBreakpointBannersFixture
 *
 */
class FeederHompagesBreakpointBannersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'big_banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'big_banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'big_banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'big_banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_small_banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'second_small_banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'third_small_banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fourth_small_banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'armscii8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'armscii8_general_ci'
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
                'big_banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'big_banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'big_banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'big_banner_bp_xs' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'first_small_banner_bp_xs' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'second_small_banner_bp_xs' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'third_small_banner_bp_xs' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'fourth_small_banner_bp_xs' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
