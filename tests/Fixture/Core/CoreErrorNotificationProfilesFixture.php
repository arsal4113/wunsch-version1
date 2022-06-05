<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreErrorNotificationProfilesFixture
 *
 */
class CoreErrorNotificationProfilesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart

    public $connection = 'test';
    public $import = [
        'model' => 'CoreErrorNotificationProfiles',
        'connection' => 'default'
    ];

    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'core_seller_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'test@test.com',
            'email_cc' => 'test1@test.com',
            'email_bcc' => 'test2@test.com',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 1,
            'is_running' => 0,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ],
        [
            'id' => 2,
            'core_seller_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Lorem ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'email_to' => 'test@test.com',
            'email_cc' => 'test1@test.com',
            'email_bcc' => 'test2@test.com',
            'email_subject' => 'Lorem ipsum dolor sit amet',
            'is_active' => 1,
            'is_running' => 1,
            'last_run' => '2015-12-09 10:21:00',
            'run_interval' => 1,
            'next_run' => '2015-12-09 10:21:00',
            'max_execution_time' => 1,
            'last_alive' => '2015-12-09 10:21:00',
            'created' => '2015-12-09 10:21:00',
            'modified' => '2015-12-09 10:21:00'
        ],
    ];
}
