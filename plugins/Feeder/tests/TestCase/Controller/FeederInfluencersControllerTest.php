<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederInfluencersController;
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
class FeederInfluencersControllerTest extends TestCase
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
        'plugin.Feeder.FeederInfluencerMiniCategories',
        'plugin.Feeder.FeederInfluencers',
        'plugin.Feeder.FeederGuides',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes'
    ];
    const CURRENT_URL = '/feeder/feeder-influencers';
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
            'temp' => [
                'tmp_name' => 'temp name',
            ],
            'removed_media' => 'image temp',
            'id'=>1,
            'name' => 'test',
            'url_path' => 'test',
            'title_tag' => 'test',
            'meta_description' => 'test',
            'robot_tag' => 'test',
            'area_1_headline' => 'test', 'area_1_text' => 'test', 'area_2_text' => 'test', 'area_2_link' => 'test', 'area_3_image' => 'test', 'area_3_video' => 'test', 'area_5_text' => 'test', 'area_5_image_1' => 'test', 'area_5_image_2' => 'test', 'area_5_image_3' => 'test', 'area_5_image_4' => 'test', 'area_5_image_5' => 'test', 'area_5_image_6' => 'test', 'area_6_image_1' => 'test', 'area_6_image_2' => 'test', 'area_6_image_3' => 'test', 'area_7_text' => 'test', 'area_7_text_mobile' => 'test', 'area_8_image' => 'test', 'area_8_headline_1' => 'test', 'area_8_headline_2' => 'test', 'area_8_subline' => 'test', 'area_8_button_link' => 'test', 'area_8_world_id' => '1', 'area_8_ig_name' => 'test', 'area_8_ig_link' => 'test', 'area_9_image' => 'test', 'area_9_headline_1' => 'test', 'area_9_headline_2' => 'test', 'area_9_subline' => 'test', 'area_9_button_link' => 'test', 'area_9_world_id' => '1', 'area_9_ig_name' => 'test', 'area_9_ig_link' => 'test',
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInfluencers = TableRegistry::getTableLocator()->get('FeederInfluencers');
        $query             = $FeederInfluencers->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '1', 'name' => 'test', 'url_path' => 'test', 'title_tag' => 'test', 'meta_description' => 'test', 'robot_tag' => 'test', 'area_1_headline' => 'test', 'area_1_text' => 'test', 'area_2_text' => 'test', 'area_2_link' => 'test', 'area_3_image' => 'test', 'area_3_video' => 'test', 'area_5_text' => 'test', 'area_5_image_1' => 'test', 'area_5_image_2' => 'test', 'area_5_image_3' => 'test', 'area_5_image_4' => 'test', 'area_5_image_5' => 'test', 'area_5_image_6' => 'test', 'area_6_image_1' => 'test', 'area_6_image_2' => 'test', 'area_6_image_3' => 'test', 'area_7_text' => 'test', 'area_7_text_mobile' => 'test', 'area_8_image' => 'test', 'area_8_headline_1' => 'test', 'area_8_headline_2' => 'test', 'area_8_subline' => 'test', 'area_8_button_link' => 'test', 'area_8_world_id' => '1', 'area_8_ig_name' => 'test', 'area_8_ig_link' => 'test', 'area_9_image' => 'test', 'area_9_headline_1' => 'test', 'area_9_headline_2' => 'test', 'area_9_subline' => 'test', 'area_9_button_link' => 'test', 'area_9_world_id' => '1', 'area_9_ig_name' => 'test', 'area_9_ig_link' => 'test',
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInfluencers = TableRegistry::getTableLocator()->get('FeederInfluencers');
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
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '1', 'name' => 'test', 'url_path' => 'test', 'title_tag' => 'test', 'meta_description' => 'test', 'robot_tag' => 'test', 'area_1_headline' => 'test', 'area_1_text' => 'test', 'area_2_text' => 'test', 'area_2_link' => 'test', 'area_3_image' => 'test', 'area_3_video' => 'test', 'area_5_text' => 'test', 'area_5_image_1' => 'test', 'area_5_image_2' => 'test', 'area_5_image_3' => 'test', 'area_5_image_4' => 'test', 'area_5_image_5' => 'test', 'area_5_image_6' => 'test', 'area_6_image_1' => 'test', 'area_6_image_2' => 'test', 'area_6_image_3' => 'test', 'area_7_text' => 'test', 'area_7_text_mobile' => 'test', 'area_8_image' => 'test', 'area_8_headline_1' => 'test', 'area_8_headline_2' => 'test', 'area_8_subline' => 'test', 'area_8_button_link' => 'test', 'area_8_world_id' => '1', 'area_8_ig_name' => 'test', 'area_8_ig_link' => 'test', 'area_9_image' => 'test', 'area_9_headline_1' => 'test', 'area_9_headline_2' => 'test', 'area_9_subline' => 'test', 'area_9_button_link' => 'test', 'area_9_world_id' => '1', 'area_9_ig_name' => 'test', 'area_9_ig_link' => 'test',
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederInfluencers = TableRegistry::getTableLocator()->get('FeederInfluencers');
        $feeder_cat        = $FeederInfluencers->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id' => '1', 'name' => 'test', 'url_path' => 'test', 'title_tag' => 'test', 'meta_description' => 'test', 'robot_tag' => 'test', 'area_1_headline' => 'test', 'area_1_text' => 'test', 'area_2_text' => 'test', 'area_2_link' => 'test', 'area_3_image' => 'test', 'area_3_video' => 'test', 'area_5_text' => 'test', 'area_5_image_1' => 'test', 'area_5_image_2' => 'test', 'area_5_image_3' => 'test', 'area_5_image_4' => 'test', 'area_5_image_5' => 'test', 'area_5_image_6' => 'test', 'area_6_image_1' => 'test', 'area_6_image_2' => 'test', 'area_6_image_3' => 'test', 'area_7_text' => 'test', 'area_7_text_mobile' => 'test', 'area_8_image' => 'test', 'area_8_headline_1' => 'test', 'area_8_headline_2' => 'test', 'area_8_subline' => 'test', 'area_8_button_link' => 'test', 'area_8_world_id' => '1', 'area_8_ig_name' => 'test', 'area_8_ig_link' => 'test', 'area_9_image' => 'test', 'area_9_headline_1' => 'test', 'area_9_headline_2' => 'test', 'area_9_subline' => 'test', 'area_9_button_link' => 'test', 'area_9_world_id' => '1', 'area_9_ig_name' => 'test', 'area_9_ig_link' => 'test',
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
