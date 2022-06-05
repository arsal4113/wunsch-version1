<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreErrorEbayNotificationsFixture
 */
class CoreErrorEbayNotificationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart

    public $connection = 'test';
    public $import = [
        'model' => 'CoreErrorEbayNotifications',
        'connection' => 'default'
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
                'name' => 'Lorem ipsum dolor sit amet',
                'email' => 'test@test.com',
                'is_active' => 1,
                'created' => '2020-10-02 01:38:27',
                'modified' => '2020-10-02 01:38:27',
            ],
        ];
        parent::init();
    }
}
