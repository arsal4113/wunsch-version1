<?php
namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayCustomPageTypesFixture
 *
 */
class EbayCustomPageTypesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayCustomPageTypes',
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
            'code' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'order' => 1,
            'left_navbar' => 1,
            'preview_enabled' => 1,
            'url_path' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-05-22 15:30:10',
            'modified' => '2017-05-22 15:30:10'
        ],
    ];
}
