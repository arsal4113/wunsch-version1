<?php
namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederGuidesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederGuidesController Test Case
 *
 * @uses \Feeder\Controller\FeederGuidesController
 */
class FeederGuidesControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederGlobalPriceLimit',
        'plugin.Feeder.FeederGuides',
        'plugin.Feeder.FeederPillarPages',
        'app.FeederGuidesFeederCategories',
        'app.FeederGuidesFeederPillarPages',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/feeder-guides';
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
        $this->get(self::CURRENT_URL.'/view/1');
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
    public function testAdd(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
       // $this->enableRetainFlashMessages();
        $data = [
            'id' => '1','url' => 'test.com','meta_title' => 'test','robots_tag' => 'test','meta_description' => 'test','title' => 'test','description' => 'test','first_background_image' => 'test','second_background_image' => 'test','display_animation' => '1','animation_image' => 'test','background_color' => 'test','use_in_navigation' => '0','navigation_name' => 'test','sort_order' => '1','optional_urls' => 'pro-opencart.com','optional_url_headers' => NULL,'optional_url_image' => 'test'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederGuides = TableRegistry::getTableLocator()->get('FeederGuides');
        $query = $FeederGuides->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '1','url' => 'test.com','meta_title' => 'test','robots_tag' => 'test','meta_description' => 'test','title' => 'test','description' => 'test','first_background_image' => 'test','second_background_image' => 'test','display_animation' => '1','animation_image' => 'test','background_color' => 'test','use_in_navigation' => '0','navigation_name' => 'test','sort_order' => '1','optional_urls' => 'pro-opencart.com','optional_url_headers' => NULL,'optional_url_image' => 'test'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederGuides = TableRegistry::getTableLocator()->get('FeederGuides');
        $query = $FeederGuides->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '1','url' => 'test.com','meta_title' => 'test','robots_tag' => 'test','meta_description' => 'test','title' => 'test','description' => 'test','first_background_image' => 'test','second_background_image' => 'test','display_animation' => '1','animation_image' => 'test','background_color' => 'test','use_in_navigation' => '0','navigation_name' => 'test','sort_order' => '1','optional_urls' => 'pro-opencart.com','optional_url_headers' => NULL,'optional_url_image' => 'test'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederGuides = TableRegistry::getTableLocator()->get('FeederGuides');
        $feeder_cat   = $FeederGuides->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }



    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => '1','url' => 'test.com','meta_title' => 'test','robots_tag' => 'test','meta_description' => 'test','title' => 'test','description' => 'test','first_background_image' => 'test','second_background_image' => 'test','display_animation' => '1','animation_image' => 'test','background_color' => 'test','use_in_navigation' => '0','navigation_name' => 'test','sort_order' => '1','optional_urls' => 'pro-opencart.com','optional_url_headers' => NULL,'optional_url_image' => 'test'
        ];

        $this->post(self::CURRENT_URL . '/edit/13', $data);
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
