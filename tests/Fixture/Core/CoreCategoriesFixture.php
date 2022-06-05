<?php

namespace App\Test\Fixture\Core;

use Cake\TestSuite\Fixture\TestFixture;

class CoreCategoriesFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'CoreCategories',
        'connection' => 'default'
    ];

    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'parent_id' => 1,
                'core_seller_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'meta_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'lft' => 1,
                'rght' => 1,
                'created' => '2015-04-27 13:00:06',
                'modified' => '2015-04-27 13:00:06'
            ],
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }

}