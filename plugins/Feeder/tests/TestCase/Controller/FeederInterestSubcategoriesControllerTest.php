<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\IntegrationTestCase;
use Feeder\Controller\FeederInterestSubcategoriesController;
use Cake\ORM\TableRegistry;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederInterestSubcategoriesController Test Case
 */
class FeederInterestSubcategoriesControllerTest extends IntegrationTestCase
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
        //'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.feeder.FeederInterestsFeederInterestSubcategories',
        'plugin.feeder.CustomersFeederInterestSubcategories',
        'plugin.Feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederGlobalPriceLimit',
        'plugin.Feeder.FeederInfluencerMiniCategories',
        'plugin.Feeder.FeederInfluencers',
        'plugin.Feeder.FeederGuides',
        'plugin.feeder.FeederInterestSubcategories',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-interest-subcategories';
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
        $this->enableRetainFlashMessages();
        $data = [
            'id'        => 1,
            'name'      => 'Lorem ipsum dolor sit amet',
            'type'      => 'Lorem ipsum dolor sit amet',
            'ids'       => 'Lorem ipsum dolor sit amet',
            'sale_only' => 1,
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInfluencers = TableRegistry::getTableLocator()->get('FeederInterestSubcategories');
        $query             = $FeederInfluencers->find()->where(['id' => $data['id']]);
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
            'id'        => 1,
            'name'      => 'Lorem ipsum dolor sit amet',
            'type'      => 'Lorem ipsum dolor sit amet',
            'ids'       => 'Lorem ipsum dolor sit amet',
            'sale_only' => 1,
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederInfluencers = TableRegistry::getTableLocator()->get('FeederInterestSubcategories');
        $feeder_cat        = $FeederInfluencers->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'        => 1,
            'name'      => null,
            'type'      => null,
            'ids'       => null,
            'sale_only' => null,
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }
}
