<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoreSellerAddressesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoreSellerAddressesTable Test Case
 */
class CoreSellerAddressesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CoreSellerAddressesTable
     */
    public $CoreSellerAddresses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreSellerAddresses',
        'app.Core/CoreSellers',
        'app.Core/CoreCountries',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CoreSellerAddresses') ? [] : ['className' => CoreSellerAddressesTable::class];
        $this->CoreSellerAddresses = TableRegistry::getTableLocator()->get('CoreSellerAddresses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoreSellerAddresses);

        parent::tearDown();
    }

    public function testFindAll()
    {
        $auctionSeller = $this->CoreSellerAddresses->find();
        $this->assertInstanceOf("Cake\Orm\Query", $auctionSeller);
        $result = $auctionSeller->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $auctionSeller = $this->CoreSellerAddresses->newEntity([
            'id' => 2,
            'core_seller_id' => 1,
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'street_name' => 'Lorem ipsum dolor sit amet',
            'street_number' => 'Lorem ip',
            'city' => 'Lorem ipsum dolor sit amet',
            'zip_code' => 1,
            'phone_number' => 'Lorem ipsum dolor sit amet',
            'company_name' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-09-20 13:59:52',
            'modified' => '2016-09-20 13:59:52'
        ]);
        $result = $this->CoreSellerAddresses->save($auctionSeller);
        $this->assertInstanceOf('App\Model\Entity\CoreSellerAddress', $result);
    }

}
