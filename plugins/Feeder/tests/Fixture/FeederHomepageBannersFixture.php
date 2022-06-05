<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederHomepageBannersFixture
 *
 */
class FeederHomepageBannersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'feeder_homepage_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'banner_image' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'banner_link' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'banner_bp_lg' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'banner_bp_md' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'banner_bp_sm' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'banner_bp_xs' => ['type' => 'string', 'length' => 1020, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sort_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'feeder_homepage_id' => ['type' => 'index', 'columns' => ['feeder_homepage_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            //'feeder_homepage_banners_ibfk_1' => ['type' => 'foreign', 'columns' => ['feeder_homepage_id'], 'references' => ['feeder_homepages', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'feeder_homepage_id' => 1,
                'banner_image' => 'Lorem ipsum dolor sit amet',
                'banner_link' => 'Lorem ipsum dolor sit amet',
                'banner_bp_lg' => 'Lorem ipsum dolor sit amet',
                'banner_bp_md' => 'Lorem ipsum dolor sit amet',
                'banner_bp_sm' => 'Lorem ipsum dolor sit amet',
                'banner_bp_xs' => 'Lorem ipsum dolor sit amet',
                'sort_order' => 1,
                'modified' => '2018-11-28 15:20:43',
                'created' => '2018-11-28 15:20:43'
            ],
        ];
        parent::init();
    }
}
