<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederInterestsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederInfluencersController Test Case
 *
 * @uses \Feeder\Controller\FeederInfluencersController
 */
class FeederInterestsControllerTest extends TestCase
{
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
        'plugin.Feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederInterests',
        'plugin.feeder.FeederInterestSubcategories',
        'plugin.feeder.FeederInterestsFeederInterestSubcategories',
        'plugin.feeder.FeederGlobalPriceLimit',
        'plugin.Feeder.FeederInfluencerMiniCategories',
        'plugin.Feeder.FeederInfluencers',
        'plugin.Feeder.FeederGuides',
        'plugin.Feeder.CustomerGenders',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes'
    ];
    const CURRENT_URL = '/feeder/feeder-interests';
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

    public function testUpdateMetaTags()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'meta_title' => 'Lorem ipsum dolor sit amet'
        ];
        $this->post(self::CURRENT_URL . '/updateMetaTags', $data);
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'image' => 'a',
            'sale_only' => 1,
            'gender_id' => 1
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testAdd()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'sale_only' => 1,
            'gender_id' => 1
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInterests = TableRegistry::getTableLocator()->get('FeederInterests');
        $query             = $FeederInterests->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseOk();
    }



    public function testEdit()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'sale_only' => 1,
            'gender_id' => 1
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederInterests = TableRegistry::getTableLocator()->get('FeederInterests');
        $query             = $FeederInterests->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseOk();
    }

    public function testEditFailed(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'image' => 'a',
            'sale_only' => 1,
            'gender_id' => 1
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
