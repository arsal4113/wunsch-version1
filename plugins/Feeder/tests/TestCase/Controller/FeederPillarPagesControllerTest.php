<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederPillarPagesController;
use Cake\ORM\TableRegistry;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederPillarPagesController Test Case
 */
class FeederPillarPagesControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederPillarPages',
        'plugin.Feeder.FeederGuides',
        'plugin.feeder.FeederInterestSubcategories',
        'plugin.EbayCheckout.EbayCheckoutSessionItems',
        'plugin.EbayCheckout.EbayCheckoutSessions',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'plugin.UrlRewrite.UrlRewriteRedirects',
    ];
    const CURRENT_URL = '/feeder/feeder-pillar-pages';
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
        $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    public function testIndex()
    {
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
            'title_tag'               => 'test',
            'url_path'                => 'test',
            'meta_tag'                => 'test',
            'robots_tag'              => 'test',
            'tags'                    => 'test',
            'facebook_og_url'         => 'test',
            'facebook_og_title'       => 'test',
            'facebook_og_description' => 'test',
            'facebook_og_image'       => 'test',
            'block_configuration'     => json_encode('test'),
            'items_status'            => '0',
            'first_block_image'       => 'test',
            'first_block_title'       => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederPillarPages = TableRegistry::getTableLocator()->get('FeederPillarPages');
        $query             = $FeederPillarPages->find()->where(['title_tag' => $data['title_tag']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'title_tag' => 'test', 'url_path' => 'test', 'meta_tag' => 'test', 'robots_tag' => 'test', 'tags' => 'test', 'facebook_og_url' => 'test', 'facebook_og_title' => 'test', 'facebook_og_description' => 'test', 'facebook_og_image' => 'test', 'block_configuration' => json_encode('test'), 'items_status' => '0', 'first_block_image' => 'test', 'first_block_title' => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederPillarPages = TableRegistry::getTableLocator()->get('FeederPillarPages');
        $feeder_cat        = $FeederPillarPages->find()->where(['title_tag' => $data['title_tag']])->first();
        $this->assertEquals($data['title_tag'], $feeder_cat->title_tag);
    }

    public function testUploadImageNot()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'title_tag' => 'test', 'url_path' => 'test', 'meta_tag' => 'test', 'robots_tag' => 'test', 'tags' => 'test', 'facebook_og_url' => 'test', 'facebook_og_title' => 'test', 'facebook_og_description' => 'test', 'facebook_og_image' => 'test', 'block_configuration' => 'test', 'items_status' => '0', 'first_block_image' => 'test', 'first_block_title' => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/uploadImage', $data);
        $this->assertResponseSuccess();
    }

    public function testUploadImage()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'title_tag' => 'test', 'url_path' => 'test', 'meta_tag' => 'test', 'robots_tag' => 'test', 'tags' => 'test', 'facebook_og_url' => 'test', 'facebook_og_title' => 'test', 'facebook_og_description' => 'test', 'facebook_og_image' => 'test', 'block_configuration' => 'test', 'items_status' => '0', 'first_block_image' => 'test', 'first_block_title' => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/uploadImage', $data);
        $this->assertResponseSuccess();
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'title_tag' => 'test', 'url_path' => 'test', 'meta_tag' => 'test', 'robots_tag' => 'test', 'tags' => 'test', 'facebook_og_url' => 'test', 'facebook_og_title' => 'test', 'facebook_og_description' => 'test', 'facebook_og_image' => 'test', 'block_configuration' => json_encode('test'), 'items_status' => '0', 'first_block_image' => 'test', 'first_block_title' => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederPillarPages = TableRegistry::getTableLocator()->get('FeederPillarPages');
        $query             = $FeederPillarPages->find()->where(['title_tag' => $data['title_tag']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditGoogle()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'title_tag'       => 'test',
            'url_path'        => 'test',
            'meta_tag'        => 'test',
            'robots_tag'      => 'test',
            'tags'            => 'test',
            'image'           => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'facebook_og_url' => 'test', 'facebook_og_title' => 'test', 'facebook_og_description' => 'test', 'facebook_og_image' => 'test', 'block_configuration' => json_encode('test'), 'items_status' => '0', 'first_block_image' => 'test', 'first_block_title' => 'test', 'first_block_text' => 'test', 'first_block_cta_text' => 'test', 'first_block_cta_link' => 'test', 'second_block_image' => 'test', 'second_block_title' => 'test', 'second_block_text' => 'test', 'second_block_cta_text' => 'test', 'second_block_cta_link' => 'test', 'third_block_image' => 'test', 'instagram_section_text' => 'test', 'third_block_text' => 'test', 'third_block_follow_color' => 'test', 'fourth_block_title' => 'test', 'fourth_block_text' => 'test', 'fourth_block_cta_text' => 'test', 'fourth_block_cta_link' => 'test', 'fifth_block_title' => 'test', 'fifth_block_text' => 'test', 'fifth_block_cta_text' => 'test', 'fifth_block_cta_link' => 'test', 'guide_image' => 'test', 'uploaded_image_size' => '12', 'guide_headline' => 'test', 'created' => '2020-12-02 13:03:38', 'modified' => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederPillarPages = TableRegistry::getTableLocator()->get('FeederPillarPages');
        $feeder_cat        = $FeederPillarPages->find()->where(['title_tag' => $data['title_tag']])->first();
        $this->assertEquals($data['title_tag'], $feeder_cat->title_tag);
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
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
            'id'                       => null,
            'title_tag'                => null,
            'url_path'                 => null,
            'meta_tag'                 => null,
            'robots_tag'               => null,
            'tags'                     => null,
            'facebook_og_url'          => null,
            'facebook_og_title'        => null,
            'facebook_og_description'  => null,
            'facebook_og_image'        => null,
            'block_configuration'      => json_encode(null),
            'items_status'             => '0',
            'first_block_image'        => null,
            'first_block_title'        => null,
            'first_block_text'         => null,
            'first_block_cta_text'     => null,
            'first_block_cta_link'     => null,
            'second_block_image'       => null,
            'second_block_title'       => null,
            'second_block_text'        => null,
            'second_block_cta_text'    => null,
            'second_block_cta_link'    => null,
            'third_block_image'        => null,
            'instagram_section_text'   => null,
            'third_block_text'         => null,
            'third_block_follow_color' => null,
            'fourth_block_title'       => null,
            'fourth_block_text'        => null,
            'fourth_block_cta_text'    => null,
            'fourth_block_cta_link'    => null,
            'fifth_block_title'        => null,
            'fifth_block_text'         => null,
            'fifth_block_cta_text'     => null,
            'fifth_block_cta_link'     => null,
            'guide_image'              => null,
            'uploaded_image_size'      => '12',
            'guide_headline'           => null,
            'created'                  => '2020-12-02 13:03:38',
            'modified'                 => '2020-12-02 13:03:38'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testCopy()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/copy/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testDownload()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/download', $data);
        $this->assertResponseSuccess();
    }
}
