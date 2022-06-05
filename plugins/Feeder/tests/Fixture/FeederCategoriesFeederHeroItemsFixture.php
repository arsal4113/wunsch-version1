<?php
namespace Feeder\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeederCategoriesVideoElementsFixture
 */
class FeederCategoriesFeederHeroItemsFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'model' => 'FeederCategoriesFeederHeroItems',
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
                'feeder_category_id' => 1,
                'feeder_hero_item_id' => 1,
            ],
        ];
        parent::init();
    }
}
