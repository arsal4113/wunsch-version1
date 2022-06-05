<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederFizzyBubblesController;
use Cake\ORM\TableRegistry;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederGlobalPriceLimitController Test Case
 */
class FeederGlobalPriceLimitControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'app.Core/CoreConfigurations',
        'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.Feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederGlobalPriceLimit',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-global-price-limit';
    private $coreUser;

    public static function setUpBeforeClass()
    {
        Configure::write('Acl.database', 'test');
    }

    public function setup()
    {
        Cache::drop('api_user');
        $this->coreUser = $this->setLogin('test');
        $this->session([
            'Auth' => [
                'User' => $this->coreUser
            ]
        ]);
    }

    public function testView()
    {
        //dd(1);
        $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    public function testIndex()
    {
        //dd(1);
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        // $this->enableRetainFlashMessages();
        $data = [
            'id' => 2,
            'price_limit' => 20,
            'created'     => '2018-10-22 17:05:45',
            'modified'    => '2018-10-22 17:05:45'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederGlobalPriceLimit = TableRegistry::getTableLocator()->get('FeederGlobalPriceLimit');
        $query                  = $FeederGlobalPriceLimit->find()->where(['price_limit' => $data['price_limit']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'price_limit' => 20,
            'created'     => '2018-10-22 17:05:45',
            'modified'    => '2018-10-22 17:05:45'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederGlobalPriceLimit = TableRegistry::getTableLocator()->get('FeederGlobalPriceLimit');
        $feeder_cat             = $FeederGlobalPriceLimit->find()->where(['price_limit' => $data['price_limit']])->first();
        $this->assertEquals($data['price_limit'], $feeder_cat->price_limit);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'price_limit' => null,
            'created'     => null,
            'modified'    => null
        ];
        $this->post(self::CURRENT_URL . '/edit/13', $data);
        $this->assertResponseSuccess();
    }



    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testChoose()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
        ];
        $this->post(self::CURRENT_URL . '/choose', $data);
        $this->assertResponseSuccess();
    }
}
